<h2>Trending Threads</h2>

<ol>
<?php for($i=0; $i < sizeof($titles); $i++) { ?>
		<li>
			<?php //echo("$titles[$i]['title']"); 
				echo($titles[$i]["title"]." - &nbsp".$commentCount[$i]);
			?>
		</li>
<?php } ?>
</ol>