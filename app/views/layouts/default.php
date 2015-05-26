<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Interconnect</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 25px;
        }
        th, td {
            width: 1%;
        }

        .title {
            font-family: "Times New Roman", Times, serif;
            font-weight: "Bold";
            font-size: 30px;
        }
        .nav ul {
          list-style: none;
          background-color: #444;
          text-align: center;
          padding: 0;
          margin: 0;
      }
      .nav li {
          font-family: 'Oswald', sans-serif;
          font-size: 1.2em;
          line-height: 40px;
          height: 40px;
          border-bottom: 1px solid #888;
      }

      .nav a {
          text-decoration: none;
          color: #fff;
          display: block;
          transition: .3s background-color;
      }

      .nav a:hover {
          background-color: #005f5f;
      }

      .nav a.active {
          background-color: #fff;
          color: #444;
          cursor: default;
      }

      @media screen and (min-width: 600px) {
          .nav li {
            width: 120px;
            border-bottom: none;
            height: 50px;
            line-height: 50px;
            font-size: 1.4em;
        }

        /* Option 1 - Display Inline */
      /*.nav li {
        display: inline-block;
        margin-right: -4px;
    }*/

    /* Options 2 - Float*/
    .nav li {
        float: left;
    }
    .nav ul {
        overflow: auto;
        width: 1000px;
        margin: 0 auto;
    }
    .nav {
        background-color: #444;
    }

}


</style>
</head>

<body>
  <header>.
    <div class="nav">
      <ul>
          <?php if(isset($_SESSION["username"])):?>
              <li class="home"><a href="<?php eh(url('thread/index')); ?>">Home</a></li>
          <?php else: ?>
              <li class="home"><a href="<?php eh(url('user/login')); ?>">Home</a></li>
          <?php endif ?>


          <?php if(isset($_SESSION["username"])):?>
                <li class="about"><a href="<?php eh(url('user/profile', array('user_id'=>$_SESSION['user_id']))); ?>">Profile</a></li>
                <li class="about"><a href="<?php eh(url('thread/index')); ?>">Threads</a></li>
                <li class="about"><a href="<?php eh(url('thread/top_five')) ?>">Trending</a></li>
                <li class="about"><a href="<?php eh(url('user/logout')); ?>">Logout</a></li>

          <?php endif?>
      </ul>
  </div>
</header> 

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <?php if(isset($_SESSION["username"])):?>
        <a class="brand" href="<?php eh(url('thread/index')); ?>">Interconnect</a>
        <p align="right">You are logged in as: <b><?php echo ucfirst($_SESSION["username"]); ?> </b><br>
            <a href="<?php eh(url('user/logout'));?>">Logout</a></p>
        <?php else: ?>
            <a class="brand" href="login">DietCake Hello</a>
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
