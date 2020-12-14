<?php
/*
 * Simple PHP script to call the Particle API to fetch the state of the 'gateClosed' variable
 */
$result = file_get_contents("https://api.particle.io/v1/devices/YOUR_DEVICE_ID/gateClosed?access_token=YOUR_BIG_LONG_ACCESS_TOKEN");
$json = json_decode($result);

$gateIsClosed = $json->result;

// Based on the results, set some variables that will affect how the web page looks
if ($gateIsClosed) { 
    $bgColor = "green";
    $statusString = "CLOSED";
} else { 
    $bgColor = "red";
    $statusString = "OPEN";
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gate is <?php echo $statusString ?></title>
    <meta http-equiv="refresh" content="5">
  </head>
  <body style="background-color: <?php echo $bgColor ?>">
    <p style="display: flex;
       flex-direction: column;
       justify-content: center;
       align-items: center;
       text-align: center;
       min-height: 100vh;
       font-size: 13vh;">
      The gate is <b><?php echo $statusString ?>.</b>
    </p>
  </body>
</html>
