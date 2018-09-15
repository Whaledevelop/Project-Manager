<?php
  function prepareKeyValuesPairsToSqlFormat(string $devider, array $keyValuesPairs) {
    $keyValuesStrings = [];

    foreach($keyValuesPairs as $key => $value) {
      if (is_array($value)) {
        foreach ($value as $elem) {
          $keyValuesStrings[] = $key." = \"".$elem."\"";
        }
      } else {
        $keyValuesStrings[] = $key." = \"".$value."\"";
      } 
    }
    return implode($devider, $keyValuesStrings);
  }
?>