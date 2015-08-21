<div class="electives form">
<?php echo $this->Form->create('Elective'); ?>
	<fieldset>
		<legend><?php echo __('Edit Elective'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('stu_number');
		echo $this->Form->input('course_id');
		echo $this->Form->input('semester_id');
		echo $this->Form->input('elective_number');
		echo $this->Form->input('result');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Elective.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Elective.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Electives'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
	</ul>
</div>
