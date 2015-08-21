<div class="semesters view">
<h2><?php echo __('Semester'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sem Name'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['sem_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sem Number'); ?></dt>
		<dd>
			<?php echo h($semester['Semester']['sem_number']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Semester'), array('action' => 'edit', $semester['Semester']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Semester'), array('action' => 'delete', $semester['Semester']['id']), null, __('Are you sure you want to delete # %s?', $semester['Semester']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('action' => 'add')); ?> </li>
	</ul>
</div>
