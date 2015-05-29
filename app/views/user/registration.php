<html>
<head> <title>User Registration</title></head>

<body>
    <h4>User Registration</h4>

    <?php if($user->hasError()): ?>

        <div class="alert alert-block">
            <h4 class="alert-heading">Validation Error</h4><br>
            
            <?php if(!empty($user->validation_errors['username']['length'])): ?>
                <div><em><b>Username</b></em> must be between
                    <?php eh($user->validation['username']['length'][1]) ?> and
                    <?php eh($user->validation['username']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>
            
            <?php if(!empty($user->validation_errors['username']['exists'])): ?>
                <div><em><b>Username</b></em> already exists.</div>
            <?php endif ?>    
           
            <?php if(!empty($user->validation_errors['password']['length'])): ?>
                <div><em><b>Password</b></em> must be between
                    <?php eh($user->validation['password']['length'][1]) ?> and
                    <?php eh($user->validation['password']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>           
            
            <?php if(!empty($user->validation_errors['lastname']['length'])): ?>
                <div><em><b>Last name</b></em> must be between
                    <?php eh($user->validation['lastname']['length'][1]) ?> and
                    <?php eh($user->validation['lastname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>            
            
            <?php if(!empty($user->validation_errors['lastname']['valid'])): ?>
                <div><em><b>Last Name</b></em> is invalid. Must contain letters only.</div>
            <?php endif ?>           
            
            <?php if(!empty($user->validation_errors['firstname']['length'])): ?>
                <div><em><b>First name</b></em> must be between
                    <?php eh($user->validation['firstname']['length'][1]) ?> and
                    <?php eh($user->validation['firstname']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>           
            
            <?php if(!empty($user->validation_errors['firstname']['valid'])): ?>
                <div><em><b>First Name</b></em> is invalid. Must contain letters only.</div>
            <?php endif ?>            
            
            <?php if(!empty($user->validation_errors['middlename']['length'])): ?>
                <div><em><b>Middlename</b></em> must be between
                    <?php eh($user->validation['middlename']['length'][1]) ?> and
                    <?php eh($user->validation['middlename']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>           
            
            <?php if(!empty($user->validation_errors['middlename']['valid'])): ?>
                <div><em><b>Middle Name</b></em> is invalid. Must only contain letters only.</div>
            <?php endif ?>           
            
             <?php if(!empty($user->validation_errors['email']['length'])): ?>
                <div><em><b>Email Address</b></em> must be between
                    <?php eh($user->validation['email']['length'][1]) ?> and
                    <?php eh($user->validation['email']['length'][2]) ?> characters in length.
                </div>
            <?php endif ?>            
            
            <?php if(!empty($user->validation_errors['email']['exists'])): ?>
                <div><em><b>Email</b></em> is already registered.</div>
            <?php endif ?>              
            
             <?php if(!empty($user->validation_errors['email']['valid'])): ?>
                <div><em><b>Email Address</b></em> is invalid</div>
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
        <input type="submit" value="Cancel" formaction="<?php eh(url('user/login'))?>" class="btn btn-primary">
    </form>

</body>
</html>