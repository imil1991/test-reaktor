<?php


namespace tests;

use app\Dictionary;

class DictionaryFixture extends Dictionary
{

    /**
     * @var array
     */
    public static $baseWords = [
        ['системный', 'системний', 'system'],
        ['администратор', 'админ.'],
        ['системный администратор', 'сисадмин', 'systems administrator']
    ];


}