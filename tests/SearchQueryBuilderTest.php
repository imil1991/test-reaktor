<?php


namespace tests;

use app\SearchQueryBuilder;
use PHPUnit\Framework\TestCase;

class SearchQueryBuilderTest extends TestCase
{
    const TEST_QUERY = 'системный администратор в офис';
    const TEST_RESULT = '(системный|системний|system & администратор|админ.)|сисадмин|"systems administrator" & офис';

    public function test_buildQuery_withTestQueryAnd2CollocationLength_returnTestResult()
    {
        $queryBuilder = new SearchQueryBuilder(new DictionaryFixture());
        $queryBuilder->buildQuery(self::TEST_QUERY, 2);
        $this->assertEquals(self::TEST_RESULT, $queryBuilder->getResult());
    }
}