<div class="electives view">
<h2><?php echo __('Elective'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stu Number'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['stu_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($elective['Course']['course_name'], array('controller' => 'courses', 'action' => 'view', $elective['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo $this->Html->link($elective['Semester']['sem_name'], array('controller' => 'semesters', 'action' => 'view', $elective['Semester']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Elective Number'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['elective_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['result']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($elective['Elective']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Elective'), array('action' => 'edit', $elective['Elective']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Elective'), array('action' => 'delete', $elective['Elective']['id']), null, __('Are you sure you want to delete # %s?', $elective['Elective']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Electives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elective'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
	</ul>
</div>
