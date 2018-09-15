<?php
function generateCode($length) {
  $code = '';
  for($i = 0; $i < $length; $i++) {
    $code .= chr(mt_rand(97,122)); 
  }
  return $code;
}
?>