<?php

include __DIR__ . '/../src/Health.php';

$health = new Health();
echo 'Load average is ' . round($health->getLoadAverage15min()) . "\n";
echo 'Disk Free Space is ' . $health->getDiskFreeSpace()/1024 . "Gb\n";
echo 'Disk Free Space share ' . $health->getDiskFreeSpaceShare() . "%\n";
echo 'CPU temperature is ' . $health->getCpuTemperature() . "\n";
echo 'Free Memory is ' . $health->getMemoryFree() . "Mb\n";
echo 'Free Memory is ' . $health->getMemoryFreeShare() . "%\n";
