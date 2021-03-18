cat ajs.sirota.org/gate.php
<?php
$result = file_get_contents("https://api.particle.io/v1/devices/2a0021000347343337373738/gateClosed?access_token=5d342914ae30c4ce51cb7f67d40390b7976ab2a7");
$json = json_decode($result);

$gateIsClosed = $json->result;
$lastHeard = $json->coreInfo->last_heard;
$parsedDate = strtotime($lastHeard);

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
        <script>
            function timeSince(timeStamp) {
                var now = new Date(),
                secondsPast = (now.getTime() - timeStamp) / 1000;
                if (secondsPast < 60) {
                    return parseInt(secondsPast) + ' seconds';
                }
                if (secondsPast < 3600) {
                    return parseInt(secondsPast / 60) + ' minutes';
                }
                if (secondsPast <= 86400) {
                    return parseInt(secondsPast / 3600) + ' hours';
                }
                if (secondsPast > 86400) {
                    day = timeStamp.getDate();
                    month = timeStamp.toDateString().match(/ [a-zA-Z]*/)[0].replace(" ", "");
                    year = timeStamp.getFullYear() == now.getFullYear() ? "" : " " + timeStamp.getFullYear();
                    return day + " " + month + year;
                }
            }
            const lastHeardTime = new Date("<?php echo $lastHeard ?>").getTime();

            function showTimeSince() {
                document.getElementById("datetime").innerHTML = "as of " + timeSince(lastHeardTime) + " ago";
            }
        </script>
    </head>
    <body style="background-color: <?php echo $bgColor ?>">
        <p style="display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100vh;
        ">
            <span style="font-size: 13vh;">The gate is <b><?php echo $statusString ?>.</b></span>
            <br><br><span style="font-size: 5vh;" id="datetime">as of --</span>
        </p>
        <script>
            showTimeSince();
            window.setInterval(showTimeSince, 1000);
        </script>
    </body>
</html>
