<?php 

//echo $this->Html->script('users/allusers');
$studentCount=count($students);

// debug($students);

?>
{
totalStudent:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
studentInJson:[
	<?php foreach($students as $idx=>$student):?>
	{
		id:<?php echo $student['Student']['id']; ?>,
		stu_number:<?php echo $student['Student']['stu_number']; ?>,
		dept_number:<?php echo $student['Student']['dept_number']; ?>,
		stu_name:"<?php echo $student['Student']['stu_name']; ?>",
		gender:"<?php echo $student['Student']['gender']; ?>",
		id_card_number:"<?php echo $student['Student']['id_card_number']; ?>",
		status:"<?php echo $student['Student']['status']; ?>",
		dob:"<?php echo $student['Student']['dob']; ?>",
		address:"<?php echo $student['Student']['address']; ?>",
		nationality:"<?php echo $student['Student']['nationality']; ?>",
		native_place:"<?php echo $student['Student']['native_place']; ?>",
		parent_phone1:"<?php echo $student['Student']['parent_phone1']; ?>",
		parent_phone2:"<?php echo $student['Student']['parent_phone2']; ?>",
		note:<?php echo $student['Student']['note']==NULL?'null':'\''.$student['Student']['note'].'\''; ?>
		
}
<?php echo($idx<$studentCount-1)?',':'';?>
<?php endforeach;?>
]}