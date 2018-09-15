<?php
  function add(string $table, array $keyValues) {

    $link = mysqli_connect("localhost", "root", "", "project_manager");
    mysqli_query($link, "SET NAMES utf8") or die(mysqli_error($link));

    $keys = array_keys($keyValues);
    $values = array_values($keyValues);
    $keysStr = implode(", ", $keys);
    $valuesStr = "\"".implode("\", \"", $values)."\""; 
    
    $query = "INSERT INTO ".$table." (".$keysStr.") VALUES (".$valuesStr.")";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    return $result;
  }
?>