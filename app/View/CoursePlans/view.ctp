<div class="coursePlans view">
<h2><?php echo __('Course Plan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coursePlan['CoursePlan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coursePlan['Course']['course_name'], array('controller' => 'courses', 'action' => 'view', $coursePlan['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Type'); ?></dt>
		<dd>
			<?php echo h($coursePlan['CoursePlan']['course_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coursePlan['User']['fullname'], array('controller' => 'users', 'action' => 'view', $coursePlan['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coursePlan['Semester']['sem_name'], array('controller' => 'semesters', 'action' => 'view', $coursePlan['Semester']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score Type'); ?></dt>
		<dd>
			<?php echo h($coursePlan['CoursePlan']['score_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coursePlan['Department']['dept_name'], array('controller' => 'departments', 'action' => 'view', $coursePlan['Department']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Course Plan'), array('action' => 'edit', $coursePlan['CoursePlan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course Plan'), array('action' => 'delete', $coursePlan['CoursePlan']['id']), null, __('Are you sure you want to delete # %s?', $coursePlan['CoursePlan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Plans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Plan'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Semesters'), array('controller' => 'semesters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Semester'), array('controller' => 'semesters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>
