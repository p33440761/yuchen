<?php

include __DIR__ . '/parts/config.php';

$a_sql = "SELECT * FROM `members` WHERE `id`=9";
$a_stmt = $pdo->query($a_sql);

$row = $a_stmt->fetch();
$_SESSION['user'] = $row;
print_r($_SESSION['user']);
