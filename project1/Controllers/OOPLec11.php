<?php

abstract class Book
{
    public $name;
    public function name()
    {
        echo "name is : {$this->name}";
    }

    abstract public function subjects();
}

interface test
{
   public function getName($name);
}



class Math extends Book implements test {

    public function subjects()
    {
        echo "1,2,3,4";
    }

    public function getName($name)
    {

    }

}

$ob = new Math();
$ob->name = "Math";
$ob->name();
$ob->subjects();


