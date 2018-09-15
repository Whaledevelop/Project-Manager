<?php
  function validateLoginValue($login) {
    if (!empty($login)) {
      $isLoginEng = preg_match("#^ [a-z0-9]+ $#ixs", trim($login));
      if ($isLoginEng) {
        $isLoginOccupied = checkIsLoginOccupied(trim($login));
        return $isLoginOccupied ? "Логин занят" : "correct";
      } else {
        return "Логин должен содержать
          только латиницу и цифры";
      } 
    } else {
      return "Введите логин";
    } 
  }

  function checkIsLoginOccupied($login) {
    $link = mysqli_connect("localhost", "root", "", "test");
    mysqli_query($link, "SET NAMES utf8") or die(mysqli_error($link));
    $query = "SELECT * FROM users WHERE login=\"".$login."\"";
    $result = mysqli_query($link, $query);
    if (is_array(mysqli_fetch_assoc($result))) {
      return true;
    } else return false;
  }

?>