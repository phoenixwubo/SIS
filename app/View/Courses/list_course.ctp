<?$courseCount=count($courses);

//debug($courses);

?>
{
totalcourse:<?php echo $courseCount?>,
success:true,
courseInJson:[
	<?php foreach($courses as $idx=>$course):?>
	{
		id:<?php echo $course['Course']['id']; ?>,
		course_name:'<?php echo $course['Course']['course_name']; ?>',
		user_id:<?php echo $course['Course']['user_id']; ?>,
		score_type:<?php echo $course['Course']['score_type']; ?>,
		course_type:<?php echo $course['Course']['course_type']; ?>,
		

		
}
<?php echo($idx<$courseCount-1)?',':'';?>
<?php endforeach;?>
]}
