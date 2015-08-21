<?php 
//  debug($teachingTasks);
$teachingTasksCount=count($teachingTasks);
?>

{
totalteachingTasks:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
teachingTasksInJson:[
	<?php foreach($teachingTasks as $idx=>$teachingTask):?>
	{
		id:<?php echo $teachingTask['TeachingTask']['id']; ?>,
		user_id:<?php echo $teachingTask['TeachingTask']['user_id']; ?>,
		course_plan_id:<?php echo $teachingTask['TeachingTask']['course_plan_id']; ?>,
		semester_id:<?php echo $teachingTask['CoursePlan']['semester_id']; ?>,
		department_id:<?php echo $teachingTask['TeachingTask']['department_id']; ?>,
		course_id:<?php echo $teachingTask['CoursePlan']['course_id']; ?>,
		note:<?php echo $teachingTask['TeachingTask']['note']==NULL?'null':'\''.$teachingTask['TeachingTask']['note'].'\''; ?>

		
}
<?php echo($idx<$teachingTasksCount-1)?',':'';?>
<?php endforeach;?>
]}
