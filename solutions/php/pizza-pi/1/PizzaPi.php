<?php

class PizzaPi
{
    public function calculateDoughRequirement($pizzas,$persons)
    {
        $grams= $pizzas * (($persons * 20) + 200 );
        return $grams;
    }

    public function calculateSauceRequirement($pizzas,$sauce_box_volume)
    {
        $box_to_buy =  (int) ceil(($pizzas * 125) / $sauce_box_volume );
        return $box_to_buy;
    }

    public function calculateCheeseCubeCoverage($cheese_dimension,$thickness,$diameter)
    {
        $PI = pi();
        $pizzas = (int) floor(($cheese_dimension ** 3) / ($thickness * $PI * $diameter));
        return $pizzas;
    }

    public function calculateLeftOverSlices($pizzas,$friends)
    {
        $part = ( $pizzas * 8)  % $friends;
        return $part;
    }
}
