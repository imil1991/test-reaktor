<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 14.05.17
 * Time: 15:39
 */

namespace app;


class Collocation extends Expression
{
    /** @var  int */
    private $length = 0;
    /** @var array */
    private $words = [];

    /** @return int */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Collocation
     */
    public function setLength(int $length): Collocation
    {
        $this->length = $length;
        return $this;
    }

    /** @return Word[] */
    public function getWords() : array
    {
        return $this->words;
    }

    /** @return array */
    public function getExpressionParts() : array
    {
        return explode(' ', $this->getExpression());
    }

    /**
     * @param array $words
     * @return Collocation
     */
    public function setWords(array $words) : Collocation
    {
        $this->words = $words;
        return $this;
    }

    /** @return string */
    public function print(): string
    {
        $result = '(';
        foreach ($this->getWords() as $key => $word) {
            $result .= $word->print();
            if($this->getLength() != $key+1) {
                $result .= ' & ';
            }
        }

        $result .= ')|';
        $result .= implode('|', $this->getSynonyms());

        return $result;
    }

}