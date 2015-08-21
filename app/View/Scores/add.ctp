<div class="scores form">
<?php echo $this->Form->create('Score'); ?>
	<fieldset>
		<legend><?php echo __('Add Score'); ?></legend>
	<?php
		echo $this->Form->input('course_id');
		echo $this->Form->input('stu_number');
		echo $this->Form->input('regular');
		echo $this->Form->input('midterm');
		echo $this->Form->input('final');
		echo $this->Form->input('total');
		echo $this->Form->input('tn1');
		echo $this->Form->input('s1');
		echo $this->Form->input('tn2');
		echo $this->Form->input('s2');
	?>
	<?php  debug ($courses)?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Scores'), array('action' => 'index')); ?></li>
	</ul>
</div>

