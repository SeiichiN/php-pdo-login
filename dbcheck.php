<?php
// dbcheck.php
//

require_once('db_connect.php');

function dbcheck($db)
{
  $pdo = db_connect($db);
  try {
    $sql = "CREATE TABLE IF NOT EXISTS dbuser ";
    $sql = $sql . "(id int(10) NOT NULL AUTO_INCREMENT, ";
    $sql = $sql . "name varchar(50) NOT NULL, ";
    $sql = $sql . "password varchar(255) NOT NULL, ";
    $sql = $sql . "PRIMARY KEY (id) ";
    $sql = $sql . ")";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    // var_dump($stmt);
    // echo "テーブルを作成しました\n";
  } catch (PDOException $e) {
    if ($e->getCode() === 1049) {
      makedb($db);
    }
    echo "接続失敗: " . $e->getCode() . ":" . $e->getFile() . ":" . $e->getLine() . ": " . $e->getMessage() . "\n";
    exit();
  }
}

function makedb($db)
{
  $dsn = "mysql:host={$db['host']};charset=utf8";
  try {
    $pdo = new PDO($dsn, $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS :dbname "
      . " DEFAULT CHARACTER SET utf8";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':dbname', $db['dbname'], PDO::PARAM_STR);
    $stmt = $stmt->execute();
    $mes = "データベースを作成しました<br>\n";
    $_SESSION['mes'] = $mes;
    // var_dump($stmt);
    $stmt = null;
  } catch (PDOException $e) {
    echo "データベースを作成できません<br>\n";
  } finally {
    $dsn = null;
  }
  header("Location: login.php");
}


/* 修正時刻： Sat 2023/10/07 13:53:470 */
