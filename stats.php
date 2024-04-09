<?php

require_once __DIR__.'/accessDB.php';

$sth = $dbh->query("SELECT * FROM Stat;");

$stats = $sth->fetchAll(PDO::FETCH_ASSOC);

$stats = array_map(fn($row) => array( 
	"id"       =>  $row["id"],
	"idCode"   =>  $row["secret"],
	"record"   =>  $row["record"],
	"couriel"  =>  $row["email"],),
$stats);


header('Content-Type: application/json');
echo json_encode(array( "liste" => $stats));
