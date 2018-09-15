<?php
  function sendVerificationMail($user) {
    $to = $user['email'];
    $subject = "Verification";
    $linkParams = "verification_code=".$user['verification_code'].
      "&login=".$user['login']."\"";
    $projectName = $_SERVER['HTTP_HOST'];

    $linkHref = $projectName."/verification/verify.php?".$linkParams;

    $message = "
      <h4>Вы успешно зарегистрировались</h4>
      <p>Ваши данные:</p>
      <ul>
        <li>Логин : ".$user['login']."</li>
        <li>Имя : ".$user['name']."</li>
        <li>Почта : ".$user['email']."</li>
        <li>Пароль : ".$user['pass_reminder']."</li>
      </ul>
      <a href = \"".$linkHref."\">
        Пройти верификацию аккаунта
      </a>
    ";
    $headers = [
      'MIME-Version' => '1.0',
      'Content-type' => 'text/html; charset=iso-8859-1',
      'From' => 'whaleevolve@gmail.com',
      'Reply-To' => 'whaleevolve@gmail.com',
      'X-Mailer' => 'PHP/' . phpversion()
    ]; 
    return mail($to, $subject, $message, $headers);
  }
?>