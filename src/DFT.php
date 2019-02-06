<?php

declare(strict_types=1);

namespace StjepanBrbot;

use Complex\Complex;

class DFT
{
    private $factors = [];
    private $spectra = [];

    public function __construct(Iterable $data)
    {
        $item_count = count($data);

        $real_part = round(cos(2*pi()/$item_count), 2);
        $imaginary_part = round(-sin(2*pi()/$item_count), 2);

        for ($i = 0; $i < $item_count; $i++) {

            $obj = new Complex(0, 0);
            for ($j = 0; $j < $item_count; $j++) {
                $obj = $obj->add(
                        (new Complex($real_part, $imaginary_part))
                            ->pow($i*$j)
                            ->multiply(new Complex($data[$j], 0))
                );
            }

            $this->factors[$i] = $obj;
            $this->spectra[$i] = $this->getMagnitude($obj);

        }
    }

    public function getFactors() : Iterable
    {
        return $this->factors;
    }

    public function getSpectra() : Iterable
    {
        return $this->spectra;
    }

    //Same as above, the documentation has the wrong name, aliasing here for compat
    public function getMagnitudes() : Iterable
    {
        return $this->getSpectra();
    }

    public function getMagnitude(Complex $num) : float
    {
        return sqrt( pow($num->getReal(), 2) + pow($num->getImaginary(), 2) );
    }
}
