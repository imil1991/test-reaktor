<?php


namespace app;


use Ds\Vector;

class Dictionary
{

    /** @var  Vector|Word[] */
    private $words;

    /** @var  Vector|Collocation[] */
    private $collocations;
    /**
     * @var array
     */
    public static $baseWords = [

    ];

    /**
     * Dictionary constructor.
     */
    public function __construct()
    {
        $this->words = new Vector();
        $this->collocations = new Vector();
    }


    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return static::$baseWords;
    }

    /**
     * @return Collocation[]|Vector
     */
    public function getCollocations(): Vector
    {
        return $this->collocations;
    }

    /**
     * @param Collocation[]|Vector $collocations
     * @return Dictionary
     */
    public function setCollocations($collocations): Dictionary
    {
        $this->collocations = $collocations;
        return $this;
    }

    /**
     * @return Word[]|Vector
     */
    public function getWords(): Vector
    {
        return $this->words;
    }

    /**
     * @param Word[]|Vector $words
     * @return Dictionary
     */
    public function setWords($words): Dictionary
    {
        $this->words = $words;
        return $this;
    }


    /**
     * @param Collocation $collocation
     * @return Dictionary
     */
    public function removeCollection(Collocation $collocation): Dictionary
    {
        if (!$this->collocations->contains($collocation)) {
            throw new \LogicException('Dictionary not constraint collocation: ' . $collocation->getExpression());
        }

        $this->collocations->remove($this->collocations->find($collocation));

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
                    $this->collocations->push($result);
                }
            }
        }

        return $this;
    }

    /**
     * @param Word $word
     * @return mixed
     */
    public function getSynonyms(Word $word)
    {
        $result = $this->getDictionary()[$word->getDictionaryRowKey()];
        if($word instanceof Collocation) {
            unset($result[$word->getDictionaryColumnKey()]);
            foreach ($result as &$one){
                if(substr_count($one, ' ')) {
                    $one = '"' . $one . '"';
                }
            }
        }

        return $result;
    }

    /**
     * @param $expression
     * @return Word|null
     */
    public function findWord($expression)
    {
        foreach ($this->words as $word){
            if($expression == $word->getExpression()){
                return $word;
            }
        }

        return null;
    }


}