
<?php 
if(isset($result)){
	//debug($result);
	$coursePlanCount=count($coursePlans);
	//debug($courses);

	?>
{
totalcoursePlan:<?php echo $coursePlanCount?>,
success:true,
coursePlanInJson:[
	<?php foreach($coursePlans as $idx=>$coursePlan):?>
	{
		id:<?php echo $coursePlan['CoursePlan']['id']; ?>,
		course_info:'<?php echo $coursePlan['Semester']['sem_name'].$coursePlan['Department']['dept_name'].$coursePlan['Course']['course_name']; ?>',
		course_id:<?php echo $coursePlan['Course']['id']?>,
		course_name:'<?php echo $coursePlan['Course']['course_name'];?>',
		semester_id:<?php echo $coursePlan['Semester']['id'];?>,
		sem_name:'<?php echo $coursePlan['Semester']['sem_name'];?>'

		
}
<?php echo($idx<$coursePlanCount-1)?',':'';?>
<?php endforeach;?>
]}

<?php 
}
else{
	


debug($coursePlans);}
// debug($coursePlans);	
?>