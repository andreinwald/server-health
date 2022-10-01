# Server Health
## Reading server status like CPU, Free RAM memory and Disk space on PHP

No exec() execution needed. Only reading files like /proc/meminfo

## Installing
install by composer<br>
or just downloading from this repo

## Usage
```php
include __DIR__ . '/src/Health.php'; // or autoload

$health = new Health();
echo 'Load average: ' . round($health->getLoadAverage15min()) . "\n";
echo 'CPU temperature: ' . $health->getCpuTemperature() . "\n";
echo 'Free Memory: ' . $health->getMemoryFree() . "Mb\n";
echo 'Free Memory: ' . $health->getMemoryFreeShare() . "%\n";
echo 'Disk Free Space: ' . round($health->getDiskFreeSpace()/1024) . "Gb\n";
echo 'Disk Free Space share: ' . $health->getDiskFreeSpaceShare() . "%\n";
```
will display
```shell
Load average: 4
CPU temperature: 51
Free Memory: 5973Mb
Free Memory share: 19%
Disk Free Space: 1848Gb
Disk Free Space share: 93%
```

## Sending webhook with results
Execution of this code will make POST request with text in body
```shell
php bin/send_webhook.php https://your-webhook-site.com
```
