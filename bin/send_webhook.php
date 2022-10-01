<?php
include __DIR__ . '/../src/Health.php';

$webhookUrl = $argv[1];

$health = new Health();
$text = [
    'Host' => gethostname(),
    'Load average' => $health->getLoadAverage15min(),
    'Disk Free Space' => $health->getDiskFreeSpace(),
    'CPU temperature' => $health->getCpuTemperature(),
    'Free Memory' => $health->getMemoryFree(),
];

$resultText = '';
foreach ($text as $key => $value) {
    $resultText .= $key . ': ' . $value . "\n";
}

$ch = curl_init($webhookUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $resultText);
curl_exec($ch);


