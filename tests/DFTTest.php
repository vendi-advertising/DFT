<?php
namespace StjepanBrbot;

use StjepanBrbot\DFT;
use Complex\Complex;

function compare1DArrays(Iterable $a, Iterable $b) : bool
{
    foreach($a as $i => $val){
        if(abs($val - $b[$i]) > 0.001){
            return false;
        }
    }

    return true;
}

function compareComplexArrays(Iterable $a, Iterable $b) : bool
{
    foreach($a as $i => $C) {
        if(abs($C->getReal() - $b[$i]->getReal()) > 0.001){
            return false;
        }
        if(abs($C->getImaginary() - $b[$i]->getImaginary()) > 0.001){
            return false;
        }
    }

    return true;
}

class DFTTest extends \PHPUnit_Framework_TestCase
{

    public function testGetFactors()
    {
        $DFT = new DFT([2,3,-1,1]);
        $F = [new Complex(5,0), new Complex(3,-2), new Complex(-3,0), new Complex(3,2)];
        $this->assertTrue(compareComplexArrays($F, $DFT->getFactors()));
    }

    public function testGetSpectra()
    {
        $DFT = new DFT([2,3,-1,1]);
        $S = [5, 3.606, 3, 3.606];
        $this->assertTrue(compare1DArrays($S, $DFT->getSpectra()));
    }

}
