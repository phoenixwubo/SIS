<?php 
if(isset($result)){
	//debug($result);
	


//echo $this->Html->script('users/allusers');
$courseCount=count($courses);

//debug($courses);

?>
{
totalcourse:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
courseInJson:[
	<?php foreach($courses as $idx=>$course):?>
	{
		id:<?php echo $course['Course']['id']; ?>,
		course_name:'<?php echo $course['Course']['course_name']; ?>',
		user_id:<?php echo $course['Course']['user_id']; ?>,
		score_type:<?php echo $course['Course']['score_type']; ?>,
		course_type:<?php echo $course['Course']['course_type']; ?>,
		

		
}
<?php echo($idx<$courseCount-1)?',':'';?>
<?php endforeach;?>
]}

<?php 
}
else{
	debug($course);	

?>
<div class="courses index">
	<h2><?php echo __('Courses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('courser_name'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($courses as $course): ?>
	<tr>
		<td><?php echo h($course['Course']['id']); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['courser_name']); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $course['Course']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $course['Course']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $course['Course']['id']), null, __('Are you sure you want to delete # %s?', $course['Course']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Course'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php 
}?>