<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchPostController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');
        if (strlen($query) < 3) {
            return view('search', ['results' => collect([])]);
        }
        $results = Post::whereHas('comments', function ($q) use ($query) {
            $q->where('body', 'like', '%' . $query . '%');
        })->with(['comments' => function ($q) use ($query) {
            $q->where('body', 'like', '%' . $query . '%');
        }])->get();
        return view('search', ['results' => $results]);
    }
}
