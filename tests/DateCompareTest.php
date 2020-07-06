<?php
namespace tests\dateCompareTest;

use \PHPUnit\Framework\TestCase;
use Linchaker\DateCompare;

class DateCompareTest extends TestCase
{
    public function testGetDaysInterval()
    {
        $check = new DateCompare('2020-07-10', '2020-07-05');

        $this->assertSame(5, $check->getDaysInterval(), 'getDaysInterval');
    }

    public function testGetIntervalStatus()
    {
        $check = new DateCompare('2020-07-10', '2020-07-05');

        $this->assertTrue($check->getIntervalStatus(), 'getIntervalStatus');
    }

    public function testGetDaysPeriod()
    {
        $check = new DateCompare('2020-07-10', '2020-07-15');
        $this->assertCount(6, $check->getDaysPeriod(), 'getDaysPeriod');
    }

    public function testGetDaysPeriodReverse()
    {
        $check = new DateCompare('2020-07-05', '2020-07-10');
        $this->assertCount(6, $check->getDaysPeriod(), 'getDaysPeriodReverse');
    }
}
