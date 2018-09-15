<?php
  require_once $_SESSION['root']."/sql/prepareKeyValuesPairsToSqlFormat.php";

  function update(
    string $table, array $updateData, 
    array $conditions, string $conditionsDevider = "AND"
  ) {

    $link = mysqli_connect("localhost", "root", "", "project_manager");
    mysqli_query($link, "SET NAMES utf8") or die(mysqli_error($link));

    $updateData["last_update"] = date("Y-m-d H:i:s");

    $updateDataStr = prepareKeyValuesPairsToSqlFormat(", ", $updateData);
    $conditionsStr = prepareKeyValuesPairsToSqlFormat(
      " ".$conditionsDevider." ", $conditions);

    $query = "UPDATE ".$table." SET ".$updateDataStr." WHERE ".$conditionsStr;
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    return $result;
  }
?>