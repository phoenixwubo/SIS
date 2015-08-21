<?php 
if(isset($result)){
	echo (json_encode($result));
}
else{
?>
<?php /*debug($parents);
		debug($departments);*/ ?>
<div class="departments form">
<?php echo $this->Form->create('Department'); ?>
	<fieldset>
		<legend><?php echo __('Add Department'); ?></legend>
	<?php
		echo $this->Form->input('dept_name');
		echo $this->Form->input('year_in');
		echo $this->Form->input('year_graduate');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('leaf');
		echo $this->Form->input('users');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Departments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php }?>