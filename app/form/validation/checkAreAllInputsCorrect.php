<?php
  function checkAreAllInputsCorrect($inputsData) {
    $updativeInputsData = array_filter($inputsData, function($inputData) {
      return !$inputData['isService'];
    });

    $numbersOfStatuses = numbersOfColumnValues($inputsData, "status");
    $numbersOfUpdativeInputsStatuses = numbersOfColumnValues($updativeInputsData, 
      "status"
    );
    /*
      Пользователь будет изменен, если хотя бы одно обновляемое поле изменено, 
      оно корректно, и при этом остальные поля не пустые и не содержат ошибок
      (могут оставаться неизмененными).
    */
    if (
      $numbersOfUpdativeInputsStatuses['correct'] > 0 
      &&
      $numbersOfStatuses['correct'] + $numbersOfStatuses['Значение не изменено'] ==
      count($inputsData) 
    ) {
      return true;
    } else {
      return false;
    }
  }

  function numbersOfColumnValues($array, $column) {
    $columnValues = array_column($array, $column);
    return array_count_values($columnValues);
  }
?>