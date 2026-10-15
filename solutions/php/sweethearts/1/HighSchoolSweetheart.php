<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        $ns_name = trim($name);
        return substr($ns_name,0,1);
    }

    public function initial(string $name): string
    {
        $initial = $this->firstLetter($name);
        return strtoupper($initial).'.' ;
    }

    public function initials(string $full_name): string
    {
        $array_name = explode(" ",$full_name);
        $initials = $this->initial($array_name[0]). " ". $this->initial($array_name[1]);
        return $initials;
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        $a = $this->initials($sweetheart_a);
        $b = $this->initials($sweetheart_b);
        $message = <<<HEART
         ******       ******
       **      **   **      **
     **         ** **         **
    **            *            **
    **                         **
    **     $a  +  $b     **
     **                       **
       **                   **
         **               **
           **           **
             **       **
               **   **
                 ***
                  *
    HEART;
        
        return $message;
    }
}
