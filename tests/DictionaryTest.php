<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 14.05.17
 * Time: 13:02
 */

namespace tests;


use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{
    public function test_setAllCollocations_withFixture_returnCollocationsArray()
    {
        $dictionary = new DictionaryFixture();
        $dictionary->setAllCollocations();
        $result = $dictionary->getCollocations();
        $this->assertNotEmpty($result);
        $this->assertCount(2, $result);
    }

}