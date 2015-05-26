<h4>General Category Threads</h4>
<table border="1">
    <tr><th><b>Title</b></th><th><b>Category</b></th><th><b>Date Created</th></tr>
        <?php $s = array(); foreach ($threads["General"] as $v): ?>
    <tr><td align = "center"><a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>"> <?php eh($v["title"]) ?></a></td> <td align="center"> <?php eh($v["category"])?></td> <td align = "center"> <?php eh($v["created"])?> </td></tr> 
         <?php endforeach ?>
</table>
