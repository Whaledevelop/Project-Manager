<?php
  require_once __DIR__."/renderFormGroup.php";

  function renderForm(
    $inputsData, $buttonValue = "Подтвердить", $formStatus = ""
  ) {
    $inputsString = "";
    foreach ($inputsData as $inputData) {
      $inputsString .= renderFormGroup($inputData);
    }
    return "
      <form action=\"\" method=\"post\">
        ".$inputsString."
        <p>
          <button type=\"submit\" class=\"btn btn-primary\">
            ".$buttonValue."
          </button>
        </p>
      </form>
      <p>".$formStatus."</p>
    ";
  }
?>