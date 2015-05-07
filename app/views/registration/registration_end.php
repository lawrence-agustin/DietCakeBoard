<html>
    <head> 

        <title>Registration Successful</title>
        <script>
            function back()
            {
                window.history.back();
            }
        </script>
    </head>

    <body>
    
        <?php if(empty($userinfo['username'])){ ?>
        <div class="alert alert-block">
            <div class="alert-heading">Username is not set</div>
        </div>         
        <?php }?>
        
        <?php if(empty($userinfo['password'])){ ?>
        <div class="alert alert-block">
            <div class="alert-heading">Password is not set</div>
        </div>
        <?php }?>

       
        <?php if(empty($userinfo['lastname'])){ ?>
        <div class="alert alert-block">
            <div class="alert-heading">Lastname is not set</div>
        </div>
        <?php }?>

     
        <?php if(empty($userinfo['firstname'])){ ?>
        <div class="alert alert-block">
            <div class="alert-heading">Firstname is not set</div>
        </div>
        <?php }?>
        

        <?php if(empty($userinfo['middlename'])){ ?>
        <div class="alert alert-block">
            <div class="alert-heading">Middlename is not set</div>
        </div>
        <?php }?>

         

        <?php if(!empty($userinfo['username'])&&!empty($userinfo['password'])&&!empty($userinfo['lastname'])&&!empty($userinfo['firstname'])&&!empty($userinfo['middlename']))
        {  ?>   
            <div class="alert-heading">Registration Successful</div>
        <?php 
        } else{ ?>
            <button onclick="back()">Go Back</button>
        <?php }  ?>




        
    </body>
</html>