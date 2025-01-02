<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/variables.php';
require $serverRoot . '/functions.php';
$CLIENT_NAME = "[Client Name]";
$CLIENT_EMAIL = "[Client Email]";

$CLIENT_SIGNATURE = isset($_POST['client_signature']) ? $_POST['client_signature'] : null;
if ($CLIENT_SIGNATURE && substr($CLIENT_SIGNATURE, 0, 22) === 'data:image/png;base64,') {
    $CLIENT_SIGNATURE = '<img id="hk" src="' . htmlspecialchars($CLIENT_SIGNATURE) . '" >';
}

$current_file_name  = basename($_SERVER["PHP_SELF"]) ? basename($_SERVER["PHP_SELF"]) : "index.php";
$CONTRACT_HTML = str_replace('[Client Name2]', $CLIENT_NAME, $CONTRACT_HTML);

if ($CLIENT_SIGNATURE == null)
    echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Contract</title>
    <link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    ' . $CONTRACT_STYLES . '

</head>

<body>
    <div id="content" class="ql-editor">
    ' . $CONTRACT_HTML . '
    ' . $DEV_SIGNATURE . '
    ' . $FOOTER_UNSIGNED . '
            

    </div>
</body>

</html>
    ';
else {

    $CONTRACT_SIGNED_PHP = '
  $phpName  = basename($_SERVER["PHP_SELF"]) ? basename($_SERVER["PHP_SELF"]) : "index.php";
  $fileName = substr($phpName , 0, -4);
  $htmlName = $fileName.".html";
  $pdfName = $fileName.".pdf";

  // Function to get the client IP address
  function get_client_ip_env() {
    $ipaddress = "";
    if (getenv("HTTP_CLIENT_IP"))
      $ipaddress = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
      $ipaddress = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("HTTP_X_FORWARDED"))
      $ipaddress = getenv("HTTP_X_FORWARDED");
    else if(getenv("HTTP_FORWARDED_FOR"))
      $ipaddress = getenv("HTTP_FORWARDED_FOR");
    else if(getenv("HTTP_FORWARDED"))
      $ipaddress = getenv("HTTP_FORWARDED");
    else if(getenv("REMOTE_ADDR"))
      $ipaddress = getenv("REMOTE_ADDR");
    else
      $ipaddress = "UNKNOWN";
    return $ipaddress;
  } 
  // Function to get the client date converted to the same GMT as the dev date
  function get_client_date($receivedOffset) {
      //$receivedOffset comes negative and in minutes, eg: -120 for GMT+2
      $offset = -1 * $receivedOffset / 60; // GMT offset
      $is_DST = FALSE; // observing daylight savings?
      $timezone_name = timezone_name_from_abbr("", $offset * 3600, $is_DST);
      date_default_timezone_set($timezone_name);

      return date("F j, Y") ." at ". date("g:i:s A") ." GMT" . sprintf("%+d", $offset);
  }
  ?>';

    $current_file_name = str_replace('.php', '.html', $current_file_name);
    header('Location: '.$current_file_name.'#hk');

    $DEV_DATE_IP = '
  <div class="date-ip">
    <strong>Signed on:</strong> ' . $DEV_TIMESTAMP . '
  </div>';
    $DEV_SIGNATURE .= $DEV_DATE_IP;


    $CLIENT_DATE_IP_PHP =  $CONTRACT_SIGNED_PHP. '
  <div id="date-ip" class="date-ip">
    <strong>Signed on:</strong> <?php echo get_client_date($devTimeOffset); ?>
  </div>';

    // /** 
    //     $CLIENT_DATE_IP_COMPILED executes the php code above
    //  **/
    ob_start(); // https://cgd.io/2008/how-to-execute-php-code-in-a-php-string/
    eval($CLIENT_DATE_IP_PHP);
    $CLIENT_DATE_IP_COMPILED = ob_get_contents();
    ob_end_clean();

    $CLIENT_SIGNATURE .= $CLIENT_DATE_IP_COMPILED;

    // Add names above signatures
    $DEV_SIGNATURE = '<strong>' . $dev_name . '</strong>' . $DEV_SIGNATURE;
    $CLIENT_SIGNATURE = '<strong>' . $CLIENT_NAME . '</strong>' . $CLIENT_SIGNATURE;
    // replace [CLIENT_SIGNATURE] with the client's signature
    $FOOTER_SIGNED = str_replace('[CLIENT_SIGNATURE]', $CLIENT_SIGNATURE, $FOOTER_SIGNED);
    $FOOTER_SIGNED = str_replace('[DEV_SIGNATURE]', $DEV_SIGNATURE, $FOOTER_SIGNED);
    $FOOTER_SIGNED_PRINTABLE = str_replace('[CLIENT_SIGNATURE]', $CLIENT_SIGNATURE, $FOOTER_SIGNED_PRINTABLE);
    $FOOTER_SIGNED_PRINTABLE = str_replace('[DEV_SIGNATURE]', $DEV_SIGNATURE, $FOOTER_SIGNED_PRINTABLE);

    $SIGNED_DOCUMNET = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    <link rel="preconnect" href="https://cdn.skypack.dev">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    ' . $CONTRACT_STYLES . '

</head>

<body>
    <div id="content" class="ql-editor">
    ' . $CONTRACT_HTML . '
    ' . $FOOTER_SIGNED . '
            

    </div>
</body>

</html>';

    echo $SIGNED_DOCUMNET;;

    // Generate pdf using a FOOTER_PRINTABLE variable
    $SIGNED_DOCUMNET_PDF = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    ' . $CONTRACT_STYLES . '
  <style>
  #content {
    margin: 0 auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
  }
  </style>
</head>

<body>
    <div id="content" class="ql-editor">
    ' . $CONTRACT_HTML . '
    ' . $FOOTER_SIGNED_PRINTABLE . '
    </div>
</body>

</html>';

    // Generate html file
    file_put_contents($current_file_name, $SIGNED_DOCUMNET);
    // Generate html
    generate_and_send_pdf($SIGNED_DOCUMNET_PDF, $dev_email, $CLIENT_EMAIL, $current_file_name);

    unlink(__FILE__);
    die();
}
