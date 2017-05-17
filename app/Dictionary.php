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

    public function __construct()
    {
        $this->initCollocations();
    }

    /**
     * @return Collocation[]
     */
    public function getCollocations(): array
    {
        return $this->collocations;
    }

    /**
     * @return Dictionary
     */
    public function initCollocations(): Dictionary
    {
        foreach (static::$baseWords as $rowKey => $row) {
            foreach ($row as $columnKey => $words) {
                if ($length = mb_substr_count($words, ' ', 'utf-8')) {
                    $result = new Collocation();
                    $result->setExpression($words);
                    $result->setDictionaryRowKey($rowKey);
                    $result->setDictionaryColumnKey($columnKey);
                    $result->setLength($length + 1);
                    $result->setSynonyms($this->getCollocationSynonyms($row, $columnKey));
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
    public static function getCollocationSynonyms(array $row, int $key): array
    {
        unset($row[$key]);
        foreach ($row as &$one) {
            if (substr_count($one, ' ')) {
                $one = '"' . $one . '"';
            }
        }

        return $row;
    }

    /**
     * @param array $words
     * @return Word[]
     */
    public static function findWords(array $words)
    {
        $result = [];
        foreach ($words as $value) {
            $word = new Word();
            $word->setExpression($value);
            foreach (static::$baseWords as $keyRow => $row) {
                foreach ($row as $keyColumn => $expression) {
                    if ($expression == $word->getExpression()) {
                        $word->setDictionaryRowKey($keyRow);
                        $word->setDictionaryColumnKey($keyColumn);
                        $word->setSynonyms($row);
                    }
                }
            }
            $result[] = $word;
        }

        return $result;
    }

}