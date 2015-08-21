<?php 
if(isset($result))
{
	echo(json_encode($result));

}
else{

?><div class="semesters form">
<?php echo $this->Form->create('Semester'); ?>
	<fieldset>
		<legend><?php echo __('Add Semester'); ?></legend>
	<?php
		echo $this->Form->input('year');
		echo $this->Form->input('sem_name');
		echo $this->Form->input('sem_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Semesters'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php }?>