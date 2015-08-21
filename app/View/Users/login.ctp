<?php echo $this->Session->flash('auth'); ?>
<?php 
if(!isset($result)){
echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->inputs(array(
'legend' => __('Login'),
'username',
'password'
));
echo $this->Form->end('Login');}
else
echo (json_encode($result));
?>