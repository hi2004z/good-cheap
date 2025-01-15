<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'sale_new_id',
        'user_id',
        'parent_id',
        'reply_to_user_id',
        'content',
    ];

    // Quan hệ với sản phẩm (sale_news)
    public function saleNew()
    {
        return $this->belongsTo(SaleNew::class, 'sale_new_id');
    }

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    

    // Quan hệ với bình luận cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Quan hệ với các bình luận con
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Quan hệ với người được trả lời
    public function replyToUser()
    {
        return $this->belongsTo(User::class, 'reply_to_user_id');
    }
}
