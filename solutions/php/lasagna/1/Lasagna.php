<?php

class Lasagna
{
    public function expectedCookTime()
    {
        $time = 40;
        return $time;
    }

    public function remainingCookTime($elapsed_minutes)
    {
        $timeToCook = $this->expectedCookTime();
        $remainingTime = $timeToCook - $elapsed_minutes;
        return $remainingTime;
        
        // Implement the remainingCookTime method
    }

    public function totalPreparationTime($layers_to_prep)
    {
        $time_to_prep_slayers = 2 ;
        $totalMinutesPreparation = $layers_to_prep * $time_to_prep_slayers ;
        
        return $totalMinutesPreparation ;
        // Implement the totalPreparationTime method
    }

    public function totalElapsedTime($layers_to_prep, $elapsed_minutes)
    {
        $total_preparation_time = $this->totalPreparationTime($layers_to_prep);
            
        return $total_preparation_time + $elapsed_minutes;
        // Implement the totalElapsedTime method
    }

    public function alarm()
    {
        return "Ding!";
        // Implement the alarm method
    }
}
