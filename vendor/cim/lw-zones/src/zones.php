<?php

declare (strict_types = 1);

namespace LW;

final class zones {

    const URL = "https://rhapsodyofrealities.b-cdn.net/cedata/zones.json?v=";
    private $zones;

    public function __construct() {
        $url = self::URL . microtime(true);
        $json = file_get_contents($url);
        $this->zones = json_decode($json, true);
    }

    /**
     * returns an array of all the zonal names
     * @return An array of zonal names.
     */
    public function getZonalNames(): array{
        $zonalNames = [];
        foreach ($this->zones as $zone) {
            array_push($zonalNames, $zone['zonal_name']);
        }
        return $zonalNames;
    }

    /**
     * count all zones
     */
    public function countZones(): int {
        return count($this->zones);
    }

    /**
     * return all the data
     */
    public function getZones(): array{
        return $this->zones;
    }

    /**
     * Search through the zones array for a zone with a matching zone_id
     * @param zone_id The ID of the zone you want to search for.
     * @return The zone object that matches the zone_id
     */
    public function findZone($zone_id) {
        foreach ($this->zones as $zone) {
            if ($zone['zone_id'] === $zone_id) {
                return $zone;
            }
        }
        return null;
    }

}

?>