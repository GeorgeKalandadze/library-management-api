<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function index(): ResourceCollection
    {
        //        $books = Book::with('authors')->get();
        //
        //        return BookResource::collection($books);

        $booksQuery = QueryBuilder::for(Book::class)
            ->allowedFilters([
                AllowedFilter::exact('title'),
                AllowedFilter::exact('authors.name'),
            ])
            ->with('authors')
            ->get();

        return BookResource::collection($booksQuery);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::create($request->all());
        $book->authors()->attach($request->authors);
        $book->load('authors');

        return response()->json(new BookResource($book), 201);
    }

    public function show(Book $book): JsonResponse
    {
        $book->load('authors');

        return response()->json(new BookResource($book), 201);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {

        $book->update($request->all());
        $book->authors()->sync($request->authors);
        $book->load('authors');

        return response()->json(new BookResource($book), 201);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->authors()->detach();
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
