<?php 

//echo $this->Html->script('users/allusers');
$userCount=count($users);

// debug($users);

?>
{
totalUser:<?php echo $this->Paginator->counter('{:count}')?>,
success:true,
userInJson:[
	<?php foreach($users as $idx=>$user):?>
	{
		id:<?php echo $user['User']['id']; ?>,
		username:'<?php echo $user['User']['username']; ?>',
		password:'<?php echo $user['User']['password']; ?>',
		fullname:"<?php echo $user['User']['fullname']; ?>",
		gender:"<?php echo $user['User']['gender']; ?>",
		dob:"<?php echo $user['User']['dob']; ?>",
	

		
}
<?php echo($idx<$userCount-1)?',':'';?>
<?php endforeach;?>
]}