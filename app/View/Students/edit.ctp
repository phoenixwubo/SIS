<?php 

if(!isset($result)){?>
<div class="students form">
<?php echo $this->Form->create('Student'); ?>
	<fieldset>
		<legend><?php echo __('Edit Student'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('stuid');
		echo $this->Form->input('stu_name');
		echo $this->Form->input('id_card_number');
		echo $this->Form->input('dob');
		echo $this->Form->input('nationality');
		echo $this->Form->input('native_place');
		echo $this->Form->input('gender');
		echo $this->Form->input('address');
		echo $this->Form->input('parent_phone1');
		echo $this->Form->input('parent_phone2');
		echo $this->Form->input('status');
		echo $this->Form->input('password');
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Student.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Student.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php }
else {
	echo (json_encode($result));
	
}?>