<?php

require_once __DIR__.'/router.php';

get('/couleursDisponibles',  'colors.php');
get('/colors',  'colors.php');
get('/codesSecrets',         'codes.php');
get('/codes',         'codes.php');
get('/stats',                'stats.php');
put('/stats',                'update_stat.php');

any('/404','views/404.php');
