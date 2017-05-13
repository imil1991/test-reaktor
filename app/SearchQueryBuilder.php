<?php


namespace app;


class SearchQueryBuilder
{
    /**
     * @var DictionaryInterface
     */
    private $dictionary;

    /**
     * SearchQueryBuilder constructor.
     * @param DictionaryInterface $dictionary
     */
    public function __construct(DictionaryInterface $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @param string $customQuery
     * @param int $collocationLength
     * @return string
     */
    public function buildQuery(string $customQuery, int $collocationLength) : string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getResult() : string
    {
        return '';
    }
}