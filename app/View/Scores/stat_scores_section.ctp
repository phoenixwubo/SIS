<?php
// debug($scoreSections);
$scoreSectionCount=count($scoreSections);
$departmentCount=count($departments);
?>
{
totalScoreSection:<?php echo $scoreSectionCount?>,
success:true,
departmentInJson:[
'section',
<?php foreach($departments as $idx=>$department):?>
'<?php echo $department['Score']['dept_number']?>'
<?php echo ($idx<$departmentCount-1)?',':'';?>
<?php endforeach;?>
],
scoreSectionInJson:[
<?php $i=0;$number=$scoreSectionCount?>

<?php foreach($scoreSections as $idx=>$scoreSection):?>
	
	{
		'section':'<?php echo $idx/* $scoreSection['section'] */?>',
		<?php $numbers=$scoreSection?>
		<?php $j=0;$dept_number=count($scoreSection)?>
		<?php foreach($numbers as $number_idx=>$number):?>
		'<?php echo $number_idx?>':<?php echo $number/* echo $scoreSection['number'] */?>
		<?php $j++; echo($j<$dept_number)?',':'';?>
		<?php endforeach;?>
	}
	<?php $i++; echo($i<$scoreSectionCount)?',':'';?>
<?php endforeach;?>
],
maximum:<?php echo $maximum?>,
minimum:0}
