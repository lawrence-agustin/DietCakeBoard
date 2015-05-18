<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DietCake Board</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px;
      }
    </style>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="index#">DietCake Hello</a>
          <?php if(isset($_SESSION["username"])):?>
            <p align="right">You are logged in as: <b><?php echo ucfirst($_SESSION["username"]); ?> </b> <br>
            <a href="<?php eh(url('user/logout'));?>">Logout</a></p>
          <?php endif?>


        </div>
      </div>
    </div>

    <div class="container">

      <?php echo $_content_ ?>

    </div>

    <script>
    console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>


  </body>
</html>
