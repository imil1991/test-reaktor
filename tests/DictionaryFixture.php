<?php


namespace tests;

use app\DictionaryInterface;

class DictionaryFixture implements DictionaryInterface
{

    public static $baseWords = [
        ['системный', 'системный', 'system'],
        ['администратор', 'админ.'],
        ['системный администратор', 'сисадмин', 'systems administrator']
    ];

    /**
     * @inheritdoc
     */
    public function getDictionary(): array
    {
        return static::$baseWords;
    }
}