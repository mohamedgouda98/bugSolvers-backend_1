<?php

interface Car
{
    public function getCar();
}

class bmw implements Car {

    public function getCar()
    {
        echo 'bmw car<hr>';
    }
}

class lancer implements Car {

    public function getCar()
    {
        echo 'lancer car<hr>';
    }
}

class Tipo implements Car {


    public function getCar()
    {
        echo 'Tipo car<hr>';

    }
}


$cars = [new bmw(), new lancer(), new Tipo()];

foreach ($cars as $car)
{
    $car->getCar();
}