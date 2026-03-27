<?php

use App\Models\Idea;
use App\Models\User;

it('can create an idea', function () {
    $this->actingAs(User::factory()->create());

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Test Idea')
        ->fill('description', 'Test Description')
        ->fill('@new-link', 'https://www.linkedin.com/feed/')
        ->click('@submit-new-link-button')
        ->click('@button-status-completed')
        ->click('@create-idea-submit');

    expect(Idea::first())->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'Test Description',
        'status' => 'completed',
    ]);
});
