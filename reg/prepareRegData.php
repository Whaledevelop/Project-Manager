<?php
  require_once $_SESSION['root']."/app/modules/generateCode.php";
  
  function prepareRegData($regData) {
    $passwordOriginal = trim($regData['password']);
    $salt = generateCode(6);
    $password = md5($passwordOriginal.$salt);
    $verificationCode = generateCode(16);
    return [
      "name" => trim($regData['name']),
      "email" => trim($regData['email']),
      "login" => trim($regData['login']),
      "password" => $password,
      "pass_reminder" => $passwordOriginal,
      "salt" => $salt,
      "isVerified" => 0,
      "verification_code" => $verificationCode,
      "registration_time" => date("Y-m-d H:i:s")
    ];
  }
?>