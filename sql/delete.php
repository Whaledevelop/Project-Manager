<?php
  require_once $_SESSION['root']."/sql/prepareKeyValuesPairsToSqlFormat.php";

  function delete(
    string $table, array $conditions, 
    string $conditionsDevider = "AND"
  ) {
    $link = mysqli_connect("localhost", "root", "", "project_manager");
    mysqli_query($link, "SET NAMES utf8") or die(mysqli_error($link));

    $devider = " ".$conditionsDevider." ";
    $conditionsStr = prepareKeyValuesPairsToSqlFormat($devider, $conditions);

    $query = "DELETE FROM ".$table." WHERE ".$conditionsStr;
    
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($result && $table == "users") {
      unset($_SESSION['user']);
    }
    return $result;
  }
?>