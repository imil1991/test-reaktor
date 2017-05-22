<?php


namespace tests;

use app\Dictionary;
use app\SearchQueryBuilder;
use PHPUnit\Framework\TestCase;

class SearchQueryBuilderTest extends TestCase
{
    const TEST_QUERY = 'системный администратор в офис';
    const TEST_RESULT = '(системный|системний|system & администратор|админ.)|сисадмин|"systems administrator" & офис';
    /** @var  SearchQueryBuilder */
    private $searchQueryBuilder;

    public function setUp()
    {
        parent::setUp();
        $this->searchQueryBuilder = new SearchQueryBuilder(
            new DictionaryFixture(),
            self::TEST_QUERY,
            2
        );
    }

    public function test_buildQuery_withTestQuery_returnTestResult()
    {
        $this->assertEquals(self::TEST_RESULT, $this->searchQueryBuilder->buildQuery());
    }

    public function test_getWords_withTestQuery_returnArrayWordWithoutEq1Length()
    {
        $this->assertCount(3, $this->searchQueryBuilder->getFilteredWords());
    }


    public function test_acceptance_1()
    {
        $this->assertEquals(
            '(системный|system|системний & администратор)|сисадмин|"systems administrator"|"DevOps engineer" & (администратор & баз данных|БД|database)|"администратор баз данных"|"адміністратор БД"|"database administrator"|dba & безопасности|безпеки|security',
            (new SearchQueryBuilder(new Dictionary(), 'Системный администратор БД и безопасности',2))->buildQuery());
    }

    public function test_acceptance_2()
    {
        $this->assertEquals(
            '(системный|system|системний & администратор)|сисадмин|"systems administrator"|"DevOps engineer" & (баз & данных)|БД|database & безопасности|безпеки|security',
            (new SearchQueryBuilder(new Dictionary(), 'Системный администратор баз данных и безопасности',2))->buildQuery());
    }

    public function test_acceptance_3()
    {
        $this->assertEquals(
            '(системный|system|системний & администратор)|сисадмин|"systems administrator"|"DevOps engineer" & офис',
            (new SearchQueryBuilder(new Dictionary(), 'Системный администратор в офис',2))->buildQuery());
    }
}