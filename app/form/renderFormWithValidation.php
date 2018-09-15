<?php
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

  function renderFormGroup($inputData) {
    switch ($inputData['element']) {
      case "input" : $formControl = renderInput($inputData);
        break;
      case "select" : $formControl = renderSelect($inputData);
        break;
      case "textarea" : $formControl = renderTextarea($inputData);
        break;
    } 
    
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

  function renderInput($inputData) {
    $valueAtr = !empty($inputData['value']) 
      ? "value = \"".$inputData['value']."\"" : "";
    return "
      <input 
        type=".$inputData['type']." name=".$inputData['name']."
        class=\"form-control col-lg-5 ".$inputData['class']."\" 
        ".$valueAtr.">
    ";
  }

  function renderSelect($inputData) {
    $optionsStr = "<option></option>";
    foreach ($inputData['options'] as $option) {
      $optionsStr .= "
        <option 
          value=\"".$option['value']."\"".
          ($option['value'] == $inputData['value'] ? " selected" : "")."
        >".
          $option['label']."
        </option>
      ";
    }
    return "
      <select 
        name=\"".$inputData['name']."\" 
        class=\"form-control col-lg-5 ".$inputData['class']."\"
      >".
        $optionsStr."
      </select>
    ";
  }

  function renderTextarea($inputData) {
    return "
      <textarea 
        name=".$inputData['name']." rows=\"3\"
        class=\"form-control col-lg-5 ".$inputData['class']."\"
      >".
        $inputData['value']."
      </textarea>
    ";
  }
?>