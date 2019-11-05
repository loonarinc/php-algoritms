<?php
function Polindrom($string){
    if (strlen($string)<=1) {
        return true;
    }
    if (mb_substr($string,0,1) == mb_substr($string,-1)){
        return (Polindrom(mb_substr($string, 1, strlen($string)-2)));
    }
}

echo Polindrom('racecar');
