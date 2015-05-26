<html>
<head> <title>User Registration</title></head>

<body>
    <h4>User Registration</h4>

    <?php if($user->hasError()): ?>

        <div class="alert alert-block">
            <h4 class="alert-heading">Validation Error</h4>

            <?php if(!empty($user->validation_errors['username']['length'])): ?>
                <div><em>Username</em> must be between
                    <?php eh($user->validation['username']['length'][1]) ?> and
                    <?php eh($user->validation['username']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
           
            <?php if(!empty($user->validation_errors['password']['length'])): ?>
                <div><em>Password</em> must be between
                    <?php eh($user->validation['password']['length'][1]) ?> and
                    <?php eh($user->validation['password']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['lastname']['length'])): ?>
                <div><em>Last name</em> must be between
                    <?php eh($user->validation['lastname']['length'][1]) ?> and
                    <?php eh($user->validation['lastname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>

            <?php if(!empty($user->validation_errors['lastname']['valid'])): ?>
                <div><em>Last Name</em> is invalid. Must contain letters only.</div>
            <?php endif ?>

            <?php if(!empty($user->validation_errors['firstname']['length'])): ?>
                <div><em>First name</em> must be between
                    <?php eh($user->validation['firstname']['length'][1]) ?> and
                    <?php eh($user->validation['firstname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>

            <?php if(!empty($user->validation_errors['firstname']['valid'])): ?>
                <div><em>First Name</em> is invalid. Must contain letters only.</div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['middlename']['length'])): ?>
                <div><em>Middlename</em> must be between
                    <?php eh($user->validation['middlename']['length'][1]) ?> and
                    <?php eh($user->validation['middlename']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>

            <?php if(!empty($user->validation_errors['middlename']['valid'])): ?>
                <div><em>Middle Name</em> is invalid. Must only contain letters only.</div>
            <?php endif ?>
            
             <?php if(!empty($user->validation_errors['email']['length'])): ?>
                <div><em>Email Address</em> must be between
                    <?php eh($user->validation['email']['length'][1]) ?> and
                    <?php eh($user->validation['email']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>

             <?php if(!empty($user->validation_errors['email']['valid'])): ?>
                <div><em>Email Address</em> is invalid</div>
            <?php endif ?>

        </div>
    <?php endif ?>

    <form class="well" action="<?php eh(url('')) ?>" method="POST" >
        Username: <input type="text" name="username" value="<?php eh(Param::get('username')) ?>"><br>
        Password: <input type="password" name="password" value="<?php eh(Param::get('password')) ?>"><br>
        Last Name: <input type="text" name="lastname" value="<?php eh(Param::get('lastname')) ?>"><br>
        First Name: <input type="text" name="firstname" value="<?php eh(Param::get('firstname')) ?>"><br>
        Middle Name: <input type="text" name="middlename" value="<?php eh(Param::get('middlename')) ?>"><br>
        Email Address: <input type="text" name="email" value="<?php eh(Param::get('email')) ?>"><br>
        <input type="hidden" name="page_next" value="registration_end"/>
        <input type="submit" value="Register" class="btn btn-primary">
        <input type="button" value="Cancel" class="btn btn-primary" onclick="history.go(-1)">
    </form>

</body>
</html>