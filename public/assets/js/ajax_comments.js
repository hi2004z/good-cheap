$(document).ready(function() {
    // Lấy saleNewId từ thuộc tính data-* của phần tử
    var saleNewId = $('#comments-container').data('sale-new-id');

    // Kiểm tra nếu không có bình luận
    function checkNoComments() {
        if ($('#comment-list').children().length === 0) {
            $('#comment-list').html('<p>No comments yet.</p>'); // Hiển thị thông báo nếu không có bình luận
        }
    }

    // Kiểm tra ngay khi load trang
    checkNoComments();

    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        var content = $('#content').val();

        $.ajax({
            url: '/comments/store/' + saleNewId,
            type: 'POST',
            data: JSON.stringify({
                _token: $('meta[name="csrf-token"]').attr('content'),
                content: content
            }),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    var newComment = response.comment;
                    var newUser = response.user;
                    var createdAt = response.created_at;

                    var commentHtml = ` 
                        <div class="comment comments-main" id="comment-${newComment.comment_id}">
                            <div class="comment-header">
                                <strong>${newUser}</strong>
                            </div>
                            <p class="comment-content">${newComment.content}</p>

                            <!-- Nút reply -->
                            <div class="comment-actions">
                                <span class="comment-days">${createdAt}</span>
                                <button class="btn btn-reply" onclick="toggleReplyForm(${newComment.comment_id}, '${newUser}')">
                                    <i class="fas fa-reply"></i> Reply
                                </button>
                            </div>

                            <!-- Reply form -->
                            <div id="reply-form-${newComment.comment_id}" class="reply-form" style="display:none;">
                                <form class="reply-form-submit" data-parent-id="${newComment.comment_id}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" rows="2" placeholder="Type your reply here..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Reply</button>
                                </form>
                            </div>
                        </div>
                    `;
                    $('#comment-list').prepend(commentHtml);  // Thêm comment mới vào đầu danh sách
                    $('#content').val('');  // Xóa textarea

                    // Ẩn thông báo "No comments yet" nếu có bình luận
                    if ($('#comment-list').children().length > 0) {
                        $('#comment-list').children('p').remove(); // Xóa thông báo "No comments yet"
                    }

                    // Hiển thị thông báo thành công dạng toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Comment added successfully!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    // Hiển thị thông báo lỗi dạng toast
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to add comment!',
                        text: response.message || 'Please try again.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);  // Kiểm tra lỗi từ server
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to add comment!',
                    text: 'Something went wrong. Please try again.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    });
});


    // Gửi reply mới
    $('.reply-form-submit').on('submit', function(e) {
        e.preventDefault();
        var parentId = $(this).data('parent-id');
        var content = $(this).find('textarea').val();

        $.ajax({
            url: '/comments/reply/' + parentId,
            type: 'POST',
            data: JSON.stringify({
                _token: $('meta[name="csrf-token"]').attr('content'),
                content: content
            }),
            contentType: 'application/json',
            success: function(response) {
                if (response.status === 'success') {
                    var newReply = response.comment;
                    var newUser = response.user;
                    var replyHtml = `
                        <div class="reply" id="reply-${newReply.comment_id}">
                            <strong>${newUser}</strong> ${newReply.content}
                        </div>
                    `;
                    $('#replies-' + parentId).append(replyHtml);  // Thêm reply mới vào phần replies
                    $('#reply-content-' + parentId).val('');  // Xóa textarea
                    $('#reply-form-' + parentId).hide();  // Ẩn form reply
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);  // Kiểm tra lỗi từ server
                alert('Something went wrong. Please try again.');
            }
        });
    });
 

// Toggle visibility of replies
function toggleReplies(commentId) {
    const repliesContainer = document.getElementById('replies-' + commentId);
    const viewRepliesButton = document.querySelector(`button[onclick="toggleReplies(${commentId})"]`);

    // Toggle visibility
    if (repliesContainer.style.display === 'none') {
        repliesContainer.style.display = 'block';
        viewRepliesButton.textContent = 'Hide replies';  // Đổi nội dung nút thành 'Hide replies'
    } else {
        repliesContainer.style.display = 'none';
        viewRepliesButton.textContent = 'View all replies';  // Đổi nội dung nút thành 'View all replies'
    }
}

// Toggle reply form visibility
function toggleReplyForm(commentId, commenterName) {
    const replyForm = document.getElementById('reply-form-' + commentId);
    const isFormVisible = replyForm.style.display === 'block';

    const allReplyForms = document.querySelectorAll('.reply-form');
    allReplyForms.forEach(form => {
        form.style.display = 'none';
    });

    if (!isFormVisible) {
        replyForm.style.display = 'block';
        const textarea = replyForm.querySelector('textarea');
        const replyText = `@${commenterName}, `;
        if (!textarea.value.startsWith(replyText)) {
            textarea.value = replyText;
        }
        textarea.focus();
    }
}  
 
