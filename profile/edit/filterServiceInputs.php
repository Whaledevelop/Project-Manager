<?php
  function filterServiceInputs($inputsData) {
    $updateableInputs = array_filter($inputsData, function($inputData) {
      return !$inputData['isService'];
    });
    $names = array_column($updateableInputs, "name");
    $values = array_column($updateableInputs, "value");
    $keyValues = array_combine($names, $values);
    return $keyValues;
  }
?>