<?php
  function prepareAddMessageData($inputsData) {
    $addMessageData = [];
    foreach($inputsData as $inputName => $inputData) {
      if ($inputName == "recipientId") {
        $addMessageData["recipient_id"] = $inputData['value'];
      } else {
        $addMessageData[$inputName] = $inputData['value'];
      }      
    }
    $addMessageData['isRead'] = 0;
    $addMessageData['sender_id'] = $_SESSION['user']['id'];
    $addMessageData['send_time'] = date("Y-m-d H:i:s");
    return $addMessageData;
  }
?>