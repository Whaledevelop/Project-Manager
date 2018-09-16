<?php
  require_once __DIR__."/renderInput.php";
  require_once __DIR__."/renderSelect.php";
  require_once __DIR__."/renderTextarea.php";

  function renderFormGroup($inputData) {
    $renderFunctionName = "render".ucfirst($inputData['element']);
    $formControl = call_user_func($renderFunctionName, $inputData);

    return "
      <div class='form-group'>
        <label>".$inputData['label']." : </label>
        <div class = \"container row\">".
          $formControl."
          <span class=\"col-lg-7\">".
            ($inputData['status'] === "correct" ? "" : $inputData['status']).
          "</span>
        </div>
      </div>
    ";
  }
?>