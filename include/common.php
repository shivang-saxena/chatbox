        <?php
    function error($msg) {
    ?>
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
        <div class="jumbotron text-center">
            <img src="assets/images/logo.png" style="max-height: 100px;max-width: 100px;">
            <h1>{ERROR}</h1>
            <code><?php echo $msg ?></code>
        </div>
        <div class="jumbotron text-center">
            <h2>Go to Homepage : <a href="index.php">Livechatbox</a></h2>
            <h3>Contact the Administrator <code>livechatbox@admin</code></h3>
        </div>
    </body>
    </html>
         <?php
    }
?>
   