<html>

<body> 
    <h1><?php eh($thread->title) ?></h1>
    <h4>Category: <?php eh($thread->category);?></h4>
    <h4>Created by: <a href="<?php eh(url('user/profile', array('user_id' => $ownerId)))?>"> <?php eh($ownerUsername)?> </a>
    
     <form class="well" method="post">
        <input type="hidden" name="threadTitle" value="<?php eh($thread->title) ?>"/>
        <input type="hidden" name="threadBody" value="<?php eh($threadContents["body"]) ?>"/>

        <label><?php eh($threadContents["body"]); ?></label> <br><br>

    <?php if($_SESSION["username"] == $ownerUsername): ?>
        <label><em>You are the owner of this thread.</em></label>
        <button type="submit" formaction="<?php eh(url('thread/edit', array('thread_id' => $thread->id)))?>" class="btn btn-primary">Edit Thread</button>
        <button type="submit" formaction="<?php eh(url('thread/confirm_delete', array('thread_id' => $thread->id)))?>" class="btn btn-primary">Delete Thread</button>

    <?php endif; ?>
     </form>

     <br><br>
     <h2>Comments:</h2>
    <?php foreach ($comments as $k => $v): ?>
        <div class="comment">                        
            <div class="meta">
                <b><?php eh($k + 1) ?>: <?php eh($v->username) ?> <?php eh($v->created) ?></b>       
            </div>
            <?php echo readable_text($v->body) ?>
        </div>


    <?php endforeach ?>

    <br> <br>
    <?php if($pagination->current > 1): ?>
        <a href='?thread_id=<?php echo $thread_id?>&page=<?php echo $pagination->prev ?>'>Previous</a>
    <?php else: ?>
        Previous
    <?php endif ?>

    <?php for($i = 1; $i <= $pages; $i++): ?>
        <?php if($i == $page): ?>
            <?php echo $i ?>
        <?php else: ?>
            <a href='?thread_id=<?php echo $thread_id?>&page=<?php echo $i ?>'><?php echo $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if(!$pagination->is_last_page): ?>
        <a href='?thread_id=<?php echo $thread_id?>&page=<?php echo $pagination->next ?>'>Next</a>
    <?php else: ?>
        Next
    <?php endif ?>

    <hr>

    <form class="well" method="post" action="<?php eh(url('comment/write'))?>">
        <label>Your name:</label>
        <input type="text" class="span2" name="username" value="<?php echo ucfirst($_SESSION["username"]); ?>">
        <label>Comment:</label>
        <textarea name="body"><?php eh(Param::get('body')) ?></textarea>
        <br />

        <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
        <input type="hidden" name="page_next" value="write_end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 

</body>
</html>