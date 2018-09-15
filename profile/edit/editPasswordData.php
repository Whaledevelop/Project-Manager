<?php
  require_once $_SESSION['root']."/app/modules/generateCode.php";

  function editPasswordData($valuesForUpdate) {
    $passwordOriginal = $valuesForUpdate['password'];
    $salt = generateCode(6);
    $valuesForUpdate['password'] = md5($passwordOriginal.$salt);
    $valuesForUpdate['pass_reminder'] = $passwordOriginal;
    $valuesForUpdate['salt'] = $salt;
    return $valuesForUpdate;
  }
?>