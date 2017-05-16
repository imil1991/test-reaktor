<?php


namespace app;


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
    /** @var  Word[] */
    private $printElements = [];

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
    }

    /**
     * @return string
     */
    public function buildQuery(): string
    {
        $result = '';
        $this->findWords();
        $this->findCollocations();
        ksort($this->printElements);
        foreach ($this->printElements as $element) {
            $result .= $element->print();
            if (end($this->printElements) !== $element) {
                $result .= ' & ';
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getQueryWords(): array
    {
        return array_values(array_filter(explode(' ', trim($this->query)), function ($row) {
            return mb_strlen($row, 'utf-8') > 1;
        }));
    }

    public function findCollocations()
    {
        $this->dictionary->setAllCollocations();
        $collocations = $this->dictionary->getCollocations();
        foreach ($collocations as $collocation) {
            $position = mb_strpos(
                mb_strtolower($this->query, 'utf-8'),
                mb_strtolower($collocation->getExpression()),
                0, 'utf-8');
            if ($collocation->getLength() <= $this->collocationLength && $position !== false) {
                $partString = mb_substr($this->query, 0, $position, 'utf-8');
                $printPosition = count(explode(' ', $partString)) - 1;
                $collocation->setPosition($printPosition);
                $collocation->setInDictionary(true);
                $this->printElements[$printPosition] = $collocation;
                foreach ($collocation->getExpressionParts() as $value) {
                    $word = new Word();
                    $word->setExpression($value);
                    $this->dictionary->findExpression($word);
                    $collocation->addWord($word);
                }
                for ($i = $printPosition + 1; $i < $printPosition + $collocation->getLength(); $i++) {
                    unset($this->printElements[$i]);
                }
            }
        }
    }

    public function findWords()
    {
        foreach ($this->getQueryWords() as $position => $value) {
            $word = new Word();
            $word->setExpression($value);
            $word->setPosition($position);
            $this->dictionary->findExpression($word);
            $this->printElements[$position] = $word;
        }
    }

}