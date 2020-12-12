<?php
$result = file_get_contents("https://api.particle.io/v1/devices/2a0021000347343337373738/gateClosed?access_token=33757db43daadfb92aba024f139a1b9dfe0f3ad3");
$json = json_decode($result);

$gateIsClosed = $json->result;

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
  font-size: 13vh;">The gate is <b><?php echo $statusString ?>.</b></p>
  </body>
</html>

