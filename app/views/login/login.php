<?php $title='User Log In';?>

<form class="form-horizontal" action="<?php readable_text(url('')) ?>" method="post">
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