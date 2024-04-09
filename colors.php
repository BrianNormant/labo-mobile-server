<?php

require_once __DIR__.'/accessDB.php';

$sth = $dbh->query("SELECT * FROM Color;");
