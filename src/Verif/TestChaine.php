<?php


namespace App\Verif;


class TestChaine
{
    public function VerifMotClef($text)
    {
        preg_match('#(viagra|java)#i', $text, $result);
        return $result;
    }
}