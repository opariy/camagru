<?php
session_start();
require_once('database.php');
$sql = file_get_contents('query.sql');
try {
    $dsn = "mysql:host=" . DB_HOST . ";charset=utf8";
    $db = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (\PDOException $e) {
    echo $e->getMessage();
}
$res = $db->query($sql);

echo "
<h4>DB re-created</h4>
<a href='/'>Go to project!</a>
";