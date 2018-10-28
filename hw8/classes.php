<?php

class Technique
{
    private $color;
    private $model;

    public function colorSwitch($color)
    {
        return $this->color = $color;
    }
}

class Cars extends Technique
{
    private $engineType;

    public function __construct($color, $model, $engineType)
    {
        $this->color = $color;
        $this->model = $model;
        $this->engineType = $engineType;
    }

    public function changeEngine($engine) 
    {
        return $this->engineType = $engine;
    }
}

$audi = new Cars('blue', 'audi', 'petrol');
$bmw = new Cars('black', 'bmw', 'diesel');

class TVs extends Technique
{
    private $type;

    public function __constructor($color, $model, $type) 
    {
        $this->color = $color;
        $this->model = $model;
        $this->type = $type;
    }
}

$panasonic = new TVs('black', 'panasonic', 'lcd');
$toshiba = new TVs('gray', 'thosiba', 'plazma');



class Pens
{
    private $size;
    private $type;
    private $cost;

    public function __construct($size, $type, $cost)
    {
        $this->size = $size;
        $this->type = $type;
        $this->cost = $cost;
    }

    public function pensDiscountPercent($newCost) 
    {
        return $this->cost -= $this->cost * ($newCost/100);
    }  
}

$shortPen = new Pens(10, 'short pen', 33);
$shortPen->pensDiscountPercent(25);

$ballPen = new Pens(15, 'ball', 25);



class Ducks 
{
    private $width;
    private $height;
    private $feathersType;
    private $region;

    public function __construct($width, $height, $feathers, $region)
    {
        $this->width = $width;
        $this->height = $height;
        $this->feathersType = $feathers;
        $this->region = $region;
    }

    public function changeRegion($newRegion)
    {
        return $this->region = $newRegion;
    }
}

$southDuck = new Ducks(55, 100, 'fluffy', 'Europe');
$dendyDuck = new Ducks(12, 12, 'unknown', 'Duck hunt');


class Goodies extends Technique
{
    private $goodieType;
    private $width;
    private $height;

    public function __construct($color, $model, $goodieType, $width, $height)
    {
        $this->color = $color;
        $this->model = $model;
        $this->goodieType = $goodieType;
        $this->width = $width;
        $this->height = $height;
    }

    public function resize($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        return 'resize done!';
    }
}

$phone = new Goodies('black', 'xiaomi', 'phone', 150, 100);
$booksReader = new Goodies('lightgray', 'texet', 'boosReader', 250, 150);



