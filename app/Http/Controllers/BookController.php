<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookController extends Controller
{
    public function index(): ResourceCollection
    {
        $books = Book::with('authors')->get();

        return BookResource::collection($books);
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
