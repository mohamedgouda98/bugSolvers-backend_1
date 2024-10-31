<?php

interface Car
{
    public function color($value);

    public function motor();

}

interface Tires
{
    public function tires();
}


class bmw implements Car {

    public function color($value)
    {
        echo 'bmw color : ' . $value . '<hr>';
    }

    public function motor()
    {
       echo '2000 CCT';
    }
}


class lancer implements Car, Tires
{
    public function motor()
    {
        return '1600 cc';
    }

    public function color($color)
    {
        echo 'lancer color is : ' . $color . '<hr>';
    }

    public function tires()
    {
        echo '14/7';
    }
}




$carBM = new bmw();
$carBM->color('green');


$carLancer = new lancer();
$carLancer->color('black');

