<?php
  define("RENDER_FORM_PATH", $_SESSION['root']."/app/form/render");
  require_once RENDER_FORM_PATH."/renderFormGroup.php";

  function renderFormWithValidation(
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