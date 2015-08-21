<?php
if(isset($result)){
	echo(json_encode($result));
}else{
?>
<div class="coursePlans form">
<?php echo $this->Form->create('CoursePlan'); ?>
	<fieldset>
		<legend><?php echo __('Edit Course Plan'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('course_id');
		echo $this->Form->input('course_type');
		echo $this->Form->input('user_id');
		echo $this->Form->input('semester_id');
		echo $this->Form->input('score_type');
		echo $this->Form->hidden('original_user_id');
		echo $this->Form->hidden('original_date');
		echo $this->Form->hidden('note');
		echo $this->Form->input('department_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CoursePlan.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CoursePlan.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Course Plans'), array('action' => 'index')); ?></li>
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