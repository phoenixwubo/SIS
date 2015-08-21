<?php 
if(isset($result)){
echo(json_encode($result));
}else{

?><div class="courses form">
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Add Course'); ?></legend>
	<?php
		echo $this->Form->input('courser_name');
		echo $this->Form->input('user_id');
		echo $this->Form->input('type');
		echo $this->Form->input('term_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php 
}?>