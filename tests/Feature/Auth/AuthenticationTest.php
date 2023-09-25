<?php

use App\Models\User;

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    expect($response->status())->toBe(302);

});

test('users can logout', function () {
    $user = User::factory()->create();
    $user->createToken('test');
    $response = $this->actingAs($user)->post('/api/logout');

    $response->assertNoContent();
});
