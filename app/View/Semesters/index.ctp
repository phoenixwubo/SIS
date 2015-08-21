<?php 
if(isset($result)){

	
$SemesterCount=count($semesters);

//debug($semesters);

?>
{
totalSemester:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
semesterInJson:[
	<?php foreach($semesters as $idx=>$semester):?>
	{
		'id':<?php echo $semester['Semester']['id']; ?>,
		'sem_name':'<?php echo $semester['Semester']['sem_name']; ?>',
		'sem_number':<?php echo $semester['Semester']['sem_number']; ?>,
		'year':<?php echo $semester['Semester']['year']; ?>,
		'current':<?php echo ($semester['Semester']['current'])?1:0; ?>
		
}
<?php echo($idx<$SemesterCount-1)?',':'';?>
<?php endforeach;?>
]}

<?php 
}
else{
	debug($Semester);	

?>
<div class="semesters index">
	<h2><?php echo __('Semesters'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('sem_name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('sem_number'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($semesters as $semester): ?>
	<tr>
		<td><?php echo h($semester['Semester']['id']); ?>&nbsp;</td>
		<td><?php echo h($semester['Semester']['year']); ?>&nbsp;</td>
		<td><?php echo h($semester['Semester']['sem_name']); ?>&nbsp;</td>
		<td><?php echo h($semester['Semester']['created']); ?>&nbsp;</td>
		<td><?php echo h($semester['Semester']['modified']); ?>&nbsp;</td>
		<td><?php echo h($semester['Semester']['sem_number']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $semester['Semester']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $semester['Semester']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $semester['Semester']['id']), null, __('Are you sure you want to delete # %s?', $semester['Semester']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Semester'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php 
}
?>