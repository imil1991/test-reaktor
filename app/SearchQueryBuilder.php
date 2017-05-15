<?php


namespace app;


use Ds\Sequence;
use Ds\Vector;

class SearchQueryBuilder
{
    /**
     * @var Dictionary
     */
    private $dictionary;
    /**
     * @var string
     */
    private $query;
    /**
     * @var int
     */
    private $collocationLength;
    /** @var  array */
    private $queryWords;

    /**
     * SearchQueryBuilder constructor.
     * @param Dictionary $dictionary
     * @param string $query
     * @param int $collocationLength
     */
    public function __construct(
        Dictionary $dictionary,
        string $query,
        int $collocationLength
    )
    {
        $this->dictionary = $dictionary;
        $this->query = $query;
        $this->collocationLength = $collocationLength;
        $this->setQueryWords();
    }

    /**
     * @return string
     */
    public function buildQuery(): string
    {
        $result = '';
        $collections = $this->findCollocations();
        $this->findWords();
        $collectionsPositions = [];
        foreach ($collections as $collocation) {
            $result .= '(';
            $collocationWords = $collocation->getWords();
            foreach ($collocationWords as $one) {
                $word = $this->dictionary->findWord($one);
                $result .= $word ? $this->printSynonyms($word) : $one;
                if ($one != end($collocationWords)) {
                    $result .= ' & ';
                }
            }
            $result .= ')|';

            $collectionsPositions += range($collocation->getPosition(), $collocation->getLength() - 1);
            $result .= $this->printSynonyms($collocation);
        }

        foreach ($this->queryWords as $position => $one) {
            if (!in_array($position, $collectionsPositions)) {
                $result .= ' & ';
                $word = $this->dictionary->findWord($one);
                $result .= $word ? $this->printSynonyms($word) : $one;
            }
        }

        return $result;
    }

    /**
     * @param Word $word
     * @return string
     */
    public function printSynonyms(Word $word): string
    {
        return implode('|', $this->dictionary->getSynonyms($word));
    }

    /**
     * @return array
     */
    public function getQueryWords(): array
    {
        return $this->queryWords;
    }

    /**
     * @return SearchQueryBuilder
     */
    public function setQueryWords(): SearchQueryBuilder
    {
        $this->queryWords = array_filter(explode(' ', trim($this->query)), function ($row) {
            return mb_strlen($row, 'utf-8') > 1;
        });

        return $this;
    }

    /**
     * @return Sequence|Vector|Collocation[]
     */
    public function findCollocations(): Sequence
    {
        $this->dictionary->setAllCollocations();
        $collocations = $this->dictionary->getCollocations();
        foreach ($collocations as $collocation) {
            $position = mb_strpos($this->query, $collocation->getExpression(), 0, 'utf-8');
            if ($collocation->getLength() <= $this->collocationLength && $position !== false) {
                $collocation->setPosition($position);
                $collocation->setInQuery(true);
            }
        }

        return $this->dictionary->getCollocations()->filter(function ($collocation) {
            /** @var Collocation $collocation */
            return $collocation->isInQuery();
        });
    }

    public function findWords()
    {
        foreach ($this->dictionary->getDictionary() as $keyRow => $row) {
            foreach ($row as $keyColumn => $expression) {
                if (($position = array_search($expression, $this->queryWords)) !== false) {
                    $word = new Word();
                    $word->setExpression($expression);
                    $word->setDictionaryRowKey($keyRow);
                    $word->setDictionaryColumnKey($keyColumn);
                    $word->setInQuery(true);
                    $word->setPosition($position);
                    $this->dictionary->getWords()->push($word);
                }
            }
        }
    }
}