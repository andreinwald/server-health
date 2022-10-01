<?php
include __DIR__ . '/../src/Health.php';

$webhookUrl = $argv[1];

$health = new Health();
$text = [
    'Host' => gethostname(),
    'Load average' => round($health->getLoadAverage15min()),
    'CPU temperature' => $health->getCpuTemperature(),
    'Free Memory' => $health->getMemoryFree() . "Mb",
    'Free Memory share' => $health->getMemoryFreeShare() . "%",
    'Disk Free Space' => round($health->getDiskFreeSpace()/1024) . "Gb",
    'Disk Free Space share' => $health->getDiskFreeSpaceShare() . "%",
];

$resultText = '';
foreach ($text as $key => $value) {
    $resultText .= $key . ': ' . $value . "\n";
}

$ch = curl_init($webhookUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $resultText);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/html']);
curl_exec($ch);
