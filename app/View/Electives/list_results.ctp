<?php
// debug($electives);
if(isset($success)){
	$electiveCount=count($electives);

// 		debug ($electives);
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
			course_type:<?php echo  $elective['Elective']['course_type'];?>,
			semester_id:'<?php echo $elective['CoursePlan']['semester_id'];?>',
			result:'<?php echo $elective['Elective']['result']==null ? 'null' : $elective['Elective']['result'] ?>',
			stu_name:'<?php echo $elective['Student']['stu_name'];?>'
		}
		<?php echo($idx<$electiveCount-1)?',':'';?>
		<?php endforeach;?>
]
}

<?php 
}
?>