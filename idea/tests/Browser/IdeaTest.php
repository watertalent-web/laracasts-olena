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
        ->fill('@new-step', 'Do the thing')
        ->click('@submit-new-step-button')
        ->fill('@new-step', 'Do the other thing')
        ->click('@submit-new-step-button')
        ->click('@button-status-completed')
        ->click('@create-idea-submit');

    $idea = Idea::first();

    expect($idea)->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'Test Description',
        'status' => 'completed',
    ]);

    expect($idea->steps)->toHaveCount(2);
});

it('can edit an existing idea', function () {
    $this->actingAs($user = User::factory()->create());

    $idea = Idea::factory()->for($user)->create();

    visit(route('ideas.show', $idea))
        ->click('@edit-idea-button')

        ->fill('title', 'Some example idea')
        ->fill('description', 'Test Description')
        ->fill('@new-link', 'https://www.linkedin.com/feed/')
        ->click('@submit-new-link-button')
        ->fill('@new-step', 'Do the thing')
        ->click('@submit-new-step-button')
        ->fill('@new-step', 'Do the other thing')
        ->click('@submit-new-step-button')
        ->click('@button-status-completed')
        ->click('@create-idea-submit')
        ->assertPathIs('/ideas/'.$idea->id);

    $idea->refresh();

    expect($idea)->toMatchArray([
        'title' => 'Some example idea',
        'description' => 'Test Description',
        'status' => 'completed',
    ]);

    expect($idea->steps)->toHaveCount(2);
});
