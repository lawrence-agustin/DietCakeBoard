<?php session_start(); ?>

<p class="alert alert-success">
    You successfully edited this thread.
</p> 
<a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>">
    &larr; Back to thread                    
</a>