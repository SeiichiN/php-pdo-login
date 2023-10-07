<?php 

function db_connect($db) {
  $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
  try {
    $pdo = new PDO( $dsn, $db['user'], $db['pass'] );
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    exit('データベースに接続できません' . $e->getMessage());
  }
  return $pdo;
}


// 修正時刻: Sat 2023/10/07 13:53:47
