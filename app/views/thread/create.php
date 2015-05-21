<h1>Create a thread</h1>

<?php if($thread->hasError() || $comment->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation Error</h4>
        <?php //endif?>

        <?php if(!empty($thread->validation_errors['title']['length'])): ?>
            <div><em>Title</em> must between 
                <?php eh($thread->validation['title']['length'][1]) ?> and
                <?php eh($thread->validation['title']['length'][2]) ?> characters in length.
            <?php endif ?>
            </div>
<?php endif ?>

    <form class="well" method="post" action="<?php eh(url('')) ?>" >
        <label>Title</label>
        <input type="text" class="span2" name="title" value="<?php eh(Param::get('title'))?>">
        <label>Your name</label>
        <input type="text" class="span2" name="username" value="<?php echo ucfirst($_SESSION["username"]); ?>">


        <label>Body: </label>
        <textarea name="thread_body"><?php eh(Param::get('thread_body'))?> </textarea>
        <label>Comment</label>
        <textarea name="body"><?php eh(Param::get('body'))?> </textarea>
        <br/>
        <input type="hidden" name="page_next" value="create_end">
        <input type="hidden" name="user" value="<?php echo $_SESSION["username"]?>">
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="button" value="Cancel" class="btn btn-primary" onclick="history.go(-1)">
    </form>