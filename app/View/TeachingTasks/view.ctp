<div class="teachingTasks view">
<h2><?php echo __('Teaching Task'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($teachingTask['TeachingTask']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($teachingTask['Department']['dept_name'], array('controller' => 'departments', 'action' => 'view', $teachingTask['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Plan'); ?></dt>
		<dd>
			<?php echo $this->Html->link($teachingTask['CoursePlan']['course_id'], array('controller' => 'course_plans', 'action' => 'view', $teachingTask['CoursePlan']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($teachingTask['User']['fullname'], array('controller' => 'users', 'action' => 'view', $teachingTask['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($teachingTask['TeachingTask']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($teachingTask['TeachingTask']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($teachingTask['TeachingTask']['note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teaching Task'), array('action' => 'edit', $teachingTask['TeachingTask']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Teaching Task'), array('action' => 'delete', $teachingTask['TeachingTask']['id']), null, __('Are you sure you want to delete # %s?', $teachingTask['TeachingTask']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teaching Tasks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teaching Task'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Course Plans'), array('controller' => 'course_plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course Plan'), array('controller' => 'course_plans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
