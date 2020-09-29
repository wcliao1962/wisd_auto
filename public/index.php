<?php
require '../vendor/autoload.php';

use \Demo\HelloWorld as World;
use Demo\Hello\Lara;
use Demo\Hello;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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