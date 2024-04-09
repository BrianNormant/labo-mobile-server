<?php

require_once __DIR__.'/accessDB.php';

$sth = $dbh->query("SELECT * FROM Color;");

$colors = $sth->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($colors);
