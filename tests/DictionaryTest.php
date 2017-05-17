<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 14.05.17
 * Time: 13:02
 */

namespace tests;

use app\Word;
use PHPUnit\Framework\TestCase;

class DictionaryTest extends TestCase
{
    public function test_getCollocations_withFixture_returnCollocationsArray()
    {
        $dictionary = new DictionaryFixture();
        $this->assertCount(2, $dictionary->getCollocations());
    }

    public function test_findWords_withWord_returnArrayWord()
    {
        $word = DictionaryFixture::findWords([uniqid()]);
        $this->assertInstanceOf(Word::class, reset($word));
    }

    public function test_findWords_withExistWord_returnArrayWordWithSynonyms()
    {
        $word = DictionaryFixture::findWords(['системный']);
        $this->assertNotEmpty(reset($word)->getSynonyms());
    }

}