<?php
  function validatePasswordConfirmValue($passwordConfirm, $password) {
    if (!empty($password)) {
      if (!empty($passwordConfirm)) {
        if ($password == $passwordConfirm) {
          return "correct";
        } else {
          return "Пароли не совпадают";
        }
      } else {
        return "Продублируйте пароль";
      }
    } else {
      return "Введите пароль";
    }
  }
?>