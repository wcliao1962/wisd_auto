<?php
require '../vendor/autoload.php';

use \Demo\HelloWorld as World;
use Demo\Hello\Lara;
use Demo\Hello;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Carbon\Carbon;

$world = new World();
$lara= new Lara();
$vincent= new Hello\Someone('Vincent');

$mary = new \Demo\Hello\Someone('Mary');
$john = new Demo\Hello\Someone('John');


// create a log channel
$log = new Logger('lara');
$log->pushHandler(new StreamHandler('../log/my.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

echo "<br><hr>";
printf("Right now is %s<br>", Carbon::now()->toDateTimeString());
printf("Right now in Taipei is %s<br>", Carbon::now('Asia/Taipei'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);
echo "明天: ".$tomorrow."<br>";
echo "上一週: ".$lastWeek."<br>";
echo "奧運: ".$nextSummerOlympics."<br>";

$officialDate = Carbon::now()->toRfc2822String();
echo $officialDate."<br>";

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;
echo $howOldAmI."<br>";

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');
echo $noonTodayLondonTime."<br>";

$internetWillBlowUpOn = Carbon::create(2038, 01, 19, 3, 14, 7, 'GMT');
echo $internetWillBlowUpOn."<br>";

// Don't really want this to happen so mock now
Carbon::setTestNow(Carbon::createFromDate(2000, 1, 1));

// comparisons are always done in UTC
if (Carbon::now()->gte($internetWillBlowUpOn)) {
    die();
}

// Phew! Return to normal behaviour
Carbon::setTestNow();

if (Carbon::now()->isWeekend()) {
    echo 'Party!<br>';
}
// Over 200 languages (and over 500 regional variants) supported:
echo Carbon::now()->subMinutes(2)->diffForHumans()."<br>"; // '2 minutes ago'
echo Carbon::now()->subMinutes(2)->locale('zh_TW')->diffForHumans()."<br>"; // '2分钟前'
echo Carbon::parse('2019-07-23 14:51')->isoFormat('LLLL')."<br>"; // 'Tuesday, July 23, 2019 2:51 PM'
echo Carbon::parse('2019-07-23 14:51')->locale('fr_FR')->isoFormat('LLLL')."<br>"; // 'mardi 23 juillet 2019 14:51'

// ... but also does 'from now', 'after' and 'before'
// rolling up to seconds, minutes, hours, days, months, years

$daysSinceEpoch = Carbon::createFromTimestamp(0)->diffInDays();
echo $daysSinceEpoch."<br>";