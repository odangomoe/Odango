<?php

include __DIR__ . '/vendor/autoload.php';

$connection = getenv('MARX_CONNECTION') ?: 'default';

return \BitCommunism\Marx\Instance::create(__DIR__)->doctrine($connection);