<html>
	<body>
		<form class="well" method="post">
	        <label>Are you sure you want to delete your thread?</label> <br><br>
	        <button type="submit" formaction="<?php eh(url('thread/view', array('thread_id' => $thread->id)))?>" class="btn btn-primary">No, Please Go Back to Thread</button>
	        <button type="submit" formaction="<?php eh(url('thread/deleted', array('thread_id' => $thread->id)))?>" class="btn btn-primary">Delete Thread</button>

	     </form>

	</body>


</html>

