<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function index(): Response
    {

        $booksQuery = QueryBuilder::for(Book::class)
            ->allowedFilters([
                AllowedFilter::exact('title'),
                AllowedFilter::exact('authors.name'),
            ])
            ->with('authors')
            ->get();

        return $this->ok(BookResource::collection($booksQuery));
    }

    public function store(BookRequest $request): Response
    {
        $book = Book::create($request->validated());
        $book->authors()->attach($request->validated('authors'));
        $book->load('authors');

        return $this->created(new BookResource($book));
    }

    public function show(Book $book): Response
    {
        $book->load('authors');

        return $this->ok(new BookResource($book));
    }

    public function update(BookRequest $request, Book $book): Response
    {

        $book->update($request->validated());
        $book->authors()->sync($request->validated('authors'));
        $book->load('authors');

        return $this->ok(new BookResource($book));
    }

    public function destroy(Book $book): Response
    {
        $book->authors()->detach();
        $book->delete();

        return $this->noContent();
    }
}
