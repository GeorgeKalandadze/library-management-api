<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetAuthorController extends Controller
{
    public function __invoke(): ResourceCollection
    {
        $authors = Author::all();
<<<<<<< HEAD

=======
>>>>>>> origin/main
        return AuthorResource::collection($authors);
    }
}
