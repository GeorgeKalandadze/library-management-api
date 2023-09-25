<?php

use App\Enums\BookStatus;
use App\Models\Author;
use App\Models\Book;

it('can create a book', function () {
    $book = Book::factory()->create();

    expect($book)->toBeInstanceOf(Book::class);
});

it('can retrieve books with a specific status', function () {
    $book = Book::factory()->create([
        'status' => BookStatus::AVAILABLE->value,
    ]);

    $bookedBook = Book::factory()->create([
        'status' => BookStatus::BOOKED->value,
    ]);

    $availableBooks = Book::available()->get();
    $bookedBooks = Book::booked()->get();

    expect($availableBooks->count())->toBe(1);
    expect($bookedBooks->count())->toBe(1);
});

it('can retrieve authors associated with a book', function () {
    $book = Book::factory()->create();
    $author = Author::factory()->create();

    $book->authors()->attach($author);

    $authors = $book->authors;

    expect($authors->count())->toBe(1);
    expect($authors->first())->toBeInstanceOf(Author::class);
});
