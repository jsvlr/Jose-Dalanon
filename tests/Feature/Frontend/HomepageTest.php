<?php

use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Services\GitHubStatsService;


describe('homepage', function () {

    it('renders homepage', function () {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Available for work');
    });

    it('shows github stats and contributions', function () {
        Http::preventingStrayRequests();

        Cache::forget('github-stats');
        config([
            'services.github.token' => 'test-token',
            'services.github.username' => 'josvx20'
        ]);

        Http::fake([
            'https://api.github.com/graphql' => Http::response([
                'data' => [
                    'user' => [
                        'contributionsCollection' => [
                            'contributionCalendar' => [
                                'totalContributions' => 12,
                                'weeks' => [
                                    [
                                        'contributionDays' => [
                                            ['date' => '2026-10-19', 'contributionCount' => 0],
                                            ['date' => '2026-10-20', 'contributionCount' => 2],
                                            ['date' => '2026-10-21', 'contributionCount' => 4],
                                            ['date' => '2026-10-22', 'contributionCount' => 6],
                                            ['date' => '2026-10-23', 'contributionCount' => 7],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'repositories' => [
                            'totalCount' => 3,
                            'nodes' => [
                                ['stargazerCount' => 4]
                            ],
                        ],
                        'followers' => ['totalCount' => 5]
                    ],
                ]
            ])
        ]);

        $stats = app(GitHubStatsService::class)->stats();

        expect($stats['total_contributions'])->toBe(12)
            ->and($stats['public_repos'])->toBe(3)
            ->and($stats['total_stars'])->toBe(4)
            ->and($stats['followers'])->toBe(5);

        $days = $stats['weeks'][0]['contributionDays'];
        expect(collect($days)->pluck('level')->all())->toBe([0, 1, 2, 3, 4])
            ->and($days[0])->toBe(['date' => '2026-10-19', 'count' => 0, 'level' => 0])
            ->and($days[1])->toBe(['date' => '2026-10-20', 'count' => 2, 'level' => 1])
            ->and($days[2])->toBe(['date' => '2026-10-21', 'count' => 4, 'level' => 2])
            ->and($days[3])->toBe(['date' => '2026-10-22', 'count' => 6, 'level' => 3])
            ->and($days[4])->toBe(['date' => '2026-10-23', 'count' => 7, 'level' => 4]);

        Http::assertSentCount(1);
        Http::assertSent(
            fn($request) =>
            $request->url() === 'https://api.github.com/graphql' &&
                $request->method() === 'POST' &&
                $request->hasHeader('Authorization', 'Bearer test-token') &&
                $request['variables']['login'] === 'josvx20'
        );

        // Cache: a second call makes no new request
        expect(Cache::has('github-stats'))->toBeTrue();
        app(GitHubStatsService::class)->stats();
        Http::assertSentCount(1); // Still one count of request has been sent
    });

    it('shows featured projects', function () {
        Project::factory()->create([
            'title' => 'How to create a test file on pest',
            'slug' => 'how-to-create-a-test-file-on-pest',
            'is_featured' => true
        ]);

        Project::factory()->create([
            'title' => 'Testing not featured project',
            'slug' => 'testing-not-featured-project',
            'is_featured' => false
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('How to create a test file on pest')
            ->assertDontSee('Testing not featured project');
    });
});
