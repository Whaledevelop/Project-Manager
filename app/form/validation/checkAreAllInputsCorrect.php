<?php
  function checkAreAllInputsCorrect($inputsData) {
    $inputStatuses = array_column($inputsData, "status");
    $numberOfStatuses = array_count_values($inputStatuses);
    /*
      Пользователь будет изменен, если хотя одно поле изменено и оно корректно,
      и при этом остальные поля не содержат ошибок (могут оставаться неизмененными).
    */
    if (
      $numberOfStatuses['correct'] > 0 &&
      $numberOfStatuses['correct'] + $numberOfStatuses['Значение не изменено'] ==
      count($inputsData) // некоторые статусы могут быть пустыми из-за пустых инпутов, поэтому
      // проверка по числу инпутов, а не статусов
    ) {
      return true;
    } else {
      return false;
    }
  }
?>