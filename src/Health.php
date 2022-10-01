<?php

class Health
{
    public function getLoadAverage()
    {
        return sys_getloadavg();
    }

    public function getLoadAverage15min()
    {
        return $this->getLoadAverage()[2];
    }

    public function getDiskFreeSpace()
    {
        return disk_free_space("/") / 1024 / 1024;
    }

    public function getDiskFreeSpaceShare()
    {
        return disk_free_space("/") / disk_total_space("/");
    }

    public function getCpuTemperature()
    {
        // sensors command

        if (!file_exists('/sys/class/thermal/thermal_zone0/temp')) {
            return false;
        }
        $cpuTempCRaw = file_get_contents('/sys/class/thermal/thermal_zone0/temp');
        if (!$cpuTempCRaw || $cpuTempCRaw == "") {
            return false;
        }
        if ($cpuTempCRaw > 1000) {
            return round($cpuTempCRaw / 1000);
        } else {
            return round($cpuTempCRaw);
        }
    }

    public function getMemoryInfo()
    {
        if (!file_exists('/proc/meminfo')) {
            return false;
        }
        $memInfo = file_get_contents('/proc/meminfo');
        if (!$memInfo) {
            return false;
        }
        $memInfo = explode("\n", $memInfo);
        $data = [];
        foreach ($memInfo as $item) {
            $res = explode(':', $item);
            if (!isset($res[1])) {
                continue;
            }
            $data[$res[0]] = intval($res[1]);
        }
        return $data;
    }

    public function getMemoryFree()
    {
        return $this->getMemoryInfo()['MemAvailable'];
    }
}