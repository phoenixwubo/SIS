<?php
if(isset($result)){

// debug($scores);	
$ScoreCount=count($scores);

?>
{
totalScore:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
scoreInJson:[
	<?php foreach($scores as $idx=>$score):?>
	{
		
		id:<?php echo $score['Score']['id']; ?>,
		course_id:<?php echo $score['CoursePlan']['course_id']; ?>,
		dept_number:<?php echo $score['Score']['dept_number']; ?>,
		stu_name:"<?php echo $score['Student']['stu_name']; ?>",
		stu_number:'<?php echo $score['Score']['stu_number']; ?>',
		course_plan_id:<?php echo $score['Score']['course_plan_id']; ?>,
		regular:<?php echo $score['Score']['regular']; ?>,
		midterm:<?php echo $score['Score']['midterm']; ?>,
		final:<?php echo ($score['Score']['final']); ?>,
		total:<?php echo ($score['Score']['total']); ?>,
		s1:<?php echo ($score['Score']['s1']); ?>,
		s2:<?php echo ($score['Score']['s2']); ?>
		
}
<?php echo($idx<$ScoreCount-1)?',':'';?>
<?php endforeach;?>
]}

<?php 
}
else{
	debug($Score);	

?>
<div class="scores index">
	<h2><?php echo __('Scores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('course_id'); ?></th>
			<th><?php echo $this->Paginator->sort('stu_number'); ?></th>
			<th><?php echo $this->Paginator->sort('regular'); ?></th>
			<th><?php echo $this->Paginator->sort('midterm'); ?></th>
			<th><?php echo $this->Paginator->sort('final'); ?></th>
			<th><?php echo $this->Paginator->sort('total'); ?></th>
			<th><?php echo $this->Paginator->sort('tn1'); ?></th>
			<th><?php echo $this->Paginator->sort('s1'); ?></th>
			<th><?php echo $this->Paginator->sort('tn2'); ?></th>
			<th><?php echo $this->Paginator->sort('s2'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($scores as $score): ?>
	<tr>
		<td><?php echo h($score['Score']['id']); ?>&nbsp;</td>
		<td><?php echo h($score['Course']['course_name']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['stu_number']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['regular']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['midterm']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['final']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['total']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['tn1']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['s1']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['tn2']); ?>&nbsp;</td>
		<td><?php echo h($score['Score']['s2']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $score['Score']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $score['Score']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $score['Score']['id']), null, __('Are you sure you want to delete # %s?', $score['Score']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Score'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php 
}
?>