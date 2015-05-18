<?php session_start(); ?>
<html>

<body> 
    <h1><?php eh($thread->title) ?></h1>
    
    <?php foreach ($comments as $k => $v): ?>
        <div class="comment">                        
            <div class="meta">
                <?php eh($k + 1) ?>: <?php eh($v->username) ?> <?php eh($v->created) ?>            
            </div>
            <div><?php echo readable_text($v->body) ?></div>
        </div>

    <?php endforeach ?>
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