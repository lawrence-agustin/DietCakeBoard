<html>

<body>
    <h2>Hello, <?php echo ucfirst($_SESSION["username"])?></h2>


    <?php if(isset($threads)):?>
        <h3>All threads</h3>
        <table border="1">
                <tr><th height="40"><b>Title</b></th><th><b>Category</b></th><th><b>Date Created</b></th></tr>
            <?php foreach ($paginatedThreads as $v): ?>
                <tr><td height="30" align = "center"><a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>"> <?php eh($v->title) ?></a></td> <td align="center"> <a href="<?php eh(lcfirst($v->category).'_category')?>" ><?php eh($v->category)?></a></td> <td align = "center"> <?php eh($v->created)?> </td>
            <?php endforeach ?>
                </tr>
        </table>
    <?php else: ?>
        <em>Sorry, there are no threads.</em><br>
    <?php endif?>

    <br><a class="btn btn-medium btn-primary" href="<?php eh(url('thread/create')) ?>">Create Thread</a> <br><br>

    <?php if($pagination->current > 1): ?>
        <a href='?page=<?php echo $pagination->prev ?>'>Previous</a>
    <?php else: ?>
        Previous
    <?php endif ?>

    <?php for($i = 1; $i <= $pages; $i++): ?>
        <?php if($i == $page): ?>
            <?php echo $i ?>
        <?php else: ?>
            <a href='?page=<?php echo $i ?>'><?php echo $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if(!$pagination->is_last_page): ?>
        <a href='?page=<?php echo $pagination->next ?>'>Next</a>
    <?php else: ?>
        Next
    <?php endif ?>

</body>
</html>

