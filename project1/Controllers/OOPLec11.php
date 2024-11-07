<?php

class Car
{
   public function color($value)
   {
       echo  "this color is : ". $value;
   }

   public function motor($value)
   {
       echo "motor is : " . $value;
   }

}

trait Glass
{
    public function GlassType()
    {
        echo "<hr>Glass type is egypt";
    }

}



class XCar extends Car
{
    use Glass;
}



$myCar = new XCar();
$myCar->color("black");
$myCar->GlassType();