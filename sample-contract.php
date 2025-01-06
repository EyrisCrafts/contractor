<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require $serverRoot . '/variables.php';
require $serverRoot . '/functions.php';

$CLIENT_NAME = "[Client Name]";
$CLIENT_EMAIL = "[Client Email]";
$CONTRACT_HTML = '[Contract HTML]';
$CONTRACT_SIGNATURE = '[Contract SIGNATURE]';
$DEV_SIGNATURE = '<img id="dev_signature" src="' . $CONTRACT_SIGNATURE . '" >';
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
  $current_file_name_html = str_replace('.php', '.html', $current_file_name);

  // Replace 'unsigned_contracts' with 'signed_contracts' in the path
  $current_file_name_html_path = '/signed_contracts/' . $current_file_name_html;
  
  // Redirect to the new URL
  // header('Location: ' . $current_file_name_html_path . '#hk');
    $ip = $_SERVER['REMOTE_ADDR'];
    $DEV_DATE_IP = '
  <div class="date-ip">
    <strong>Signed on:</strong> ' . $DEV_TIMESTAMP . '
    <br><strong>IP address:</strong> '  . $DEV_IP_ADDRESS . ' <br>
  </div>';
    $DEV_SIGNATURE .= $DEV_DATE_IP;


    $CLIENT_DATE_IP_PHP =  $CONTRACT_SIGNED_PHP. '
  <div id="date-ip" class="date-ip">
    <strong>Signed on:</strong> <?php echo get_client_date($devTimeOffset); ?>
    <br><strong>IP address:</strong>' . $ip . ' <br>
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

    // Generate pdf using a FOOTER_PRINTABLE variable
    $SIGNED_DOCUMNET_PDF = '
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract</title>
    ' . $CONTRACT_STYLES_PDF . '
    
    </head>
    
    <body>
    <div id="content" class="ql-editor">
    <div style=" text-align: center; width: 100%; margin: 0 auto;">
      <img src="data:image/jpeg;base64,iVBORw0KGgoAAAANSUhEUgAAAioAAAIqCAYAAAAKMGGzAAAABmJLR0QA/wD/AP+gvaeTAAAuDUlEQVR42u3dCZwkVX048M4/aoxJPBKTGI0ajfGK930QjUdM1HhFkXgA093LKipRUeMRNRvvC1HY3a4eEBSNiRsVvI8oioCigjEqHihgEBUFFRCUm/97r3qP2emZ6a6q7q7q+X4/n/qw7M50d1W/eu9X7/i9VgsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADqppMd0OpsffS6O+/u5puHc39Xa2P/hnN1Xu3sqa1u/1Wt1tW/oXBD6Qqy98RwQ+3Z6vQf1tqw9T7huHs47hQqzVvuOBYW75L+vpPdo9VZfGg6FrJHpN/Lj33D728cHC9odbMXhhv1xeHnX5du1vj/8UiVcfiZdtZOlXK3d//WQv+2rfYRfzh3N3Q3+7twnnul6xqv2779P19yTad5LPTvOPhe756+u27vH/Pvp/+i0ue5T+8m4fz2Sd/nwta/Su/R7d1hyfu3+3dLf99efGD+/tmjdpSddn/DjrKzvZxsLzud3qb873rPyv89fO5O7/Hh3+7bWthyozlr2P4vnNcFocG+2bqpezb2rxm+15PDeV8dvtu95+e7DOW9k10xOK+naWSgfAX5mXRDzf64KhxnhePYcHMflgc2oVFayP6imYFKb2tNrutqx+EVBSqz+vy/Csep4fhQKMevScHSPpv/oHFlJX7mHefU++g6ekjatMt3uWWOesc+tMt5/SgEZNfR0EC5m+qIBjSoPwmByzGpt6bT36O157bfbMB1PaD217Xd+5eKzvXsGp1XfJI9PpzbcxsznNDt3WvpOYReznkXe2k72WW7nPcJc9SbctXS77OCnktY5z0qL29AoLL78bNw8x+VhhBi93Etr2vvwbW/jt3+kysKVI6t6TlemgLxOOxW73vwSbt97h+39t96g/mtdMIwbyc7bmnQHIa+5uPB78NDyuEvWt3Df19jA8VvrG4DA5Vdj3PCE+ib0hBErZ6St9yq9tcuzkmqpkfgsJqfawhY+v8aeuKuVc8eleyly3u7+tnc1jlxPsry7+jyRvSUrn5ed125DIZhLqDozdV/bMMDlV0bo6PCPIXb1OK6Lhx5/dpfs6qCuzhhuhll5JTWhsP+tIYPC0cOn7PVf9D8PRi97fdCo/3DiZbH2QWc71y1F3jvo35HgwOFGtSwUmM+ApWdcxTavbfPflVI6t6+rNbXauHIa1dyqnE+SHPKx4/SPIJ6NXCfW+Gzfruy76g2gUro/Zx0D99MzuvQGw+GGlcZag2r14AijUx2+zkLVLYf54cG4BkzXfachqVqe30urvA892lY2Ti3td/iX9aoR2WVychhyGpebNhyu1WD93b2hAYHYK8dodyd0dq06RoaHRi7RyX0PEymMbhw0MUbG+ufz7BR+tjMelfa2Tdq3FifXV2PQP+RDQxkz27t3fujmd9/e775t5evEllyXJIa+LnoTQn34uqr0J7byPOKy4872XmjTWAPuYCAcSvKMMGwXIV/fHjqe1lqrDYcdotVVysccMhvpTkkKRlaf/8QyLw1/P6X00S6STdKC4v3nMFT1mdr3FCfVt2TcuiyL/453pCWnMdgMs7r2Vn5XzP9XUwel0++XAzH6ZUHsbNONBh7dtb+nMc2PiFinqhvrfM8qJHnlhISjlzmvipbLRR70rmkcGX/jC2/W/r94ySzfDnvIWlp5mQa5l+nicNTrcCyjxT/vIsP35FNdntG2SVHzOybMgpvTDlb8oyur0mVfSd7xyBIOmPFrvbY21NZr1xIyld4nkzIpzGyUMHHILeTfXyNXogxjnD9Znrvhe9xtKXk+za3fokTaLMfjHCe2xp3bps2/b9Qhr47XlqA7CEaHRg/UCk6NHNV5U8HcYliClr67w2vf2XFwcrlaQ+OqV3XdA7FPmtVeTTi9UyBRHiibWevDP/90uC6fqW680wTCacQqCy5tg+rKNHcT1JDOiujT0Q+L99qopH1yyGjJSDMvtDAnqLHFShzH9fowPgVSdEK/5IJP23eZpA59/JKVwVNq2clLZeecaAy/LreMjzVPb+6nqOQzGragUoUM8/mvStle1VeMMN7b/MYn/XIxtUtcch1+743ax8/aNz5rbxia625KnfV8MB4Dep3C1byF0ypsrvLjs3Lqtojpr14vyk0Qou1DFSqFofuZhGo5D1G10r745QrD9+aYaDysbF6MJs0bBBXuMSeu3EeIpq0KibfqLVomXuXhgfGC1T+t3C3+bTEIYxO/3lr5ioY+QgrkibdlZ5PFp7/QCV9NzMKVKKnHHLdlHOk1L5H/XvPKFA5bexJ0E3JrdLu/fP438OWmzan3szeXWoYurv55hofGP2GO6lY5T6D/Tm6vfuHAOCnjVj1MVpuheYHKnkZunxmgcqOclFigm1VGzSOH+AVCLwbkI49rgCMuXrG/h6m0NNZhXzX8LIJHQ/W+MDojUyxTeW62fdm8nn3W7x1ieGq3Sv9/Sb3RFliw8fmBSoXzTRQya/3+4oHKtkHp37NFnp/VnhuWLwH6l0ePlTwfmzGztHt7I0V1D8XtfbZ/AcaIBitUvnwzHNxFKvkq1jKfO7EdjaNkzTXT6By3uwDlfA0XrwcTH8iZ5kdtuPS97qKSc2Kn9fz61/W03LrX1TyoDSLnjxoaKBydOMClVTRhz1bUgbc0hXG5gkFKs9ZP4HKChvNTTNQyfdXOr2WK9iGX7P9SpXbaecFGsXG/vUKl4W8R+Wt9S/rJe7rYfP8YnZiYM0br2i+j+/UoIF8XAWVxaUT2VW33f+ndROoxPlKMw9UUtDdn2nywvHK7mvLPY2Ha163HXm7vcNK3otH17qcx3lFcci7yvxO3d7TNEKwduX+nsYGKqlyXHV79VGP6tN3d/rPXEdDP2fWJFDpFm/4p5xQLWZiLT10EJL41UW+E3vZjMGn1Dwgf8JEtrOIGW6BVSvMosvsvl2PQCUmHCu9EuiXlQcHaT+jdROonF6LQKWbPaBwluW4v9B0ezJPrqQ3MCZGnH1PQ9wz7NQKzue8epfz3okT2eKjjsN4UCvFeyS+VaNzeHbt9n3J9+FZH4FK0e7wqgOVdnb7gtf8/BkEd9XsKt7OPjn7Brz/ksoa7WkPwY3cY5Sy7E5qk9DjNUSwauXee3vjA5W0M3P/+yWXKn+24oaou456VL5Ti0BlY/9mBRv7b0z1epXZdmB42X38zL77OL8r9khWdS4bttyupmV8lCHyMwqvgIu7kAMrBSr9tzU+UMkDrueWrCSvrHRSbTtrr6NA5du1CFQW+rcteM2PaPjT+Vkz64moYq7N0iXKf1e/HsOQRXaUpIZxuXG+g3mRHt33aoxgxZuw6Ez9/jdrdR4LR16/cOKxnUe3wgp8n/UTqISyUIuhn5AKv1gK/f2nG1Rne1U+fNDOXjODh4MHVz8MUvEQbCV1ZP/NI+1VFLcA6G65VcFJxVem3wWGNqi9uQhU8nN5V8mnuXdW91l6T1lHy5O/UY/JtL29C02kjTtKTzewe8kE5jlcmnqUpiXfdPBrE5hY+qp61Skpwdv5I3z2D+9SD326VjmdYA4Clc0Fb6pT63cuYay+bBd6dY33k9bR0M/XajKZ9o2NmMjYyQ6fzKTM3n9Pr5chZJGdyDn0j6pZb+HzRrz2j9ulHnpiwfO/OMyzuqFGCZZXmofMTaASx+ljltFSXegV7eBavLJq4qqfj9Qkj0qBgGmC+z2t/DmPndwKkinsl7PhsD8esZehyHFcbcp1vnHkGSN85nOWLG+Pfy6cobf/Mo0SLG9Q3zo3gUp+PieWHP55yMwDlSo3K4tBT1y2uyH7m0H673dXnjOk6ITsKgOVuFqkSHbXuGJs2opm8h1136JJT6wtO8S6+nFmfQLwkfctesOQ+//V0uqDQGWl83lTyYry6TMPVFIysNCNv/JxYv4zQ49vpiGsPE/HVVNpCOoQqBRJn9/ub5jBU/q10sTLkefPFCpDb5jY5x8vA+3lBT775aknox69zScVXlKdL5W/Ym4mFINApcqnoP6Ta5FOv1SgMtHjY3MXqOS9KZeOHQzGCaHTtt/ircfo8flCSgNQpLFf6N9xAkFWHAr56sjZnjvZ4kyHX0vdv/09Ss9xKjokGvMSSasPcxyobNh695IN+bY5D1S2zFWgkuYDZJ8fe9LiNFfILCkXiw8fI1D54BjDD0PmeoQdpavtYThgjEDwJYU35uz27j/zeqSdvW/EOUELqwQqjyp+n259tMYJ5jVQecoh161Fj0NdA5WYlGqeApVCy+tn2LU+zmaVMWt0DDY62VcK5lZ5UmWfe+/eH4XX/MWI7312CCCvU7h3s8rPXeg7CsvVRxu2uXDVHaxjD1Tx+UjHaZxgXgOVvPG6uMRk2s/NdaDS7XVqE6h0e/cq/J6xa7xI2e32Xz/jsnnQGA32W/In8/4jC64A+mHKAzLt77jb3zfv3YwTuAvN0XjRjL+jUVdCLo4QmL6sxL16Lw0UzG2gUmLfn272P3Peo/L3tQlUYpKsbn/PVufQG4/ZkNw59XyNf+5vr3w4ZFzd7JgxApWX73LOxxUMVt5UQcN9j5Q5dbT3/OqO+RXd3l0LlovezL6fPMP1L0ecjH3vtV9vy43Cz15W8Dq8SwMF89uj8tUSjfm3KrquNQ1UFh9Yo0Bl1+OCwRDHxwbLX/tp9Uone11+xHIa9kMpulNz/P06TFAcJ9dLt/esnQ1eWm1zdaGJtRu23qlcz1X2xdHfb/GhO8tFmBRb7DN/fIaB5AtH/IxfH+PB6b0Fr8NltZhYDAKViTQGXyzRYH55vgOVEZ4CZxOoTOq4Mm1YWZ+y+csxhlCevPQ6Z58seA2OL9yT1O09bazJv0t7J65d8PN+eybfTT4x+6wRh6eeM/LrFh4CS8frNFIwj4FKnGdSvGI4dq4DlTJP180LVM5qbej9dW3KZT4MUHwn4XwIpmBulbD31Nj30eG/H3733BHf44qw9PovhwRmRTYK/fVMhuhG35/r0lb7iD8c/YXThOjvFCzDP5/ZztggUJmgPP9E0Tkqx8w4ULkqfP5Xht9/7c5hj8ERJ4LmQyL9tIy60/9AngAu9CDFuTWd7PTw/z9dY9njbdZHoBKuTZxvUKtyuXi/0pMpO9n7C16Tc8a+HuOsqOr2tq7wGmcW+rwb+39S457Y94z/2v0XlJhU+ywNFQKV+etR+Z+Zb4pWPFD5den3jtlPNxz2p2k7gDjskQKa8Lp5A3CzddKj8vnaZDjdGUA/dbzl29lfLHuN2GtRNOPp9lVEo32ndxvjfS5M+/8Mb/y/XHAu1f2mHEQ+cIw64mFjv37cFmP7PTj+cUbtyjI0I1AJqdpre07ZaSU2ddvU+EBlmI3964Xv7F9Td/76CFQmkzOmVJkI13+8XoUbVny9R5xYm4YqPl/JdS6yOmvY/JzJfzcfGHkvpaJBQ5k9ktrZYzRWCFRmtTpmMoHKhSUqhL3mMlCZ6NNobeeohFTyi/esUaBy1FiTgFdqEONy7uK5gk5Yc/5HO2uPNQ8oJner5pyXZradlthzNfLy6xIPMsVXbsX3/azGCoFKkf0o6ij1HNRgsqlApS5zVb5Zm91oY5AwziTK1cvXq0tcl31WfN08s/OPKgvsu/03F/yMi1P8XraMHDx2N9+85Ht9rcRcFQngEKiMeZxWy/Pp9u5QogK/orJGrXigcsk6ClTOXGUX6F2OMBG0XMBycE0ClR+PMan7e6u/Vsg4W/y6/GTFibXj1QefX7N3JvaMFOvZ/OR06ou0smnUlUmfqqBX7TklyrEEcAhUxlwd8716Npphn5DiFcFJFV7XJxYermhcGcqOKDgP4ZEjvX6cHNzJPlEql0qcWDzbnr7rjLe0uPelEQLEfypxTQ5Z9nr5RN3LRl6dNsoTftxXqc4PQu3sxWN8pvNHC6xXDbrPLvGdXdbap3cTjRbrMFDJNhe8aU6vaaDyxhLzU15Zg4DpygaWoXcU25Qwe8To75HmZfy8RCV/dlp50ZyevrWzs+YJyk4r3HsYU9wvLbOfqXx13IbsHwp+vksnnkk4v34/qHGywmEB7Gs1Wqw/Mf9B0SVz9QxUPlNiPsODKryuexf+HLPej2bsc83eOfFAJQ+IuuVWAWXvm2G5fMyYZfE/Jtxzl/fabA8GRk92Fo9fjbzMvZs9oPh8sbDEfrJ1397NClIGc5dW27EZ5rRHpV+wUf9+/c4ljdtfWrACuLB1wCG/Vd1n6S0UroyaljMhNqqTHPpZWl4/XvKJdL/ZBCoxn81Yn3XLaC8clxL3TiwRvLUH980YQxJjrHzZsOV2JR4c9pjcF5KWYH+9gYFKPA7QcLHeApXDC1Zw/1fD3pTHFK+ww4TQSj9Lf0OJQOVaDStD24qd69ZHj/8UHFZdlFl+Hpf1LvRvO/2y2T90zCDuVWP0aD2gROD207TCZpwhtHGe6GOq+eKrXPaeYOD49w0NUvLe7E2brqHxYj0FKkcUvFnOqt25FB2CyCcHP6DibuWnFf4scTO3JolDKsUayccV7MF5ZsmK/iuV9p6N1sP20TF7E5435jX5wFQayXGDh9g7OHKOkmXX4GUTrPeOb3CgEh8Un6DxYj0FKu8oPDmxTvbfeoMSKapPr3xeSJnGtGlj0EUbyaKVbZxXUW7jyRgkvWnKQfT3xh6SGUc+xHL5hCdyfqnQfdLJziv4nkdMqHfr3o0OUkZdFQZzo3gvxE9q1liWyU9w4AQqw+JLR2PSrWYFux+aehbgOHxTPDDNl9d2Fh8+lesTe2/G3Z+nSMr0bu+wCTaOcTny/QuWj28V7OX8XK0C6/olM9xDA8Z66VF5d8Eb5fzanENM0lY8P8G5E9lGffzJk7sO/Vy/YWXoYwUDlSeVbHBeUrKy/1lrofdnE78+7ez2U2mEyqXWXyto+M8S5aPoMMuPKv8u8gD3yvkIVLKjNWCslx6V/2x8qvdSW6hnL6zdZ5plvo9iDfEnCwYqTy31vjEPRqmdsgfZVePrTPQe6z927M8Vk68V+y5eM4EG8ZIw8fmWJQKVowv34lT9EDH2nLy4V1FMWjex47ulEhkO22Eb5q9Hpf/eRicmi0/ExVeBnD2R3pT8ur6oRP6IP25Yj0qxJ+Zuf9/S771h691Lz82I+9FM9mHgheN/rtA7Uix4u16JOSErHW8oWT4OL/Hed67se4h5WcZLX3BZWrU02fp3Y7lJtf1MI8Y6CFQKzi/It6G/5kw/e5xUWSbBW7e/5+Sua+8VxYd+ttyoYcHuyQXH2DdW1GPx+tLzLzq9x0+ux6nAXkir7Ui89j19YIVBys/Sfjjl6pg31GJ1Syc7aMz3//DE75182Pq8cr1dBYNaaIyi3fbxiCttZvvZy3Rzf2LCn614Kv+m7efRyU4tOOz27Aor+1NLNsjnt/bt//mErs8JY36Wcvs95XsjnV7RhM1nzrR3Mf5uFfJVgRdOdQ7VNOqKWaxggxk0MseVGKK4xQw/99NL3Ny/mPhnH33r+GFP0zdrWBk6faaNUOpVCfvWFM9KvDO/SpmejJV713465uc4r4LrUUV6+G9X0msaswEX/wyHV1M+speO+b4XTWxYeNlnS0kMryhxjS6a+BAVzLiR+WKJ5E93nU1PSlr6W3zmftwobfLX9cjiQz8NmyDXyX5c8ElwU7UVfpG5IMP2A6owp07+JD/9DT/jsGgMvEpdi5C9tZpA7fElegs+W/r9YwLFcctoTNswTd3smJK9Kq/QmDHPgcpXa7GJ32iV7zXC+x5csiF6y5Su63uKB1Jb79OwMnR+wTlCr6+4fJSbszSJAKpYcrFTqvleQp6Y4vfJZyq7Bht6f13iu/hhBUHAMwoMS/7dlAOVh5QeumxaWgMYo5H5Vokelb2n9jnjcs1O9uWS4+0fmNqGf+3sgzN/kh1V2QRzxYdcDqn8XPKVHT8vPbm2qvkJnWyfAu9/bIX396cKreiLq6kq+0623qnUd1EmU3NK4T/uEuAwVDeLvXQ62ddK1m8vasGcBipnlrg5jpj454srYPJelEtKNj4npEmX07uunyrxNPvyiX++1KDHuQO9/w7v+V/lGoLCge5hE7r2+1QwP+NXrYXFe1YQsL6ywNP8MdXdP+Ec0qqmsT7DkZV+H3FyeJnvIgY6xa//XrUIoEcrt08vWWZ/MpE5VlCDQOXHJW6MK1JjM4mJqe3F+4XX71eSaTN2Y087LX1MJFZqyWHYgynuwNzuPThV1LGyH2ezwjgRMM8xc9+0S3HcJDEOteSrvM7d7f2eXrzLOixdnUW207Wv/7YKhoB+WHoFVpHP0e69veJrMU7CtYsrX3WWr8oq8z0UXDoe5hoVSQgYh+tmIfYcxYn+5TIIv1CjxjwGKr+sKN/C19MyubgjbtwgbZzVAvFnU5rx3lMGyaHOrOgzxeP9M9mNuNP/5gRTZ/9yMLyx/Th38N8Lp756K2YsLX4eH5/Y9Y+BaVy1Uv5af6VUkFtoDljvrRXf43ceo1fldROqZy6eeuMb90saf/jku5VvUDredTq4ZHn9WUr6B3MjXxkwqX0vYrbQ74TK4guDp/htgyCkP0jbf/Qgv8RpKQPkJDZR6/RePbU5KcsrnHMasgtrucmKeWbYou9/0mS/g623KTzRd/ceuSLBbj75+5IC7/fKCQTO7x1pQmbZ5G4r3w9nl/gOig1FxR2Gx78fXj3TOjnfi+iqkuX1lRo35qg35W2/Nyebc+1+XDjRTKOjVcyXNORabSt1nnFoqkyejknL99m5spLrFAP7sYK40LNYl0mR+WT0K9fouXjpBO+H00oE018a/3vPHlUwJf3datDLfVzJsnpR47bhgFWGXP5k/oKU3kdTAqXZXtfrNOiaHViuRyXkpCn+3udM5fuI83PKPqXmk3+3jjUs0Ok9sWBj+U8TagDfs+ou4vHBZWLfQanNIy8eO0gslh/qzJkO++wMrp9cQS/gWzRwzIfullvNUZDyk6mlvF5L2VUO0zxijotyQUCn1KThqZX1CpLB7VgRMmJjVmTFTx5s7zeRa5Dmga3Uq9J/zmR7CXonlgsSQ1018vBJ9oiC73NQLeqPtAXC2NmMdz8unWnmcKjwSfOucxCgnJcSdNVpAlm3d4fGXL+yqbdL7eMSs/BOMUlVu/fckqnKtx8HjxgcFcw2GiaVTyxg6P/H0HlKk166X2ZPsTw54GPHeK8vFCuLW/+qNnVI6f1/0uqxf9fI0Xyd/h4NDlDC5Lz+SybaXV1UrPCacQ1/VMFwwuaSwyl3mG4QGTKOdrILKrh2R665sq3wHkhh5dyk7Ld468FE98n34FQStI05QbTTf1jB9/j5TJK8rSRukFnFcGXZHlOYfaBSIsX2bI5fp0mNcaJcnSqVZdc15C1pRG9KeMotH6gcXS5QmXKq8h1DICWHIvLjYysuXc5zYlxZy2vSyd61y/udVsnGg2u/57tLXutPjfg+JxR8/ffUrx7JPl1BGf1aGkqCxmpnT6h5Y3plykMRJ4bFrt9p7WZa+umxv29DAr+DKqhMS25rkHVn8yXFZGBpRdBx5VYF9b8fJhT/zfJ7q9AeP9sDlQdMtscvbHq5vVdlWvO6YmLIsiv51ko1UGq/nN5CDevnvSq5z7v9V2nsaK406XPxoSEL7ANTPoyF/h3T02b6c0y9Hf4tVuZp1UT/ZWkiYRzjjnkl2tk30gTWynKghHHy2Gi0+28Lr/3ilKxpUjkdJi3PLXJgOId26saP13H7ERuh+O/bj+1/H4PGbn/PlI22098Yfu75aQJorGRiEq58iKWfxp1TTpqwuilPf39S+PmTdx5p76bTdzvO2uXPpw1+7hNp6K98l/6/pZ1b4/yPeL7xHLr9R+4855AZNz/X++y8Buln9kw/v7B4l9k/uR5647TSott/82CPpi8PrtWZ6b/d7Hv5NYt5OdI1/3A4FtNWB3EZfFw9N6zXJq7eiYFAnl347oN77LZ5krzdjnxI5h7p+kxj3k6+u/cpY6+mKfx+YUim23tWuh4xsIvXIi4FHnYtVr4u117jAeGRaRgr1h0xs/Va7xGXj3d790qvXcckabEnJNYB7f7+qXzGScLbzyseacn5kPOKcw9T3RKH9mPdEspfHVYzwUzFno72lpumVO8x6Mkb3sfsaJDSypDQ+MY9WOL/p8aqd//8Zgo3VplNx4Dx7b/1Bmm/JwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGDWNvav2eosPjQdG/s3rPS1O1tv2er0N6Zj4cjr1/L8F7b+VTj3hxc69tn8B/U6l3CN91v8y1a797etTm8hXPfntLrZC1ud7HXhOLjV7h+a/7n/sla3v2/4twe0nnLIdRtZbjdkfxPOpdtqb7mpm7gi3c03b3V7zwrl4j9b7ewL4fqeFo7Tw3FK+LuPhP++obWQPSKUs2vXsB67Xvh8dw7l+rHhHJ6Wl/tQzvOyvzl99m720vzfeveq5TmsWt633n1HXbrseNvvKbzMtxRMZFfnR+9N1b52/6idr53do57nn317l8843tHNHlKb82gv3q/geVwVvqf/Dd/9a0PjdPvmlNvsw+nzt3t/7yYuG+D2/iyUgfeG63nFiGXm3BSw1CtIGbfc/yrVTzFoaUZ5/8TK9VD/yQoxc15JLd5zUOCvDMd5lT1ptI/4w/B6lwxe9+r0lF/nQKWdvSUEHs8Y69ind5MaBioXhnN5TTjaoSJ+UHoSi70sMSBdyP4iVcyd/sPCf/fOe1nSk/MluwSr/92IylugUtWDyqPDdbygQJD+gIYHKlfvqPdiT+MBh/xWfevo0FPayS5d8Rza2fsUZOZbt//IQYH/r7wCCg1YJQ1n718Gr/vuwc30pHoHKr0HN/p73BmonDn+NQhdx53+M8Pvnrqz8s7emIYFBSrzK5b51RrAlY+ftzZtusacBCrbj6NrdU5Ly/o+a/YO7X3U7yjQzHOgsu8gkAhP4Nk54Tih9Gvuue03Q8P3/fz1eo8bBEDPEqjUNFDZ4erfyMe8s4sGr/Xh2o7lC1RK3qNv/u1w/c4Y2sPQ6X00/PfAUDfsmR5c2r3nhv9/RzjOzn+m/x+1OpeVApVu9m+p5zM+JHV7/xj+/Pzw5w+Gf7t8hQb/wJqW9aN3+5y/HNKr8gSFmvnV6T9v0OX/+MGks6vDcNBdyr1meq04dvr6NPyQ30gvF6jUPVAZ2G/x1jsasXY/E6jM8QPK0uOiNKl+tQeQ1APb36MRgcpKvQxpKDT7zpDfuSC81nVqdm7XCZ/r4qWfM00S3u2z1yx4hGor/DCJMhX0sIolrYBJBX9zyUbk2PQ6G7bcLjR0994xB0Sg0oxAJV2XrbdJc5by724vgcqcifMaljV2vVc08lzGDVSiOF9rydysHdfgcTULKPfc7TNemlbqxeG33XtZmraSCUa/EXqH5RX+4gPDGO3/C3/+QXqyeMaW3y1YAd4+rSTpZp8bvP4dBt2w7xSoNChQySvJxw4Clf+r3XwVgUrJ7zb7nyFP5Q9bN4FKXobeP2QFzatqVs7fvdtnPH7w90cPGep6lILNnPao7Cjw9xg0Tq8aPFnsV/D1tiyZPLvhsFsMbqKPCFQaFqjk1+fzg/KwIFCZp/u+/83lDV1FE+kbE6j0Ni2f69F/W23OK65E2n1FVjt75eD7e+byz957u4LNvAYqJ+SV1JZb7RJYXJmeuMZ+rbh6JN1YP9mx3G//rTcY3EgnCVQaGKhs73puZ58UqMyR+H0ub9xPTY3+eg5Uur2ttTmvmKtm2XkN5hDl88iWr8aq80o9KN1Q75pltZN9ejCp9p7jNWrZs5eNdefDSVekLJcCleYFKnmgeUWa0LfntmsJVOZEXAEzfOXLd1adUDtXgUpKcrf7HJVN9bmnQ+/OavNQOtm3hvSq/K3CzTwGKj9Lc0p2zSEQMx3mBf/w0V8oLm1Njf7loVfmT3d7j/PS+whUmheo5Nfoq4OnzbsKVOZEHoD+fJUkYp9Mc5TiSp95DFQ29m+WZ6etaUOfUjz0frrb5/uv3XqEXj3kvBcVbuZLuhlS5tgLlvx9jNrzAOZXqUIbqeEIE/FWypKY7xlyZepdEag0MVD5eO0mW9Y8UDnpo63rfu4Drfuf8P7WHidva9VzOCVPI3DVqsnE4kTqdvbi2u1rVSZQyTO9njTkd86rzfLkPBnf7t/FU5f8TNr/Z8j2BnVNXAfFboaU5j6vjJY3BIcMCv4BIwYqH1hx/5tO9sVlw0t1C1Ty4Y3LxzgOWjeBSrv377XbU6SmgcrJH2pd54RjWpvDcUk4rh4cl4Wj94lPtOqXPTTPpzJKdtrzwz3+olo2gisFKrtvuJnvafScEKD9cIWg7MU1Kt+bd/t8VwytP/NNI3dfvfUgjRtzFKikpcRXD504G3Og5IX+m2lYZ9XKLuy6mjf0pw792U72sXzOS8hdUN9AJX7GI0Y+YqbL9dOjMtheIUysFais6NRtrWuFgOS4XQKUpccHWsfHn6lfPdC/W7iWXxkp1XzcG2rDYX/ciEAlD8B+FI6zdsm2vNJxbH0moqZh9B8s+3zD74ODhpzL5hbMjbixWF75fGaFmyBfERQTwa3+VPb6QcDzjBVeZ7DfT0j+VtdAxdDPKteo99naXaMaBionHt06YMUgZXAcf0zrmbUsP3FYNl/h9fkRApZv1Wp1UPm9fo6u1fl0svsOyZHy7OF1b+/+Q87nx7UcZoeCDdDjBwV72wo3zPbNsN614mvke4acl3bt3b2rdefNtHXQo/KI+l0DgcoI1yhPN77Qv61AZWUhEDlhrUAl9qrU/wEmJGmMWycsS92+5Diy+YFK2o/s6Wv2GE+/bL9hSH6XDWk11rIjzQ1c3lsU6wOYj0AlbUAXC3ZvlSDkZynV9ErzS2IisHxZ31tXbkSz1wydDCZQqX+gsrDlRoMJlz+r1VNaPQOVM9YMVI5pndWYMtU9/PeHLJHdOWcizvmob6ASy+xlu/3dr8Px9fTgtCH7h9pOOu1m36tgN+iDWjAXutlL19zjo5MdPHj6eM4K/35SXimEvWFWfp8Xrtp9KVCpb6ASs5Vu7x6v1/dWx0Dl5BECla8074Fm+8PIsuPpNQ5ULkhzTvbp3aTV3nLTNXOq1EXcELZ8kDKoB2rWUwTFGrewUeBaAUTs7k+BSJxUu6yxuPMg0PnoGo3d03Zsuy5QaVagsn1+Sqf3RIHK6sL8k1etOUfl6NamRpavTvapIRNr67HR6EqBSjMfHv+tokBl57Yo0Ghx7kneCD1ljZ87blDw77u0cUzj2GvPPYm77+bjrIcKVBoUqOzM5XBm7brJaxiofOZDrRuGYOTsVQKVM2qbU6VYA9oXqFRerr8+5FziSsPXrXGcNSTL7ms1csxDoDJaIq9hmWrj7sqxMojjqWvNXYjZHvPff7dApSGBSuwq7/T/d9XVXAKVZT53TOv2ISD5xrIg5ejWl477YOsWDa4rDh7SEL5CoFKhmL5hWP6aUbau2LGZ7JLjtBY0P1Dpn5wKdMxwuJp8F89z08qe7Zkb0yz0dDMcuOb7bNh6n8HPflyg0oRAJeZx2L4PSu/EWqZRr3Fm2m3bWr8Zlio/LAQoL4rHiR9sPfjqTa16LReN9/Sok6PzTNVnDkk3X49rPy+BSkw4t/w8Rnu4G56lNq7Uu6OGjmaLGWljYY77XqzZMPTeNBiX3mvQUByXli/GlQFrVnRpnku8cb4sUKl5oBKf3vKu5qtTsqzd920SqMzLvd9O+VDa/f1XzRidp5s/emiq9l03yBOoVFCme18aMg9orzHuiTNqvckiFKzsLx4EKmvvb7Fv/8/TpNp29sHBhl5XpjkqIz2RpSWuV6d0zwKV+gYq+YqDUwavc1bKXFzfsitQKReovG+XBu3ytHovziFr9/55kLbgwHC8I0+dP+RJvU7DgfMQqMQHguX7Ll2WAsVRdftvHnIdvq6w01wxOMkL8q/GaBw+PchNcNBgyOhOozWAqes4H28VqNQrUEkZSVOG4m2DDSqvTsHo3r0/qnmQLVApKh/KvbDEapJ31SqnzjwEKmkPoiE7WI/1oBEyiA8f/rmtQk8z5fvzDN+QcMWbKSxR3XkTfWbMhuWS9MRQv9Uj2wOVf06Tfsc5YmbI+gUq56S02nGvppiQK+5+HY+4P0vav6m/R8h58+jw3xeEn/1QOH6xS6UWNo9cfHgzKnaBSvF7f7B1xvjHFWklSW32xJmnQGXHyspdM+eOt91CDB7zvY12f52XKPQ0087JV6eM/Dv5/IVzBmOfjx/zRsx/L+7YXMdApdjxq9qcx85AZZwjDuV9Y5Cyu1k5FwQqZYOVhwwmTF80Qjm5JPz8O0MAfNdankvTA5XYe5lv6rpbT0iBzL/bU0YsPU5R4GmmzqE3TmPR3exR490IMbdGb7+xe0ZirpW46VndMkTGHDLd3rMKHk+rT+AZekxSBuCwZDQfmusvP8I2BzEfRlyxFRuqcca/6yYFZiFYjvOfKC4Oy8bNQlNdkJa4bkmNXdz2ot17bup9iVtp1Fl6gIrzanY9QjbdptjY/5NUNy45xqyXd3yfIbhZ9lrhsEkhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs8f8BpErQsJCI0rUAAAAASUVORK5CYII=" style="width: auto; height: 100px; object-fit: contain;">
      </div>
    ' . $CONTRACT_HTML . '
    ' . $FOOTER_SIGNED_PRINTABLE . '
    </div>
    </body>
    
    </html>';
    $sha256 = generate_and_send_pdf($SIGNED_DOCUMNET_PDF, $dev_email, $CLIENT_EMAIL, $current_file_name, $serverRoot, $dev_app_password);
    $FOOTER_SIGNED = str_replace('[HASH]', $sha256, $FOOTER_SIGNED);


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

    echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Signed</title>
    <script>
        // Redirect to the generated HTML file
        const redirectPath = "' . $current_file_name_html_path . '";
        console.log("Redirecting to:", redirectPath);
        window.location.href = redirectPath + "#hk";
    </script>
</head>

<body>
    <p>Redirecting to the signed contract...</p>
</body>

</html>';

    // Generate html file
    file_put_contents($serverRoot . '/signed_contracts/' . $current_file_name_html, $SIGNED_DOCUMNET);
    
    unlink(__FILE__);
    die();
}
