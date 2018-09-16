<?php
  function validateRecipientIdValue($recipientId) {
    return !empty($recipientId) 
      ? "correct" 
      : "
        Укажите получателя
        среди зарегистрированных пользователей сайта
      ";
  }

?>