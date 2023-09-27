<?php

use App\Models\Author;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create(['is_admin' => true]));
});

it('can list authors', function () {
    $authors = Author::factory()->count(3)->create();

    $response = $this->get(route('authors.index'));

    $response
        ->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            ['id', 'name'],
        ]);
});

it('can create an author', function () {
    $authorData = ['name' => 'John Doe'];

    $response = $this->post(route('authors.store'), $authorData);

    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'name',
        ]);

    $this->assertDatabaseHas('authors', ['name' => 'John Doe']);
});

it('can show an author', function () {
    $author = Author::factory()->create();
    unset($author['created_at']);
    unset($author['updated_at']);
    $response = $this->get(route('authors.show', $author));

    $response
        ->assertStatus(200)
        ->assertJson($author->toArray());
});

it('can update an author', function () {
    $author = Author::factory()->create();
    $updatedAuthorData = ['name' => 'Updated Name'];

    $response = $this->put(route('authors.update', $author), $updatedAuthorData);

    $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name',
        ]);

    $this->assertDatabaseHas('authors', ['id' => $author->id, 'name' => 'Updated Name']);
});

it('can delete an author', function () {
    $author = Author::factory()->create();

    $response = $this->delete(route('authors.destroy', $author));

    $response
        ->assertStatus(204);

    $this->assertDatabaseMissing('authors', ['id' => $author->id]);
});
