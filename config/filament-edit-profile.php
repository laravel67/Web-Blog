<?php

return [
    'avatar_column' => 'avatar_url',
    'disk' => env('FILESYSTEM_DISK', 'public'),
    'visibility' => 'public',
    'fields' => [
        'name' => true,
        'email' => true,
        'username' => true,  // Pastikan ini ada
        'bio' => true,       // Pastikan ini ada
        'avatar' => true,
    ],
];
