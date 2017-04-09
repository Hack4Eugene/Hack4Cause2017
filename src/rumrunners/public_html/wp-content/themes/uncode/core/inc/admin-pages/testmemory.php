<?php
// This is only an example, the numbers below will
// differ depending on your system

for($i=16;$i<1000;$i+=4){
  $a = loadmem($i-4);
  echo '%' . $i . "\n";
  unset($a);
}

function loadmem($howmuchmeg) {
	$dummy = str_repeat("-",1048576*$howmuchmeg);
	$a = memory_get_peak_usage(true)/1048576;
  return $a;
}

?>