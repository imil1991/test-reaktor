<?php


namespace app;


class Dictionary
{

    /** @var  Collocation[] */
    private $collocations = [];
    /**
     * @var array
     */
    public static $baseWords = [
        ['системный администратор', 'сисадмин', 'systems administrator', 'DevOps engineer'],
        ['баз данных', 'БД', 'database'],
        ['безопасности', 'безпеки', 'security'],
        ['администратор баз данных', 'адміністратор БД', 'администратор БД', 'database administrator', 'dba'],
        ['системный', 'system', 'системний'],
    ];

    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return static::$baseWords;
    }

    /**
     * @return Collocation[]
     */
    public function getCollocations(): array
    {
        return $this->collocations;
    }

    /**
     * @param Collocation[] $collocations
     * @return Dictionary
     */
    public function setCollocations($collocations): Dictionary
    {
        $this->collocations = $collocations;
        return $this;
    }


    /**
     * @return Dictionary
     */
    public function setAllCollocations(): Dictionary
    {
        foreach (static::$baseWords as $rowKey => $row) {
            foreach ($row as $columnKey=>$words) {
                if ($length = mb_substr_count($words, ' ', 'utf-8')) {
                    $result = new Collocation();
                    $result->setExpression($words);
                    $result->setDictionaryRowKey($rowKey);
                    $result->setDictionaryColumnKey($columnKey);
                    $result->setLength($length + 1);
                    $result->setSynonyms($this->getSynonyms($row, $columnKey));
                    $this->collocations[] = $result;
                }
            }
        }

        return $this;
    }

    /**
     * @param array $row
     * @param int $key
     * @return array
     */
    public function getSynonyms(array $row, int $key) : array
    {
        unset($row[$key]);
        foreach ($row as &$one){
            if(substr_count($one, ' ')) {
                $one = '"' . $one . '"';
            }
        }

        return $row;
    }

    /**
     * @param Word $word
     */
    public function findExpression(Word $word)
    {
        foreach ($this->getDictionary() as $keyRow => $row) {
            foreach ($row as $keyColumn => $expression) {
                if ($expression == $word->getExpression()) {
                    $word->setDictionaryRowKey($keyRow);
                    $word->setDictionaryColumnKey($keyColumn);
                    $word->setInDictionary(true);
                    $word->setSynonyms($row);
                }
            }
        }
    }

}