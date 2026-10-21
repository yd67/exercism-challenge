<?php

require_once __DIR__ . '/Size.php';
require_once __DIR__ . '/Position.php';

class ProgramWindow
{
    public $y;
    public $x;
    public $height;
    public $width;

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->height = 600;
        $this->width = 800;
    }

    public function resize(Size $size ){
        $this->height = $size->height;
        $this->width = $size->width;
    }

    public function move(Position $position){
        $this->y = $position->y;
        $this->x = $position->x;
    }
}
