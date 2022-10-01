<?php

include __DIR__ . '/src/Health.php';

$health = new Health();
echo 'Load average is ' . $health->getLoadAverage15min() . "\n";
echo 'Disk Free Space is ' . $health->getDiskFreeSpace() . "\n";
echo 'CPU temperature is ' . $health->getCpuTemperature() . "\n";
echo 'Free Memory is ' . $health->getFreeMemory() . "\n";
