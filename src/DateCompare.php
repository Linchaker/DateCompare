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
        $this->firstDate = new \DateTime($firstDate);
        $this->secondDate = new \DateTime($secondDate);

        $this->interval = $this->secondDate->diff($this->firstDate);
    }

    public function getDaysInterval(): int
    {
        return $this->interval->days;
    }

    /**
     * true if firstDate more secondDate/currentDate
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