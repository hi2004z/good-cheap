<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store comment
    public function getAllComments($saleNewId)
{
    $comments = Comment::where('sale_new_id', $saleNewId)
        ->whereNull('parent_id')
        ->with('replies.user', 'user')
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json([
        'comments' => $comments,
        'totalComments' => $comments->count()
    ]);
}

    public function store(Request $request, $saleNewId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
            'sale_new_id' => $saleNewId,
            'parent_id' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment added successfully!',
            'comment' => $comment,
            'user' => Auth::user()->full_name,  // Trả về tên người dùng
            'created_at' => $comment->created_at->diffForHumans(), // Thời gian tạo comment
        ]);
    }

    // Reply to comment
    public function reply(Request $request, $commentId)
    {
        try {
            $request->validate([
                'content' => 'required|string',
            ]);
    
            $parentComment = Comment::findOrFail($commentId);
    
            // Kiểm tra xem có phải trả lời một reply không
            $parentId = $parentComment->parent_id ? $parentComment->parent_id : $parentComment->comment_id;
    
            $comment = new Comment();
            $comment->content = $request->input('content');
            $comment->sale_new_id = $parentComment->sale_new_id;
            $comment->user_id = auth()->id();
            $comment->parent_id = $parentId;
            $comment->save();
    
            // Thêm thông báo thành công vào session
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Reply has been added successfully!'
            ]);
    
            // Redirect về trang trước
            return redirect()->back();
        } catch (\Exception $e) {
            // Thêm thông báo lỗi vào session
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Failed to add reply! Error: ' . $e->getMessage()
            ]);
    
            // Redirect về trang trước
            return redirect()->back();
        }
    }
    
    
}
