<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'comment_text' => 'required|string',
        ]);

        Comment::create([
            'product_id'   => $request->product_id,
            'user_id'      => Auth::id(),
            'comment_text' => $request->comment_text,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}