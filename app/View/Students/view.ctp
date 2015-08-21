<?php 
if(isset($result)){
echo (json_encode($result));
}else{

?>
<div class="students view">
<h2><?php echo __('Student'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($student['Student']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stu Id'); ?></dt>
		<dd>
			<?php echo h($student['Student']['stu_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stu Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['stu_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Card Number'); ?></dt>
		<dd>
			<?php echo h($student['Student']['id_card_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dob'); ?></dt>
		<dd>
			<?php echo h($student['Student']['dob']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationality'); ?></dt>
		<dd>
			<?php echo h($student['Student']['nationality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Native Place'); ?></dt>
		<dd>
			<?php echo h($student['Student']['native_place']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($student['Student']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($student['Student']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Phone1'); ?></dt>
		<dd>
			<?php echo h($student['Student']['parent_phone1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Phone2'); ?></dt>
		<dd>
			<?php echo h($student['Student']['parent_phone2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($student['Student']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($student['Student']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($student['Student']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($student['Student']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($student['Student']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Student'), array('action' => 'edit', $student['Student']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Student'), array('action' => 'delete', $student['Student']['id']), null, __('Are you sure you want to delete # %s?', $student['Student']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Students'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<?php 
}?>