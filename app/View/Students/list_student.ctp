<?php 

//echo $this->Html->script('users/allusers');
$studentCount=count($students);

//debug($students);

?>
{
totalStudent:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
studentInJson:[
	<?php foreach($students as $idx=>$student):?>
	{
		id:<?php echo $student['Student']['id']; ?>,
		fullname:"<?php echo $student['User']['fullname']; ?>",
		gender:"<?php echo $student['User']['gender']; ?>",
		stu_number:"<?php echo $student['Student']['stu_number']; ?>",
		dept_name:"<?php echo $student['Dept']['dept_name']; ?>"
		

		
}
<?php echo($idx<$studentCount-1)?',':'';?>
<?php endforeach;?>
]}