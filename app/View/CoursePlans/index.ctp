<?php 
if(isset($result)){
	//debug($result);
$coursePlanCount=count($coursePlans);
//debug($courses);

?>
{
totalcoursePlan:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
coursePlanInJson:[
	<?php foreach($coursePlans as $idx=>$coursePlan):?>
	{
		id:<?php echo $coursePlan['CoursePlan']['id']; ?>,
		course_id:<?php echo $coursePlan['CoursePlan']['course_id']==null?'null':$coursePlan['CoursePlan']['course_id']; ?>,
		score_type:<?php echo $coursePlan['CoursePlan']['score_type']; ?>,
		course_type:<?php echo $coursePlan['CoursePlan']['course_type']; ?>,
		user_id:<?php echo $coursePlan['CoursePlan']['user_id']; ?>,
		semester_id:<?php echo $coursePlan['CoursePlan']['semester_id']; ?>,
		department_id:<?php echo $coursePlan['CoursePlan']['department_id']; ?>,
		implement:<?php echo $coursePlan['CoursePlan']['implement']; ?>,
		note:<?php echo $coursePlan['CoursePlan']['note']==NULL?'null':'\''.$coursePlan['CoursePlan']['note'].'\''; ?>

		
}
<?php echo($idx<$coursePlanCount-1)?',':'';?>
<?php endforeach;?>
]}

<?php 
}
else{
	debug($coursePlans);	

?>
<div class="coursePlans index">
	<h2><?php echo __('Course Plans'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('course_id'); ?></th>
			<th><?php echo $this->Paginator->sort('course_type'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('semester_id'); ?></th>
			<th><?php echo $this->Paginator->sort('score_type'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($coursePlans as $coursePlan): ?>
	<tr>
		<td><?php echo h($coursePlan['CoursePlan']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($coursePlan['Course']['course_name'], array('controller' => 'courses', 'action' => 'view', $coursePlan['Course']['id'])); ?>
		</td>
		<td><?php echo h($coursePlan['CoursePlan']['course_type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($coursePlan['User']['fullname'], array('controller' => 'users', 'action' => 'view', $coursePlan['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coursePlan['Semester']['sem_name'], array('controller' => 'semesters', 'action' => 'view', $coursePlan['Semester']['id'])); ?>
		</td>
		<td><?php echo h($coursePlan['CoursePlan']['score_type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($coursePlan['Department']['dept_name'], array('controller' => 'departments', 'action' => 'view', $coursePlan['Department']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $coursePlan['CoursePlan']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $coursePlan['CoursePlan']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $coursePlan['CoursePlan']['id']), null, __('Are you sure you want to delete # %s?', $coursePlan['CoursePlan']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Course Plan'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php }?>