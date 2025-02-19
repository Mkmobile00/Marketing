<?php
namespace App\Abstract;

use ReflectionClass;

abstract class Enum 
{

    public static function getAllValues(): array
    {
        $refl = new ReflectionClass(get_called_class());
        $consts = $refl->getConstants();

        $data = [];

        foreach($consts as $index=>$constant) {
            $data[$index] = $constant;
        }
        return $data;
    }
    public static function getSingleValue($value)
    {
        $refl = new ReflectionClass(get_called_class());
        $consts = $refl->getConstants();
        foreach($consts as $index=>$constant) {
            if($constant == $value){
                return $index;
            }
        }
    }

    public function getSingleValueByIndex($i)
    {
        $refl = new ReflectionClass(get_called_class());
        $consts = $refl->getConstants();
        foreach($consts as $index=>$constant) {
            if($index == $i){
                return $constant;
            }
        }
    }
}
