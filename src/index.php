<?php

@error_reporting ( E_ERROR );
@ini_set ( 'display_errors', true );

require_once '../vendor/autoload.php';

use Linchaker\DateCompare;

$firstDate = $argv[1] ?? 'now';
$secondDate = $argv[2] ?? 'now';

$dateCompare = new DateCompare($firstDate, $secondDate);
$daysInterval = $dateCompare->getDaysInterval();
$secondsInterval = $dateCompare->getSecondsInterval();
$intervalStatus = $dateCompare->getIntervalStatus();
$daysPeriod = $dateCompare->getDaysPeriod();

echo "daysInterval: " . $daysInterval . PHP_EOL;
echo "secondsInterval: " . $secondsInterval . PHP_EOL;
echo "intervalStatus: " . (int)$intervalStatus . ' | ' .($intervalStatus ? 'first date has COME' : 'first date has NOT come yet') . PHP_EOL;
echo "daysPeriod: " . PHP_EOL;
foreach ($daysPeriod as $day) {
    echo $day->format("Y-m-d") . PHP_EOL;
}

