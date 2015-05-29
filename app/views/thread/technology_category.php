<h4>Technology Category Threads</h4>
<table border="1">
    <tr><th height = "40"><b>Title</b></th><th><b>Date Created</th></tr>
        <?php $s = array(); foreach ($threads as $v): ?>
    <tr><td height = "30" align = "center"><a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>"> <?php eh($v->title) ?></a></td> <td align = "center"> <?php eh($v->created)?> </td></tr> 
         <?php endforeach ?>
</table>
