<?php 
if(isset($result)){
	echo(json_encode($result));
}
else{

?><div class="scores form">
<?php echo $this->Form->create('Score'); ?>
	<fieldset>
		<legend><?php echo __('Edit Score'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Score.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Score.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Scores'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php }
?>