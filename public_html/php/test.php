<?php
require "../../resources/config.php";
# create connection to database
$mysqli = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>


<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <title>New Request</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">-->
<!--    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="../../resources/library/jquery-ui/jquery-ui.min.css">
<!--    <link rel="stylesheet" href="../../resources/library/timepicker/jquery.timepicker.css">-->
    <link rel="stylesheet" type="text/css" href="../../resources/library/realperson-2.0.1/jquery.realperson.css">
<!--    <link rel="stylesheet" href="../css/NewRequest.css">-->

    <script src="../../resources/library/jquery-3.2.1.min.js"></script>
<!--    <script src="../../resources/library/jquery-ui/jquery-ui.min.js"></script>-->
<!--    <script src="../../resources/library/timepicker/jquery.timepicker.js"></script>-->
<!--    <script src="../../resources/library/jquery_chained/jquery.chained.js"></script>-->

    <script type="text/javascript" src="../../resources/library/realperson-2.0.1/jquery.plugin.js"></script>
    <script type="text/javascript" src="../../resources/library/realperson-2.0.1/jquery.realperson.js"></script>

<!--    <script src="../js/NewRequest.js"></script>-->

</head>

<body>

    <form class="container">

        <div class="captcha_container">
            <input  type="text" id="captcha" name="captcha">
        </div>

        <div class="btn-group">
            <button id="submitRequest" type="button" class="btn btn-primary">Submit Form</button>
        </div>

    </form>
</body>
<script>
    $('#captcha').realperson({chars: $.realperson.alphanumeric, length: 5});
    $('#captcha').click();

    $('#submitRequest').click(function() {
        // $('#submitRequest').checkValidity();
        var form = $('form');
        var url = "test2.php"; // the script where you handle the form input.

        var $captcha_entered = $("#captcha").val();
        var captcha_hash = $("#captcha").realperson('getHash');
//        var settings = $("#captcha").realperson('option');

//        console.log(settings);
//        console.log(captcha);
//        console.log(captcha_hash);

        var form_data = form.serialize();

            $.ajax({
                async: false,
                type: "POST",
                url: url,
                // data: form_data,
                data: {
                    captcha_entered: $captcha_entered,
                    captcha_hash: captcha_hash
                },
                success: function(data) {
                    console.log("success");
                    console.log(data);
                },
                error: function (data) {
                    console.log("error");
                    console.log(data);
                },
                complete: function (data) {
                    console.log("complete");
                    console.log(data);
                }
            });
        });

</script>

