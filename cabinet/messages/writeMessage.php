<?php
  session_start();
  require_once $_SESSION['root']."/app/form/prepareFormData.php";
  require_once $_SESSION['root']."/app/form/checkAreAllInputsCorrect.php";
  require_once $_SESSION['root']."/app/form/renderFormWithValidation.php";
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/sql/add.php";
  

  $neededInputsNames = ["recipient_id", "theme", "text"];

  $enteredValues = [];
  foreach ($_POST as $key => $value) {
    $enteredValues[$key] = strip_tags($value);
  }
  $initialData = !empty($_GET['recipient_id']) 
    ? ['recipient_id' => $_GET['recipient_id']] 
    : []; 
  $inputsData = prepareFormData($neededInputsNames, $enteredValues, $initialData);
  if (checkAreAllInputsCorrect($inputsData)) {
    $addMessageData = [];
    foreach($inputsData as $inputName => $inputData) {
      $addMessageData[$inputName] = $inputData['value'];
    }
    $addMessageData['isRead'] = 0;
    $addMessageData['sender_id'] = $_SESSION['user']['id'];
    $addMessageData['send_time'] = date("Y-m-d H:i:s");
    define("MESSAGES_TABLE", "messages");
    if (add(MESSAGES_TABLE, $addMessageData)) {
      $formStatus = "Сообщение успешно отправлено";
    }
  }
  $writeMessagePageContent = renderFormWithValidation($inputsData, "Отправить", $formStatus);
  define("PAGE_TITLE", "Написать сообщение");
  echo renderPage($writeMessagePageContent, PAGE_TITLE);
?>