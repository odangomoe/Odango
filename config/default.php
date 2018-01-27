<?php

namespace Odango\Http;

use function BitCommunism\Doctrine\connections;
use function DI\add;
use function DI\string;

return array_merge(
    [
        'modules' => add([
            'twig',
            'http',
            'doctrine',
        ])
    ],
    connections([
        'default' => [
            'connection' => add([
                'dbname' => 'odangodb'
            ]),
            'entity-paths' => [
                string('{basedir}/src/Entity')
            ]
        ]
    ])
);
