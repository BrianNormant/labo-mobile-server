<?php

require_once __DIR__.'/accessDB.php';

$body = file_get_contents('php://input');
$body = json_decode($body, true);

if (!isset($body["idCode"]) 
	|| !isset($body["record"])
	|| !isset($body["email"])) {
	http_response_code(417);
	exit;
}

$sth = $dbh->prepare("SELECT * FROM Code WHERE secret = ?;");
$sth->execute([$body["idCode"]]);
if ($sth->rowCount() == 0) {
	http_response_code(404);
	exit;
}


$sth = $dbh->prepare("SELECT * FROM Stat WHERE secret = ?;");
$sth->execute([$body["idCode"]]);
if ($sth->rowCount() == 0) {
	$sth = $dbh->prepare(<<<SQL
	INSERT INTO Stat (secret, nb_colors, record, email) VALUES (
		:secret,
		(SELECT nb_colors FROM Code WHERE secret = :secret LIMIT 1),
		:record,
		:email
	);
	SQL);
} else {
	$sth = $dbh->prepare(<<<SQL
	UPDATE Stat 
	SET record = :record,
		email  = :email
	WHERE secret = :secret AND :record < record;
	SQL);
}

$sth->execute([
	"record" => $body["record"],
	"email"  => $body["email"],
	"secret" => $body["idCode"]
]);
