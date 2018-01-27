<?php

return [
    '/' => [\Odango\Http\Handler\Home::class, 'home'],
    '/torrents/{animeId}/{animeTitle}' => [\Odango\Http\Handler\Home::class, 'showTorrents'],

    # API
    '/api/title' => [\Odango\Http\Handler\Title::class, 'search'],
    '/api/title/{animeId}' => [\Odango\Http\Handler\Title::class, 'get'],
    '/api/torrent/by-anime/{animeId}'  => [\Odango\Http\Handler\Torrent::class, 'byAnimeId']
];