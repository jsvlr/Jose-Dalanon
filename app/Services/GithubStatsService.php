<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubStatsService
{
    public function stats(): array
    {
        return Cache::remember('github-stats', now()->addHours(6), function () {
            $response = Http::withToken(config('services.github.token'))
                ->post('https://api.github.com/graphql', [
                    'query' => $this->query(),
                    'variables' => ['login' => config('services.github.username')],
                ]);

            if ($response->failed() || !$response->json('data.user')) {
                return $this->fallback();
            }

            $user = $response->json('data.user');
            $calendar = $user['contributionsCollection']['contributionCalendar'];
            $repos = $user['repositories'];

            return [
                'total_contributions' => $calendar['totalContributions'],
                'weeks' => $this->mapWeeks($calendar['weeks']),
                'public_repos' => $repos['totalCount'],
                'total_stars' => collect($repos['nodes'])->sum('stargazerCount'),
                'followers' => $user['followers']['totalCount'],
            ];
        });
    }

    protected function mapWeeks(array $weeks): array
    {
        return collect($weeks)->map(fn($week) => [
            'contributionDays' => collect($week['contributionDays'])->map(fn($day) => [
                'date' => $day['date'],
                'count' => $day['contributionCount'],
                'level' => $this->levelFor($day['contributionCount']),
            ])->all(),
        ])->all();
    }

    protected function levelFor(int $count): int
    {
        return match (true) {
            $count === 0 => 0,
            $count <= 2 => 1,
            $count <= 4 => 2,
            $count <= 6 => 3,
            default => 4,
        };
    }

    protected function fallback(): array
    {
        return [
            'total_contributions' => 0,
            'weeks' => [],
            'public_repos' => 0,
            'total_stars' => 0,
            'followers' => 0,
        ];
    }

    protected function query(): string
    {
        return <<<'GQL'
        query($login: String!) {
          user(login: $login) {
            contributionsCollection {
              contributionCalendar {
                totalContributions
                weeks {
                  contributionDays {
                    date
                    contributionCount
                  }
                }
              }
            }
            repositories(first: 100, ownerAffiliations: OWNER, isFork: false) {
              totalCount
              nodes {
                stargazerCount
              }
            }
            followers {
              totalCount
            }
          }
        }
        GQL;
    }
}
