<?php
  require_once $_SESSION['root']."/sql/select.php";

  function prepareSelectData($selectData, $enteredValues, $initialValues) {
    if ($selectData['optionsSubject'] == "recipients") {
      $recipients = select("users");
      $options = [];
      foreach ($recipients as $rec) {
        if ($rec['id'] != $_SESSION['user']['id']) {
          $options[] = ["value" => $rec['id'], "label" => $rec['name']];
        } 
      }
      $selectData['options'] = $options;

      if (!empty($enteredValues)) {
        $selectData['value'] = $enteredValues[$selectData['name']];
        $selectData['status'] = !empty($selectData['value']) 
          ? "correct" 
          : "
            Укажите получателя
            среди зарегистрированных пользователей сайта
          ";
        $selectData['class'] = $selectData['status'] == "correct" 
          ? "correct" : "noncorrect";
      } else {
        $selectData['value'] = $initialValues[$selectData['name']];
      }
    }
    return $selectData;
  }
?>