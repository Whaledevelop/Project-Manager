<?php
  require_once RENDER_FORM_PATH."/renderInput.php";
  require_once RENDER_FORM_PATH."/renderSelect.php";
  require_once RENDER_FORM_PATH."/renderTextarea.php";

  function renderFormGroup($inputData) {
    $renderFunctionName = "render".ucfirst($inputData['element']);
    $formControl = call_user_func($renderFunctionName, $inputData);
    
    return "
      <div class='form-group'>
        <label>".$inputData['label']." : </label>
        <div class = \"container row\">".
          $formControl."
          <span class=\"col-lg-7\">".(
            $inputData['status'] === "correct" ? "" : $inputData['status']
          )."</span>
        </div>
      </div>
    ";
  }
?>