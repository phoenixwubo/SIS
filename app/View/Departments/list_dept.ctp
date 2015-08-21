<?php 
// debug($Departments);
$departmentCount=count($Departments);
$i=0;?>
{
	'success':true,
	'totalDepartment':<?php echo $departmentCount?>,
	'deptInJson':[
<?php 	foreach ($Departments as $key=>$Department):

?>
{
'id':<?php echo $key?>,
'dept_name':'<?php echo $Department?>'

}
<?php

echo($i<$departmentCount-1)?',':'';	
$i++; ?>
<?php endforeach;?>
]

	
}