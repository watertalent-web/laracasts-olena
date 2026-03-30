<?php

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Support\Facades\Notification;

it('requires authentication', function () {
    visit(route('profile.edit'))
        ->assertPathIs('/login');
});

it('can update a profile', function () {

    $user = User::factory()->create();
    $this->actingAs($user);
    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'John Doe')
        ->fill('email', 'john@doe.com')
        ->fill('password', 'password')
        ->click('Update Profile')
        ->assertSee('Profile updated successfully');

    expect($user->fresh()->name)->toBe('John Doe');
    expect($user->fresh()->email)->toBe('john@doe.com');
});

it('notification is shown when a profile is updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Notification::fake();

    $originalEmail = $user->email;

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('email', 'john@doe.com')
        ->click('Update Profile')
        ->assertSee('Profile updated successfully');

    Notification::assertSentOnDemand(EmailChanged::class, function (EmailChanged $notification, $routes, $notifiable) use ($originalEmail) {
        return $notifiable->routes['mail'] === $originalEmail;
    });
});
