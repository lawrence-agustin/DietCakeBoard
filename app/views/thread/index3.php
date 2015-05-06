<?php
  error_reporting(E_ALL);
?>

<html>
    <body>
        <?php ?>
        <h3>Welcome! Please Log-in</h3><br>
       <h4>Login Form</h4>
        <form method="post" action=<?php eh(url('thread/index')) ?>>
          User Id: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="uid"><br>
          Password: <input type="password" name="pw"><br>
          <input type="submit" value="Login">
        </form>

    </body>
</html>     

     