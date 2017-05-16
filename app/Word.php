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
    private $inDictionary = false;
    /** @var int */
    private $position = 0;
    /** @var  string */
    private $expression = '';
    /** @var  int */
    private $dictionaryRowKey = 0;
    /** @var int  */
    private $dictionaryColumnKey = 0;
    /** @var  array */
    private $synonyms = [];

    /**
     * @return bool
     */
    public function isInDictionary(): bool
    {
        return $this->inDictionary;
    }

    /**
     * @param bool $inDictionary
     * @return Word
     */
    public function setInDictionary(bool $inDictionary): Word
    {
        $this->inDictionary = $inDictionary;
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

    /**
     * @return array
     */
    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    /**
     * @param array $synonyms
     * @return Word
     */
    public function setSynonyms(array $synonyms): Word
    {
        $this->synonyms = $synonyms;
        return $this;
    }

    /**
     * @return string
     */
    public function print(): string
    {
        return $this->inDictionary ? implode('|', $this->getSynonyms()) : $this->getExpression();
    }

}