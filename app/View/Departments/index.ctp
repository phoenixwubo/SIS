
<?php
if(isset($Departments))
{
	$departmentsCount=count($Departments);
// 	debug($Departments);
?>
{
totaldepartments:<?php echo $departmentsCount;?>,
success:true,
departmentsInJson:[
	<?php foreach($Departments as $idx=>$Department):?>
	{
		id:<?php echo $Department['Department']['id']; ?>,
		dept_number:<?php echo $Department['Department']['dept_number']==NULL?'null':'\''.$Department['Department']['dept_number'].'\'' ?>,
		dept_name:'<?php echo $Department['Department']['dept_name']; ?>',
		parent_id:<?php echo $Department['Department']['parent_id']==NULL?'null':'\''.$Department['Department']['parent_id'].'\'' ; ?>

		
}
<?php echo($idx<$departmentsCount-1)?',':'';?>
<?php endforeach;?>
]}
<?php 

}
else{
	
echo $this->Html->link("Add Category",array('action'=>'add'));
echo "<ul>";
foreach($Departments as $key=>$value){
 $editurl = $this->Html->link("Edit", array('action'=>'edit', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Edit This Node'));
 $upurl = $this->Html->link("Up", array('action'=>'moveup', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Move Up the Tree'));
 $downurl = $this->Html->link("Down", array('action'=>'movedown', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Move Down the Tree'));
 $deleteurl = $this->Html->link("Delete", array('action'=>'delete', $key),array('style'=>'font-weight:lighter;font-size:9px;color:green;','title'=>'Delete the Node from the Tree'));
 $removeurl =$this->Html->link("Remove From Tree",array('action'=>'removeNode',$key),array('style'=>'font-weight:lighter;font-size:9px;color:#b3b3b3;','title'=>'Remove the Node from the Tree'));
 echo "<li><sub>-$editurl-$upurl-$downurl-$deleteurl- </sub><span style='color:red;'>$value</span> <sup>$removeurl</sup></li>";
}
echo "</ul>";}
?>
