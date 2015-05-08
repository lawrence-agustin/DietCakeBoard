<html>
<head> <title>User Registration</title></head>

<body>
    <h4>User Registration</h4>

    <?php if($user->hasError()): ?>

        <div class="alert alert-block">
            <h4 class="alert-heading">Validation Error</h4>

            <?php if(!empty($user->validation_errors['username']['length'])): ?>
                <div><em>Username</em> must between
                    <?php eh($thread->validation['username']['length'][1]) ?> and
                    <?php eh($thread->validation['username']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['password']['length'])): ?>
                <div><em>Password</em> must between
                    <?php eh($user->validation['password']['length'][1]) ?> and
                    <?php eh($user->validation['password']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['lastname']['length'])): ?>
                <div><em>Last name</em> must between
                    <?php eh($user->validation['lastname']['length'][1]) ?> and
                    <?php eh($user->validation['lastname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>

            <?php if(!empty($user->validation_errors['firstname']['length'])): ?>
                <div><em>First name</em> must between
                    <?php eh($user->validation['firstname']['length'][1]) ?> and
                    <?php eh($user->validation['firstname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['middlename']['length'])): ?>
                <div><em>Middlename</em> must between
                    <?php eh($user->validation['middlename']['length'][1]) ?> and
                    <?php eh($user->validation['middlename']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
        </div>
    <?php endif ?>

    <form class="well" action="<?php eh(url('')) ?>" method="POST" >
        Username: <input type="text" name="username" value="<?php eh(Param::get('username')) ?>"><br>
        Password: <input type="password" name="password" value="<?php eh(Param::get('password')) ?>"><br>
        Last Name: <input type="text" name="lastname" value="<?php eh(Param::get('lastname')) ?>"><br>
        First Name: <input type="text" name="firstname" value="<?php eh(Param::get('firstname')) ?>"><br>
        Middle Name: <input type="text" name="middlename" value="<?php eh(Param::get('middlename')) ?>"><br>
        <input type="hidden" name="page_next" value="registration_end"/>
        <input type="submit" value="Register" class="btn btn-primary">
    </form>

</body>
</html>