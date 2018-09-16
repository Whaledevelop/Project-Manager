<?php
  require_once $_SESSION['root']."/sql/select.php";
  
  function prepareRecipientsOptions() {
    $recipients = select("users");
    $options = [];
    foreach ($recipients as $recipient) {
      if ($recipient['id'] != $_SESSION['user']['id']) {
        $options[] = [
          "value" => $recipient['id'], 
          "label" => $recipient['name']
        ];
      } 
    }
    return $options;
  }
?>