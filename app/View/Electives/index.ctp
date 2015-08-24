<?php 
if(isset($success)){
	$electiveCount=count($electives);
	
// 	debug ($electives);
?>
{
totalElectives:<?php echo  $this->Paginator->counter('{:count}')?>,
success:true,
electivesInJson:[
	<?php foreach ($electives as $idx=>$elective ):?>
		{
			id:<?php echo  $elective['Elective']['id'];?>,
			stu_number:'<?php echo  $elective['Elective']['stu_number'];?>',
			course_id:'<?php echo  $elective['Elective']['course_id']==null ? 'null' :$elective['Elective']['course_id'];?>',
			course_type:	<?php echo  $elective['Elective']['course_type'];?>,
			result:<?php echo $elective['Elective']['result']==null ? 'null' : $elective['Elective']['result'] ?>,
			stu_name:'<?php echo $elective['Student']['stu_name'];?>',
			semester_id:'<?php echo  $elective['CoursePlan']['semester_id'];?>'
		}
		<?php echo($idx<$electiveCount-1)?',':'';?>
		<?php endforeach;?>
]
}

<?php 
}
else {

?>
<div class="electives index">
	<h2><?php echo __('Electives'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('stu_number'); ?></th>
			<th><?php echo $this->Paginator->sort('course_id'); ?></th>
			<th><?php echo $this->Paginator->sort('semester_id'); ?></th>
			<th><?php echo $this->Paginator->sort('elective_number'); ?></th>
			<th><?php echo $this->Paginator->sort('result'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($electives as $elective): ?>
	<tr>
		<td><?php echo h($elective['Elective']['id']); ?>&nbsp;</td>
		<td><?php echo h($elective['Elective']['stu_number']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($elective['Course']['course_name'], array('controller' => 'courses', 'action' => 'view', $elective['Course']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($elective['Semester']['sem_name'], array('controller' => 'semesters', 'action' => 'view', $elective['Semester']['id'])); ?>
		</td>
		<td><?php echo h($elective['Elective']['elective_number']); ?>&nbsp;</td>
		<td><?php echo h($elective['Elective']['result']); ?>&nbsp;</td>
		<td><?php echo h($elective['Elective']['created']); ?>&nbsp;</td>
		<td><?php echo h($elective['Elective']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $elective['Elective']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $elective['Elective']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $elective['Elective']['id']), null, __('Are you sure you want to delete # %s?', $elective['Elective']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Elective'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php }?>