<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 15.05.17
 * Time: 22:55
 */

namespace app;


class Word
{
    /** @var bool */
    private $inQuery = false;
    /** @var int */
    private $position = 0;
    /** @var  string */
    private $expression = '';
    /** @var  int */
    private $dictionaryRowKey = 0;
    /** @var int  */
    private $dictionaryColumnKey = 0;

    /**
     * @return bool
     */
    public function isInQuery(): bool
    {
        return $this->inQuery;
    }

    /**
     * @param bool $inQuery
     * @return Word
     */
    public function setInQuery(bool $inQuery): Word
    {
        $this->inQuery = $inQuery;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Word
     */
    public function setPosition(int $position): Word
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     * @return Word
     */
    public function setExpression(string $expression): Word
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
     * @return Word
     */
    public function setDictionaryRowKey(int $dictionaryRowKey): Word
    {
        $this->dictionaryRowKey = $dictionaryRowKey;
        return $this;
    }


    /**
     * @return array
     */
    public function getWords() : array
    {
        return explode(' ', $this->getExpression());
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
     * @return Word
     */
    public function setDictionaryColumnKey(int $dictionaryColumnKey): Word
    {
        $this->dictionaryColumnKey = $dictionaryColumnKey;
        return $this;
    }

}