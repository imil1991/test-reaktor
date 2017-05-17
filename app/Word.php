<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 15.05.17
 * Time: 22:55
 */

namespace app;


class Word extends Expression
{
    /**
     * @return string
     */
    public function print(): string
    {
        return !empty($this->getSynonyms()) ? implode('|', $this->getSynonyms()) : $this->getExpression();
    }

}