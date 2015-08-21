<?php
if(isset($result)){
?>	
{success:true,
data:{
	id:<?php echo $department['Department']['id']; ?>,
	dept_name:'<?php echo $department['Department']['dept_name']; ?>',
	dept_number:'<?php echo $department['Department']['dept_number']; ?>',
	
	parent_id:<?php echo $department['Department']['parent_id']==NULL?'null':$department['Department']['parent_id']; ?>,
	year_in:'<?php echo $department['Department']['year_in']; ?>',
	year_graduate:'<?php echo $department['Department']['year_graduate']; ?>'
	}
	
}	
<?php 	
} 
else{
	

?>
<?php debug($students) ?>
<div class="departments view">
<h2><?php echo __('Department'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($department['Department']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dept Name'); ?></dt>
		<dd>
			<?php echo h($department['Department']['dept_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year In'); ?></dt>
		<dd>
			<?php echo h($department['Department']['year_in']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year Graduate'); ?></dt>
		<dd>
			<?php echo h($department['Department']['year_graduate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($department['ParentDepartment']['dept_name'], array('controller' => 'departments', 'action' => 'view', $department['ParentDepartment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Leaf'); ?></dt>
		<dd>
			<?php echo h($department['Department']['leaf']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Department'), array('action' => 'edit', $department['Department']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Department'), array('action' => 'delete', $department['Department']['id']), null, __('Are you sure you want to delete # %s?', $department['Department']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($department['users'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Fullname'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('DOB'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($department['users'] as $users): ?>
		<tr>
			<td><?php echo $users['id']; ?></td>
			<td><?php echo $users['username']; ?></td>
			<td><?php echo $users['password']; ?></td>
			<td><?php echo $users['fullname']; ?></td>
			<td><?php echo $users['gender']; ?></td>
			<td><?php echo $users['DOB']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $users['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $users['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $users['id']), null, __('Are you sure you want to delete # %s?', $users['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<?php 
}?>