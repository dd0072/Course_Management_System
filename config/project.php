<?php

use App\Models\AdminUser;
use App\Models\Resource;

return [
    'admin' => [
        'state' => [
            AdminUser::NORMAL => '<span class="text-success">正常</span>',
            AdminUser::BAN => '<span class="text-danger">禁用</span>',
        ]
    ],

    'resource' => [
        'type' => [
            Resource::VIDEO => '<span class="text-primary"><i class="fas fa-file-video"></i>视频</span>',
            Resource::DOC => '<span class="text-secondary"><i class="fas fa-file-word"></i>文档</span>',
        ]
    ]
];
