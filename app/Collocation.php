<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 14.05.17
 * Time: 15:39
 */

namespace app;


class Collocation extends Word
{
    /** @var  int */
    private $length = 0;

    /**
     * @return int
     */
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

    /**
     * @return array
     */
    public function getWords() : array
    {
        return explode(' ', $this->getExpression());
    }

}