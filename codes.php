<?php

require_once __DIR__.'/accessDB.php';

function r_fuc($ac, $r) {
	if (!isset($ac[$r["secret"]])) {
		$ac[$r["secret"]] = array(
			"id" => $r["secret"],
			"code" => array($r["color"]),
			"nbCouleurs" => $r["nb_colors"],
		);
	} else {
		$ac[$r["secret"]]["code"] []= $r["color"];
	}
	return $ac;
}

if (isset($_REQUEST["nbCouleurs"])) {
	$nb_col = $_REQUEST["nbCouleurs"];

	$sth = $dbh->prepare(<<<SQL
	SELECT * FROM Code WHERE nb_colors = ?
	ORDER BY secret, position;
	SQL);
	$sth->execute([$nb_col]);
} else {
	$sth = $dbh->query(<<<SQL
	SELECT * FROM Code ORDER BY secret, position;
	SQL);
}


$data = $sth->fetchAll(PDO::FETCH_ASSOC);
$data = array_reduce($data, "r_fuc", []);

header("Content-Type: application/json");
echo json_encode($data);
