<?php
// dbcheck.php
//

$db = array();


function dbcheck ($db) {
  $dsn = "mysql:host=" . $db['host'] . "; dbname=" . $db['dbname'] . "; charset=utf8";
  // echo "dsn: $dsn<br>\n";
  try {
    $pdo = new PDO( $dsn, $db['user'], $db['pass'] );
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "CREATE DATABASE IF NOT EXISTS " 
    //     . $db[dbname] 
    //     . " DEFAULT CHARACTER SET utf8";
    // // echo $sql; echo "<br>\n";
    // $stmt = $pdo->query($sql);
    // echo "データベースを作成しました<br>\n";
    // var_dump($stmt);
    $sql = "CREATE TABLE IF NOT EXISTS $db[dbtable] ";
    $sql = $sql . "(`id` int(10) NOT NULL AUTO_INCREMENT, ";
    $sql = $sql . "`name` varchar(50) NOT NULL, ";
    $sql = $sql . "`password` varchar(255) NOT NULL, ";
    $sql = $sql . "PRIMARY KEY (`id`) ";
    $sql = $sql . ") ENGINE=InnoDB DEFAULT CHARSET=utf8 ";
    $sql = $sql . "COLLATE=utf8_general_ci"; 
    $stmt = $pdo->query($sql);
    // var_dump($stmt);
    // echo "テーブルを作成しました\n";
  } catch (PDOException $e) {
    echo "接続失敗: " . $e->getLine() . ": " . $e->getMessage() . "\n";
    exit();
  }
}

