<h2>Trending Threads</h2>

<table border="1" width="50%">
<tr><th>Thread Name</th><th>Comment Count</th></tr>
<?php for($i=0; $i < sizeof($titles); $i++): ?>
		<tr>
			<?php 
				$link = url('thread/view', array('thread_id'=>$indexes[$i]));
				echo("<td><a href='$link'>".$titles[$i]."</a></td>"."<td align = 'center'>".$commentCount[$i]."</td>");
			?>
		</tr>
<?php endfor ?>
</table>