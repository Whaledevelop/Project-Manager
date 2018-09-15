<?php
  require_once $_SESSION['root']."/app/header/renderHeader.php";

  function renderPage(
    $pageContent = "", $pageTitle ="", 
    $pageHeader = "", $isWithHeader = true
  ) {
    return "
      <html lang=\"ru\">
      <head>
        <meta charset=\"UTF-8\">
        <title>".$pageTitle."</title>
        <link rel=\"stylesheet\" 
          href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" 
          integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" 
          crossorigin=\"anonymous\"
        >
        <link rel=\"stylesheet\" 
          href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\" 
          integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" 
          crossorigin=\"anonymous\"
        >
        <link rel=\"stylesheet\" 
          href=\"/css/style.css\"
        >
      </head>
      <body>
        ".($isWithHeader ? renderHeader() : "")."
        <div class=\"container-fluid\">
          <h4 class = \"pageHeader\">".$pageHeader."</h4>".
          $pageContent."
        </div>
      </body>
      </html>
    ";
  }
?>