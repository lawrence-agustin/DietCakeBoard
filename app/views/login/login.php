<?php if (isset($login)): ?>

<?php if($login->hasError() || $error): ?>
<div class="alert alert-block">
    <h4 class="alert-heading">Error!</h4>
    <?php if($error): ?>
            <h4 class="alert-heading">Wrong Username or Password</h4>
    <?php endif;  ?> 
<?php endif; ?>
</div>
<?php endif; ?>

<?php $title='User Log In';?>

<form class="form-horizontal" action="<?php  eh(url('thread/index')); ?>" method="POST">
    <div class="control-group">
        <label class="control-label">Username: </label>
        <div class="controls">
            <input type='text' placeholder='Username' name='username'>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Password: </label>
        <div class="controls">
            <input type='password' placeholder='Password' name='password'>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="hidden" name='call' value='true'>
            <input type="submit" value='Login' class='btn btn-primary'>
        </div>
    </div>
</form>
<p>Not yet a member? <a href="/user/registration">Sign up</a> now!</p>