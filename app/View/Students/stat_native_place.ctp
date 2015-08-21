<?php
$nativePlaceCount=count($nativePlaces);
?>
{
totalNativePlace:<?php echo $nativePlaceCount?>,
success:true,
nativePlaceInJson:[
<?php foreach($nativePlaces as $idx=>$nativePlace):?>
	{
		native_place:'<?php echo $nativePlace[0]['region']?>',
		number:<?php echo $nativePlace[0]['number']?>
	}
	<?php echo($idx<$nativePlaceCount-1)?',':'';?>
<?php endforeach;?>
]}
