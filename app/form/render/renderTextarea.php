<?php
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