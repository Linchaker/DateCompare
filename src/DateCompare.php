<?php
namespace Linchaker;

class DateCompare
{
    private $firstDate;
    private $secondDate;
    /**
     * @var bool|\DateInterval
     */
    private $interval;


    public function __construct(string $firstDate, string $secondDate = 'now')
    {
        try {
            $this->firstDate = new \DateTime($firstDate);
        } catch (\Exception $e) {
            echo 'Error parsing first date' . PHP_EOL;

        }

        try {
            $this->secondDate = new \DateTime($secondDate);
        } catch (\Exception $e) {
            echo 'Error parsing second date' . PHP_EOL;
        }

        $this->interval = $this->secondDate->diff($this->firstDate);
    }

    /**
     * get days interval between dates
     * @return int
     */
    public function getDaysInterval(): int
    {
        return $this->interval->days;
    }

    /**
     * get seconds interval between dates
     * @return int
     */
    public function getSecondsInterval(): int
    {
        $seconds = 0;
        $seconds += $this->interval->days * 24 * 60 * 60;
        $seconds += $this->interval->h * 60 * 60;
        $seconds += $this->interval->i * 60;
        $seconds += $this->interval->s;

        return $seconds;
    }

    /**
     * check if the firstDate has already come relative secondDate
     * true if firstDate more secondDate/currentDate or equal
     * @return bool
     */
    public function getIntervalStatus(): bool
    {
        return $this->interval->invert ? false : true;
    }

    /**
     * period in days between dates
     * @return \DatePeriod
     * @throws \Exception
     */
    public function getDaysPeriod(): \DatePeriod
    {
        $step = new \DateInterval('P1D');
        if ($this->getIntervalStatus()) {
            $end = clone $this->firstDate;
            $end = $end->modify( '+1 day' );
            return new \DatePeriod($this->secondDate, $step, $end);
        } else {
            $end = clone $this->secondDate;
            $end = $end->modify( '+1 day' );
            return new \DatePeriod($this->firstDate, $step, $end);
        }
    }
}