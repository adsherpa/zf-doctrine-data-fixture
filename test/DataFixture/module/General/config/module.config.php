<?php

declare(strict_types=1);

namespace Db;

use General\Listener\EventCatcher;

return [
    'service_manager' => [
        'invokables' => [
            EventCatcher::class,
        ],
    ],
];
