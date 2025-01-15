<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\SaleNews;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $saleNewId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'sale_new_id' => $saleNewId,
            'parent_id' => null,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function reply(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $parentComment = Comment::findOrFail($commentId);

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'sale_new_id' => $parentComment->sale_new_id,
            'parent_id' => $commentId,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully!');
    }
}
