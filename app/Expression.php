<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 17.05.17
 * Time: 21:32
 */

namespace app;


abstract class Expression
{
    /** @var  string */
    private $expression = '';
    /** @var  int */
    private $dictionaryRowKey = 0;
    /** @var int */
    private $dictionaryColumnKey = 0;
    /** @var  array */
    private $synonyms = [];


    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     * @return Expression
     */
    public function setExpression(string $expression): Expression
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return int
     */
    public function getDictionaryRowKey(): int
    {
        return $this->dictionaryRowKey;
    }

    /**
     * @param int $dictionaryRowKey
     * @return Expression
     */
    public function setDictionaryRowKey(int $dictionaryRowKey): Expression
    {
        $this->dictionaryRowKey = $dictionaryRowKey;
        return $this;
    }

    /**
     * @return int
     */
    public function getDictionaryColumnKey(): int
    {
        return $this->dictionaryColumnKey;
    }

    /**
     * @param int $dictionaryColumnKey
     * @return Expression
     */
    public function setDictionaryColumnKey(int $dictionaryColumnKey): Expression
    {
        $this->dictionaryColumnKey = $dictionaryColumnKey;
        return $this;
    }

    /**
     * @return array
     */
    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    /**
     * @param array $synonyms
     * @return Expression
     */
    public function setSynonyms(array $synonyms): Expression
    {
        $this->synonyms = $synonyms;
        return $this;
    }

    /** @return string */
    abstract public function print();
}