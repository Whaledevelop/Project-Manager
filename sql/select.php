<?php
  require_once $_SESSION['root']."/sql/prepareKeyValuesPairsToSqlFormat.php";
  
  function select(
    string $table, array $conditions = [], 
    bool $isSelectOne = false, string $columns = "*"
  ) {
   
    $link = mysqli_connect("localhost", "root", "", "project_manager");
    mysqli_query($link, "SET NAMES utf8") or die(mysqli_error($link));

    $conditionsString = !empty($conditions)
      ? " WHERE ".prepareKeyValuesPairsToSqlFormat(" AND ", $conditions)
      : "";

    $query = "SELECT ".$columns." FROM ".$table.$conditionsString;

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    /*
      Если не были заданы условия, то нужны все элементы таблицы, если
      условия заданы и получен только один элемент, значит нужен был
      только один элемент
    */
    return $isSelectOne ? $data[0] : $data;
  }
?>