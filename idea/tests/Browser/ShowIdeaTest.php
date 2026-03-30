<?php

use App\Models\Idea;
use App\Models\User;

it('must be signed in to view idea', function () {
    $idea = Idea::factory()->create();

    $this->get(route('ideas.show', $idea))
        ->assertRedirect(route('login'));
});

it('requires auth to view idea', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    $idea = Idea::factory()->create();

    $this->get(route('ideas.show', $idea))->assertForbidden();
});

