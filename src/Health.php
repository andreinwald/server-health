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

    public function getFreeMemory()
    {
        $memInfo = file_get_contents('/proc/meminfo');
        $memInfo = explode("\n", $memInfo);
        $data = [];
        foreach ($memInfo as $item) {
            list($name, $value) = explode(':', $item);
            $data[$name] = $value;
        }
        return $data;
    }
}