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
    private $maxLength;
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
        $this->maxLength = $collocationLength;
    }

    /**
     * @return string
     */
    public function buildQuery(): string
    {
        $result = '';
        $this->printElements = $this->dictionary->findWords($this->getFilteredWords());
        $this->replaceByCollocations();
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
    public function getFilteredWords(): array
    {
        return array_values(array_filter(explode(' ', trim($this->query)), function ($row) {
            return mb_strlen($row, 'utf-8') > 1;
        }));
    }

    private function replaceByCollocations()
    {
        foreach ($this->dictionary->getCollocations() as $collocation) {
            if($collocation->getLength() > $this->maxLength){
                continue;
            }

            if ($position = $this->getPositionInQuery($collocation)) {
                $collocation->setWords(
                    $this->dictionary->findWords($collocation->getExpressionParts())
                );
                $this->replacePosition($collocation, $position - 1);
            }
        }
    }


    /**
     * @param Collocation $collocation
     * @return false|int
     */
    public function getPositionInQuery(Collocation $collocation)
    {
        $position = mb_strpos(
            mb_strtolower($this->query, 'utf-8'),
            mb_strtolower($collocation->getExpression()),
            0, 'utf-8');
        if($position === false){
            return false;
        }

        return count(explode(' ', mb_substr($this->query, 0, $position, 'utf-8')));
    }

    /**
     * @param $collocation
     * @param $position
     */
    private function replacePosition(Collocation $collocation, $position): void
    {
        $this->printElements[$position] = $collocation;
        for ($i = $position + 1; $i < $position + $collocation->getLength(); $i++) {
            unset($this->printElements[$i]);
        }
    }

}