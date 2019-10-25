<?php
function isPrime($number)
{
    if ($number == 1)
        return false;
    else if ($number == 2)
        return true;
    else if (($number % 2 == 0) or ($number % 10 == 5))
        return false;
    else {
         //начнём поиск простых чисел с 3
        //нет смысла перебирать числа больше квадратного корня из искомого,
        //достаточно нати наименьший делитель
        //преобразуем к целому
        //нет смысла проверять чётные числа
        for ($i = 3; $i <= ((int)sqrt($number)); $i += 2) {
            if (substr($i, -1) != "5")
                if ($number % $i == 0)
                    return false;
        }
        return true;
    }
}

//$answer = isPrime(997);
//var_dump($answer);
$n = 600851475143;
for ($i = 2; $i < (int)$n / 3; $i++) {
    if ($n % $i == 0)
        if (isPrime($i))
            echo $i . "<br>";
}