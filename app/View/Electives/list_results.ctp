<?php
// debug($electives);
if(isset($success)){
	$electiveCount=count($electives);

	// 	debug ($electives);
	?>
{
totalElectives:<?php echo $electiveCount;?>,
success:true,
electivesInJson:[
	<?php foreach ($electives as $idx=>$elective):?>
		{
			id:<?php echo  $elective['Elective']['id'];?>,
			stu_number:'<?php echo  $elective['Elective']['stu_number'];?>',
			course_id:'<?php echo  $elective['Elective']['course_id'];?>',
			course_type:	<?php echo  $elective['Elective']['course_type'];?>,
			sem_name:'<?php echo $elective['Semester']['sem_name'];?>',
			lesson_number:<?php echo $elective['Elective']['lesson_number']?>,
			result:<?php echo $elective['Elective']['result']==null ? 'null' : $elective['Elective']['result'] ?>,
			stu_name:'<?php echo $elective['Student']['stu_name'];?>'
		}
		<?php echo($idx<$electiveCount-1)?',':'';?>
		<?php endforeach;?>
]
}

<?php 
}