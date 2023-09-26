<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create(['is_admin' => true]));
});

it('can list books', function () {
    $books = Book::factory()->count(3)->create();

    $response = $this->get(route('books.index'));

    $response
        ->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure(['data' => [['id', 'title', 'img_url', 'description', 'status', 'publish_date', 'authors', 'created_at', 'updated_at']]]);
});

it('can create a book', function () {
    $author = Author::factory()->create();

    $bookData = Book::factory()->make(['authors' => [$author->id]])->toArray();

    $response = $this->post(route('books.store'), $bookData);
    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'title',
            'img_url',
            'description',
            'status',
            'publish_date',
            'authors' => [
                '*' => [
                    'id',
                    'name'
                ],
            ],
            'created_at',
            'updated_at'
        ]);

});


it('can show a book', function () {
    $book = Book::factory()->create();

    $response = $this->get(route('books.show', $book));

    $response
        ->assertStatus(201)
        ->assertJson($book->toArray());
});

it('can update a book', function () {
    $book = Book::factory()->create();
    $author = Author::factory()->create();

    $updatedBookData = Book::factory()->make(['authors' => [$author->id]])->toArray();

    $response = $this->put(route('books.update', $book), $updatedBookData);

    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'id',
            'title',
            'img_url',
            'description',
            'status',
            'publish_date',
            'authors',
            'created_at',
            'updated_at'
        ]);

});


it('can delete a book', function () {
    $book = Book::factory()->create();

    $response = $this->delete(route('books.destroy', $book));

    $response
        ->assertStatus(200)
        ->assertJson(['message' => 'Book deleted successfully']);

    $this->assertDatabaseMissing('books', ['id' => $book->id]);
});
