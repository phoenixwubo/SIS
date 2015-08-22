<?php 

//echo $this->Html->script('users/allusers');
$userCount=count($users);

// debug($users);

?>
{
totalUser:<?php /* echo $this->Paginator->counter('{:count}') */echo $userCount;?>,
success:true,
userInJson:[
	<?php foreach($users as $idx=>$user):?>
	{
		id:<?php echo $user['User']['id']; ?>,
		fullname:"<?php echo $user['User']['fullname']; ?>",
		gender:"<?php echo $user['User']['gender']; ?>",
		dob:"<?php echo $user['User']['dob']; ?>",
		main_subject:<?php echo $user['User']['main_subject']; ?>
		
}
<?php echo($idx<$userCount-1)?',':'';?>
<?php endforeach;?>
]}