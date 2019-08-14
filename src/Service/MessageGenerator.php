<?php


namespace App\Service;


class MessageGenerator
{
    public function randomQuote()
    {
        $quotes = [
            'Quote number 1',
            'Quote number 2',
            'Quote number 3'
        ];

        $key = array_rand($quotes);

        return $quotes[$key];
    }
}