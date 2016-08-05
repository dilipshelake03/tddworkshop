<?php

namespace phpreboot\tddworkshop;

class Calculator
{
    public function add($numbers = '')
    {
        $numbersArray = $this->getOperationDone($numbers);
        if (is_array($numbersArray)) {
            return array_sum($numbersArray);
        } else {
            return $numbersArray;
        }
    }
    public function multiply($numbers = '')
    {
        $numbersArray = $this->getOperationDone($numbers);
        if (is_array($numbersArray)) {
            return array_product($numbersArray);
        } else {
            return $numbersArray;
        }
    }
    private function getOperationDone($numbers)
    {
        if (empty($numbers)) {
            return 0;
        }
        $this->checkException($numbers);
        /* code Add method should allow to define what delimiter is used to separate numbers */
        $numbersArray = $this->getArray($numbers);
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }
        /* code for not allowing negative numbers as a arguments */
        $this->checkNegative($numbersArray);
        /* end of negative number check */
        $numbersArray = $this->ignorNumber($numbersArray); //for ignoring the number above 1000
        return $numbersArray;
    }
    //for ignoring the number above 1000
    private function ignorNumber($numbersArray)
    {
        /* code for ignoring number greter than 1000 */
        rsort($numbersArray);
        if ($numbersArray[0] >= 1000) {
            $greater = array_filter(
                $numbersArray, function ($value) {
                    return $value >= 1000;
                }
            );
            $numbersArray = array_diff($numbersArray,$greater);
        }
        return $numbersArray;
        /* end of the code */
    }
    private function getArray($numbers)
    {
        if (strchr($numbers, "\\") && !strchr($numbers, '\n')) {
            $numbersArray = explode('\\', $numbers);
            $delimeter = $numbersArray[1];
            $numbersArray = $numbersArray[2];
            $numbersArray = explode($delimeter, $numbersArray);
        } elseif (strpos($numbers, '\n')) { /* replace \n with comma seperator */
            $numbers = str_replace('\n', ',', $numbers);
            $numbersArray = explode(",", $numbers);
        } else {
            $numbersArray = explode(",", $numbers);
        }
        return $numbersArray;
    }
    private function checkNegative($numbersArray)
    {
        sort($numbersArray);
        //for getting negative number list
        if ($numbersArray[0] < 0) {
            $negative = array_filter(
                $numbersArray, function ($value) {
                    return $value < 0;
                }
            );
            $negative = implode(' ', $negative);
            throw new \InvalidArgumentException('Negative numbers ('.$negative .') not allowed.');
        }
    }
    private function checkException($numbers)
    {
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }
    }
}
