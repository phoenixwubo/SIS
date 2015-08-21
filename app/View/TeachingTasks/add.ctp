<?php 
if(isset($result)){
echo json_encode($result);
}else{

?><div class="teachingTasks form">
<?php echo $this->Form->create('TeachingTask'); ?>
	<fieldset>
		<legend><?php echo __('Add Teaching Task'); ?></legend>
	<?php
		echo $this->Form->input('department_id');
		echo $this->Form->input('course_plan_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Teaching Tasks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Plans'), array('controller' => 'course_plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Plan'), array('controller' => 'course_plans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
}?>