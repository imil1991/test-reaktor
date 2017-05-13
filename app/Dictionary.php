<?php


namespace app;


class Dictionary implements DictionaryInterface
{

    public static $words = [

    ];

    /**
     * @inheritdoc
     */
    public function getDictionary():array
    {
        return static::$words;
    }
}