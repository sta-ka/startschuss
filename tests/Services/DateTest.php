<?php

use App\Services\Date\DateService;

class DateTest extends TestCase {

    protected $date;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $this->date = new DateService();
    }

    /**
     * Test format date method.
     *
     * @dataProvider formatDateProvider
     */
    public function testFormatDate($given, $format, $expected)
    {
        $this->assertEquals($expected, $this->date->format($given, $format));
    }

    public function formatDateProvider()
    {
        // given date, format, expected date output
        return [
            # 0
            ['2012-04-3', 'date', '03.04.2012'],
            # 1
            ['2012-04-3', 'day', '3'],
            # 2
            ['2012-04-3', 'ISO', '2012-04-03'],
            # 3
            ['2012-04-3 22:14:12', 'datetime', '03.04.2012 22:14:12'],
            # 4
            ['2012-04-3 22:14:12', 'time', '22:14:12'],
            # 5
            ['2012-04-3 22:14:12', 'year', '2012'],
            # 6
            ['2012-04-3 22:14:12', 'datetime_short', '03.04.2012 - 22:14'],
            # 7
            ['2012-04-3 22:14:12', 'datetime', '03.04.2012 22:14:12']
        ];
    }

    /**
     * Test output date/dates in a human friendly format.
     *
     * @dataProvider outputMonthDateDateProvider
     */
    public function testOutputMonthDate($start_date, $end_date, $long, $expected)
    {
        $this->assertEquals($expected, $this->date->monthDate($start_date, $end_date, $long));
    }

    public function outputMonthDateDateProvider()
    {
        // start date, end date, short/long monthname, expected date output
        return array(
            # 0
            ['3.4.2012', '7.4.2012', true,  '3. - 7. April'],
            # 1
            ['4.3.2012', false, true,  '4. März'],
            # 2
            ['4.3.2012', false, false,  '4. März'],
            # 3
            ['03.07.2013', '03.07.2013', false, '3. Juli'],
            # 4
            ['27.08.2013', '03.09.2013', false, '27. - 3. Sept'],
        );
    }

    /**
     * Test output date in german format.
     *
     * @dataProvider outputGermanDateProvider
     */
    public function testOutputGermanDate($given, $long, $expected)
    {
        $this->assertEquals($expected, $this->date->german($given, $long));
    }

    public function outputGermanDateProvider()
    {
        // given date, short/long monthname, expected date output
        return [
            # 0
            ['3.4.2012', true, '3. April 2012'],
            # 1
            ['04.08.2014', false, '4. Aug 2014'],
            # 2
            ['04.08.2014', true, '4. August 2014'],
            # 3
            ['4.7.2012', false, '4. Juli 2012'],
            # 4
            ['07.11.2013', false, '7. Nov 2013'],
            # 5
            ['07.11.2013', true, '7. November 2013'],
            # 6 invalid date
            ['07-11-2013', true, '-'],
        ];
    }

    /**
     * Test output date with month name.
     *
     * @dataProvider outputMonthYearDateProvider
     */
    public function testOutputMonthYearDate($given, $long, $expected)
    {
        $this->assertEquals($expected, $this->date->monthYearDate($given, $long));
    }

    public function outputMonthYearDateProvider()
    {
        // given date, short/long monthname, expected date output
        return [
            # 0
            ['3.4.2012', true, 'April 2012'],
            # 1
            ['04.08.2014', false, 'Aug 2014'],
            # 2
            ['04.08.2014', true, 'August 2014'],
            # 3
            ['4.7.2012', false, 'Juli 2012'],
            # 4
            ['07.11.2013', false, 'Nov 2013'],
            # 5
            ['07.11.2013', true, 'November 2013'],
            # 6 invalid date
            ['07-11-2013', true, '-'],
        ];
    }

    /**
     * Convert german date to sql formatted date.
     *
     * @dataProvider conversionToSQLDateFormatProvider
     */
    public function testConversionToSQLDateFormat($given, $expected)
    {
        $this->assertEquals($expected, $this->date->germanToSql($given));
    }

    public function conversionToSQLDateFormatProvider()
    {
        // given date, expected date output
        return [
            # 0
            ['3.4.2012', '2012-04-03'],
            # 1
            ['04.8.2014', '2014-08-04'],
            # 2
            ['04.12.2016', '2016-12-04'],
            # 3
            ['4.7.2012', '2012-07-04'],
            # 4 invalid date
            ['11.2013', '-']
        ];
    }

    /**
     * Convert german date to sql formatted date.
     *
     * @dataProvider conversionToGermanDateFormatProvider
     */
    public function testConversionToGermanDateFormat($given, $expected)
    {
        $this->assertEquals($expected, $this->date->sqlToGerman($given));
    }

    public function conversionToGermanDateFormatProvider()
    {
        // given date, expected date output
        return [
            # 0
            ['2012-04-03', '03.04.2012'],
            # 1
            ['2014-08-04', '04.08.2014'],
            # 2
            ['2016-12-04', '04.12.2016'],
            # 3
            ['2012-07-04', '04.07.2012'],
            # 4 invalid date
            ['11-2013', '-']
        ];
    }

}
