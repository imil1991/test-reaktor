<?php


namespace app;


class SearchQueryBuilder
{
    private $dictionary;

    public function __construct(DictionaryInterface $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function buildQuery(string $customQuery, int $collocationLength) : string
    {
        return '';
    }

    public function getResult() : string
    {
        return '';
    }
}