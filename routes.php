<?php

require_once __DIR__.'/router.php';

get('/couleursDisponibles',  'colors.php');
get('/codesSecrets',         'codes.php');
get('/stats',                'stats.php');

any('/404','views/404.php');
