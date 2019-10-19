<?php
//Задание 1
if (!isset($_GET['path'])) {
    $path = '/';
} else {
    $path = $_GET['path'] . '/';
}
$dirIter = new DirectoryIterator($path);
foreach ($dirIter as $item) {
    echo "<a href='index.php?path=$path$item'>$item</a><br>";
}

$arr = [];
for ($i = 0; $i < 1000000; $i++) {
    $arr[$i] = $i;
}
$time = microtime(true);
foreach ($arr as $item) {
    $a = $item;
}
echo 'foreach: ' . round(microtime(true) - $time, 3) . '<br/>';
$time = microtime(true);
$obj = new ArrayObject($arr);
$it = $obj->getIterator();
while ($it->valid()) {
    $a = $it->current();
    $it->next();
}
echo 'spl: ' . round(microtime(true) - $time, 5);