<?php
$electiveLessonCount=count($electiveLessons);
?>
{
	totalElectiveLesson:<?php echo $electiveLessonCount;?>,
	success:true,
	electiveLessonInJson:[
	<?php foreach ($electiveLessons as $idx=>$electiveLesson):?>
		{
			sem_name:'<?php echo $electiveLesson['Semester']['sem_name'];?>',
			department_id:<?php echo $electiveLesson['Elective']['department_id'];?>,
			lesson_number:<?php echo $electiveLesson[0]['number'];?>
		}
		<?php echo ($idx< $electiveLessonCount-1)?',':'';?>
		<?php endforeach;?>
	]
	}