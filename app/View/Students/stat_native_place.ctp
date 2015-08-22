<?php
$nativePlaceCount=count($nativePlaces);
?>
{
totalNativePlace:<?php echo $nativePlaceCount?>,
success:true,
nativePlaceInJson:[
<?php foreach($nativePlaces as $idx=>$nativePlace):?>
	{
		native_place:'<?php echo $nativePlace['region']?>',
		number:<?php echo $nativePlace['number']?>
	}
	<?php echo($idx<$nativePlaceCount)?',':'';?>
<?php endforeach;?>
]}
