<?php 
// debug($scores);
$ScoreCount=count($scores);



?>
{
totalStudentScore:<?php echo $ScoreCount?>,
success:true,
studentScoreInJson:[
	<?php foreach($scores as $idx=>$score):?>
	{
		id:<?php echo $score['Score']['id']; ?>,
		course_plan_id:<?php echo $score['Score']['course_plan_id']; ?>,
		course_id:<?php echo $score['CoursePlan']['course_id']; ?>,
		stu_name:'<?php echo $score['Student']['stu_name']; ?>',
		stu_number:'<?php echo $score['Score']['stu_number']; ?>',
		regular:<?php echo $score['Score']['regular']; ?>,
		midterm:<?php echo $score['Score']['midterm']; ?>,
		final:<?php echo ($score['Score']['final']); ?>,
		total:<?php echo ($score['Score']['total']); ?>
		
}
<?php echo($idx<$ScoreCount-1)?',':'';?>
<?php endforeach;?>
]}

