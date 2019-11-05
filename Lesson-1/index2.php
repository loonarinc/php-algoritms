<?php
define("LIMIT", 1000000);
$array = [];
for ($i = 0; $i < LIMIT; $i++) {
    $array[$i] = $i;
}
$time = microtime(true);
foreach ($array as $item) {
    $a = $item;
}
echo microtime(true) - $time . '<br/>';
$time = microtime(true);
$obj = new ArrayObject($array);
$item2 = $obj->getIterator();
while ($item2->valid()) {
    $a = $item2->current();
    $item2->next();
}
echo microtime(true) - $time;