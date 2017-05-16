<?php


namespace tests;

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
        $this->assertCount(3, $this->searchQueryBuilder->getQueryWords());
    }


}