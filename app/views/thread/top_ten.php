<h3>Most Commented Threads</h3>

<table border="1" width="50%">
<tr><th height="40">Thread Name</th><th>Comment Count</th></tr>
<?php for($i=0; $i < sizeof($titles); $i++): ?>
		<tr>
			<?php 
				$link = url('thread/view', array('thread_id'=>$indexes[$i]));
				echo("<td height='30'><a href='$link'>".$titles[$i]."</a></td>"."<td align = 'center'>".$commentCount[$i]."</td>");
			?>
		</tr>
<?php endfor ?>
</table>