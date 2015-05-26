<?php 
if ($thread->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        <?php if (!empty($thread->validation_errors['new_title']['length'])): ?>            
             <div><em>Title</em> must be between                
                <?php eh($thread->validation['new_title']['length'][1]) ?> and                    
                <?php eh($thread->validation['new_title']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>

        <?php if (!empty($thread->validation_errors['new_thread_body']['length'])): ?>                
             <div><em>Body</em> must be between 
                <?php eh($thread->validation['new_thread_body']['length'][1]) ?> and                    
                <?php eh($thread->validation['new_thread_body']['length'][2]) ?> characters in length.
            </div>            
        <?php endif ?>
    </div>                    
<?php endif ?>

<h2>Edit Thread:</h2>
   <form class="well" method="post" action="" >
        <label>Title</label>
        <input type="text" class="span2" name="title" value="<?php echo $_POST["threadTitle"]?>">
        <input type="hidden" name="username" value="<?php echo ucfirst($_SESSION["username"]); ?>">
        <label>Body</label>
        <textarea name="thread_body"><?php eh(Param::get('body'))?><?php eh($_POST["threadBody"]) ?></textarea>
        <br/>
        <input type="hidden" name="page_next" value="edit_end">
        <input type="hidden" name="user" value="<?php echo $_SESSION["username"]?>">
        <button type="submit" class="btn btn-primary" formaction="">Save</button>
        <button type="submit" formaction="<?php eh(url('thread/view', array('thread_id' => $thread->id)))?>" class="btn btn-primary">Cancel</button>
    </form>


