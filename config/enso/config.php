<?php

use App\Classes\LocalState;

return [
    'version' => '3.2.0',
    'showQuote' => true,
    'stateBuilder' => LocalState::class,
    'defaultRole' => 'admin',
    'dateFormat' => 'd-m-Y',
    'paths' => [
        'files' => 'files',
        'avatars' => 'avatars',
        'imports' => 'imports',
        'exports' => 'exports',
        'howToVideos' => 'howToVideos',
    ],
    'facebook' => 'https://facebook.com',
    'googleplus' => 'https://plus.google.com',
    'twitter' => 'https://twitter.com',
    'ravenKey' => env('RAVEN_DSN', null),
    'cacheLifetime' => env('CACHE_LIFETIME', 60),
    'ensoApiToken' => env('ENSO_API_TOKEN', null),
    'extendedDocumentTitle' => false,
];
