<?php
  session_start();
  define("FORM_FOLDER_PATH", $_SESSION['root']."/app/form");
  require_once FORM_FOLDER_PATH."/inputsPreparation/prepareFormData.php";
  require_once FORM_FOLDER_PATH."/validation/checkAreAllInputsCorrect.php";
  require_once FORM_FOLDER_PATH."/render/renderForm.php";

  require_once $_SESSION['root']."/app/renderPage.php";

  require_once __DIR__."/prepareAddMessageData.php";
  require_once __DIR__."/prepareRecipientsOptions.php";

  require_once $_SESSION['root']."/sql/add.php";
  
  $neededInputsNames = ["recipientId", "theme", "text"];

  $initialValues = !empty($_GET['recipientId']) 
    ? ['recipientId' => $_GET['recipientId']] 
    : []; 

  $inputsData = prepareFormData($neededInputsNames, $_POST, true, $initialValues);
  if (checkAreAllInputsCorrect($inputsData)) {
    $addMessageData = prepareAddMessageData($inputsData);
    
    define("MESSAGES_TABLE", "messages");
    if (add(MESSAGES_TABLE, $addMessageData)) {
      $formStatus = "Сообщение успешно отправлено";
    }
  }
  $inputsData['recipientId']['options'] = prepareRecipientsOptions();
  $writeMessagePageContent = renderForm($inputsData, "Отправить", $formStatus, true);
  define("PAGE_TITLE", "Написать сообщение");
  echo renderPage($writeMessagePageContent, PAGE_TITLE);
?>