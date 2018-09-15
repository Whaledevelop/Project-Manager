<?php
  session_start();
  session_destroy();
  setcookie("key", "", time(), "/");
  setcookie("login", "", time(), "/");
  header("Location: /");
?>