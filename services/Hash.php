<?php
namespace app\services;

class Hash
{
    public function make(string $string): string
    {
        $salt1 = 'trgf746';
        $salt2 = 'p58fbnn28';
        return md5($salt1 . $string . $salt2);
    }
}