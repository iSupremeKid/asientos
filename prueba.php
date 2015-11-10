<h4>Crear array JSON</h4>

<?php
$objPrueba = array(
	array("valorGeneral1",array(
		"subValorGeneral1-1",
		"subValorGeneral1-2",
		"subValorGeneral1-3"
		)),
	array("valorGeneral2",array(
		"subValorGeneral2-1",
		"subValorGeneral2-2",
		"subValorGeneral2-3"
		)),
	array("valorGeneral3",array())
	);
$jsonPrueba = json_encode($objPrueba);
echo $jsonPrueba;
?>

<h4>Obj PHP serializado</h4>
<?php 
$h = serialize($objPrueba);
echo $h;
 ?>
<h4>Obj PHP unserializado</h4>
<?php 
print_r(unserialize($h));
 ?>


<?php 
$array = array(
	array("uno"=>"primero"),
	array("dos"=>"segundo"),
	array("tres"=>"tercero"),
	array("cuatro"=>"cuarto"),
	array("quinto"=>"quinto"),
	);
$array2 = array()
 ?>
 <h4>Array original</h4>
 <?php print_r($array); ?>
 <h4>Despues de aplicarle unset</h4>
 <?php
unset($array[2]);
print_r($array);
 ?>
 <h4>Despues de hacerle merge experimento</h4>
 <?php
$array = array_merge($array,array("ola"=>"ke"));
print_r($array);
 ?>

 <h4>Despues de hacerle merge exp 2</h4>
 <?php
 function expr(){
 	return array("jota"=>"ka");
 }
$array = array_merge($array,expr());
print_r($array);
 ?>

 <h4>Despues de hacerle merge a un array vacio</h4>
 <?php
$array2 = array_merge($array2,expr());
print_r($array2);
 ?>


 <h4>Despues de crear una entrada nueva y hacerle merge a ella</h4>
 <?php
 $array2['chi'] = array();
$array2['chi'] = array_merge($array2['chi'],expr());
print_r($array2);
 ?>
