<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index(): Response
    {
        $authors = Author::all();

        return $this->ok(AuthorResource::collection($authors));
    }

    public function store(Request $request): Response
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $author = Author::create($request->only('name'));

        return $this->created(new AuthorResource($author));
    }

    public function show(Author $author): Response
    {
        return $this->ok(new AuthorResource($author));
    }

    public function update(Request $request, Author $author): Response
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $author->update($request->only('name'));

        return $this->ok(new AuthorResource($author));
    }

    public function destroy(Author $author): Response
    {
        $author->delete();

        return $this->noContent();
    }
}
