<?php

use App\Models\Post;

it('preserves code blocks when a post is saved and reloaded', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'codeBlock',
                'attrs' => ['language' => 'php'],
                'content' => [
                    ['type' => 'text', 'text' => '<?php echo "SavedSnippet";'],
                ],
            ],
        ],
    ];

    $post = Post::factory()->create(['content' => $document]);

    $reloadedPost = Post::query()->findOrFail($post->id);

    expect($reloadedPost->content)->toBe($document)
        ->and($reloadedPost->renderRichContent('content'))->toContain('<pre')
        ->toContain('SavedSnippet');
});

it('keeps existing html post content readable', function () {
    $post = Post::factory()->create(['content' => '<p>Existing post content</p>']);

    $reloadedPost = Post::query()->findOrFail($post->id);

    expect($reloadedPost->content)->toBe('<p>Existing post content</p>')
        ->and($reloadedPost->renderRichContent('content'))->toContain('Existing post content');
});
