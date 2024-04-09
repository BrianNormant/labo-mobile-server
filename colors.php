<?php

require_once __DIR__.'/accessDB.php';

$sth = $dbh->query("SELECT * FROM Color;");

$colors = $sth->fetchAll(PDO::FETCH_ASSOC);

$colors = array_reduce($colors, function ($colors, $color) {
	$colors[]= $color['rgba'];
	return $colors;
}, []);

header('Content-Type: application/json');
echo json_encode(array( "liste" => $colors));
