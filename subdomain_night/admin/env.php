<?php
return (object) [
    // Environment Type
    'ENVIRONMENT' => $_SERVER['HTTP_HOST'] === 'localhost' ? 'local' : 'live',
    'LOCAL' => 'local',
    'LIVE' => 'live',

    // Database Credentials
    'DB_HOST_LOCAL' => 'localhost',
    'DB_USER_LOCAL' => 'root',
    'DB_PASS_LOCAL' => '',
    'DB_NAME_LOCAL' => 'shillong_teer_db',

    'DB_HOST_LIVE' => 'localhost',
    'DB_USER_LIVE' => 'u138263012_root',
    'DB_PASS_LIVE' => 'slngtrRslt123*',
    'DB_NAME_LIVE' => 'u138263012_shillong_teer',

    // Base URLs
    'BASE_URL_LOCAL_DAY' => 'http://localhost/shillongteeresult',
    'BASE_URL_LOCAL_MORNING' => 'http://localhost/shillongteeresult/subdomain_morning',
    'BASE_URL_LOCAL_NIGHT' => 'http://localhost/shillongteeresult/subdomain_night',

    'BASE_URL_LIVE_DAY' => 'https://shillongteeresult.in',
    'BASE_URL_LIVE_MORNING' => 'https://morning.shillongteeresult.in',
    'BASE_URL_LIVE_NIGHT' => 'https://night.shillongteeresult.in',

    'DAY'=> 'day',
    'MORNING'=> 'morning',
    'NIGHT'=> 'night',
];