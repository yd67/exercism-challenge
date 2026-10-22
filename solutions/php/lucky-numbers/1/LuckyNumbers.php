<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        $number1 = implode($digitsOfNumber1);
        $number2 = implode($digitsOfNumber2);
        
        return (int) $number1 + (int) $number2 ;
    }

    public function isPalindrome(int $number): bool
    {
        $is_palindrome = false;
        $reverse_number = strrev($number);
        if ((int) $reverse_number === $number) {
            $is_palindrome = true;
        }
        
        return $is_palindrome;
    }

    public function validate(string $input): string
    { 
        $message = '';
        if((int)$input <= 0 ){
            $message = "Must be a whole number larger than 0";
        }
        if($input === ''){
            $message = "Required field";
        }
        
        return $message;
    }
}
