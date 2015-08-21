<div class="scores view">
<h2><?php echo __('Score'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($score['Score']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course Id'); ?></dt>
		<dd>
			<?php echo h($score['Score']['course_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stu Number'); ?></dt>
		<dd>
			<?php echo h($score['Score']['stu_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regular'); ?></dt>
		<dd>
			<?php echo h($score['Score']['regular']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Midterm'); ?></dt>
		<dd>
			<?php echo h($score['Score']['midterm']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Final'); ?></dt>
		<dd>
			<?php echo h($score['Score']['final']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($score['Score']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tn1'); ?></dt>
		<dd>
			<?php echo h($score['Score']['tn1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('S1'); ?></dt>
		<dd>
			<?php echo h($score['Score']['s1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tn2'); ?></dt>
		<dd>
			<?php echo h($score['Score']['tn2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('S2'); ?></dt>
		<dd>
			<?php echo h($score['Score']['s2']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Score'), array('action' => 'edit', $score['Score']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Score'), array('action' => 'delete', $score['Score']['id']), null, __('Are you sure you want to delete # %s?', $score['Score']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Scores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Score'), array('action' => 'add')); ?> </li>
	</ul>
</div>
