<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using
    | the convention "attribute.rule" to name the lines. This makes it quick
    | to specify a specific custom language line for a given attribute rule.
    |
    */

    'required' => 'This field is required.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'The :attribute has already been taken.',
    'confirmed' => 'The :attribute confirmation does not match.',
    // Thêm các thông báo lỗi tùy chỉnh khác tại đây.
    'custom' => [
        // Bạn có thể thêm thông báo tùy chỉnh cho các trường hợp cụ thể ở đây.
    ],
    'attributes' => [
        // Đặt tên các trường (attribute) của bạn tại đây, ví dụ:
        'content' => 'Content',
        'email' => 'Email Address',
    ],
];
