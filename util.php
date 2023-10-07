<?php
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function print_pre ($arr) {
?>
  <pre>
    <?php print_r($arr); ?>
  </pre>
<?php 
}

function pre_dump ($var) {
?>
  <pre>
    <?php var_dump($var); ?>
  </pre>
<?php 
}

// 修正時刻: Sat 2023/10/07 13:53:47
