<?php 
$recordNum=count($records);
$i=0;
//debug($records);
?>
	var data =[

	<?php

	foreach ($records as $idx => $record) :
		echo '"'.$idx.'":'.$record;
		$i++;
		echo $i<$recordNum?',':''; 
	endforeach;
	?>
	];
