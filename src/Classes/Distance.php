<?php

namespace mmerlijn\laravelHelpers\Classes;

use mmerlijn\laravelHelpers\Exceptions\DistanceException;

class Distance
{
    private float $from_latitude = 0;
    private float $from_longitude = 0;
    private float $to_latitude = 0;
    private float $to_longitude = 0;

    public function __constructor()
    {
    }

    public function from(float|string|array $param1, float|string|null $param2 = null): self
    {
        $this->handleInput($param1, $param2, "from");
        return $this;
    }

    public function to(float|string|array $param1, float|string|null $param2 = null): self
    {
        $this->handleInput($param1, $param2, "to");
        return $this;
    }

    public function get(string $unit = "km", bool $format = false, int $precision = 1): float|string
    {
        $units = ['m' => 1, "km" => 1000];
        if (!in_array($unit, ['m', 'km']))
            throw new DistanceException("Provided unit: $unit unknown");
        if ($this->from_latitude and $this->from_longitude and $this->to_latitude and $this->to_longitude) {
            if ($format) {
                return number_format($this->distance() / $units[$unit], $precision, ",", ".") . $unit;
            } else {
                return round($this->distance() / $units[$unit], $precision);
            }

        }
        throw new DistanceException('Not all coordinates are set');
    }


    public function setFrom(float $lat, float $long): self
    {
        $this->from_latitude = $lat;
        $this->from_longitude = $long;
        return $this;
    }

    public function setTo(float $lat, float $long): self
    {
        $this->to_latitude = $lat;
        $this->to_longitude = $long;
        return $this;
    }

    private function handleInput($lat, $long, $type): void
    {
        if (gettype($lat) == "string") {
            if (is_numeric($lat)) {
                if (!is_numeric($long)) {
                    throw new DistanceException('From/To longitude: ' . $long . " is not valid");
                }
            } else {//city
                $coor = $this->cityCoordinates($lat);
                if (!$coor[0]) {
                    throw new DistanceException('City: ' . $lat . " not exists in predefined cities");
                }
                $lat = $coor[0];
                $long = $coor[1];
            }
        } elseif (gettype($lat) == "double") {
            if (!is_numeric($long)) {
                throw new DistanceException('From/To longitude: ' . $long . " is not valid");
            }
        } elseif (gettype($lat) == "array") {
            if (!$lat['lat'] or !$lat['long']) {
                throw new DistanceException('From/To input array doesnt contain keys lat and long');
            }
            $long = $lat['long'];
            $lat = $lat['lat'];
        }
        if ($type == "to") {
            $this->setTo((float)$lat, (float)$long);
        } else {
            $this->setFrom((float)$lat, (float)$long);
        }
    }

    private function distance(): float
    {
        return $this->vincentyGreatCircleDistance($this->from_latitude, $this->from_longitude, $this->to_latitude, $this->to_longitude);
    }

    private function vincentyGreatCircleDistance(
        float $latitudeFrom, float $longitudeFrom, float $latitudeTo, float $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    public function cityCoordinates($city): array
    {
        switch (strtolower($city)) {
            case "purmerend":
                return [52.5144, 4.9641];
            case "monnickendam":
                return [52.4555687, 5.0392316];
                break;
            case "marken":
                return [52.4589926, 5.1032057];
                break;
            case "edam":
                return [52.5126367, 5.0491819];
                break;
            case "graft":
                return [52.5622696, 4.832044];
                break;
            case "hobrede":
                return [52.5780353, 4.9986224];
                break;
            case "katwoude":
                return [52.4694862, 5.0471278];
                break;
            case "kwadijk":
                return [52.527382, 4.9837605];
                break;
            case "noordbeemster":
                return [52.5797174, 4.9322059];
                break;
            case "westbeemster":
                return [52.5752469, 4.8995178];
                break;
            case "middenbeemster":
                return [52.548942, 4.9154702];
                break;
            case "oosthuizen":
                return [52.5739553, 4.9975843];
                break;
            case "purmer":
                return [52.4844342, 4.961566];
                break;
            case "purmerland":
                return [52.483289, 4.909167];
                break;
            case "volendam":
                return [52.4968694, 5.0727015];
                break;
            case "wijdewormer":
                return [52.4873869, 4.8597355];
                break;
            case "zuidoostbeemster":
                return [52.5151991, 4.9421222];
                break;
            case "hoorn":
                return [52.6423654, 5.0602124];
                break;
            case "zwaag":
                return [52.6671969, 5.073672];
                break;
            case "amstelveen":
                return [52.3031178, 4.8611997];
                break;
            case "broek in waterland":
                return [52.4357808, 4.9913157];
                break;
            case "amsterdam":
                return [52.3702157, 4.8951679];
                break;
            case "diemen":
                return [52.3389926, 4.9591888];
                break;
            case "ilpendam":
                return [52.46591995, 4.96990604343952];
                break;
            case "landsmeer":
                return [52.4403382, 4.9209233];
                break;
            case "watergang":
                return [52.4398855, 4.9521153];
                break;
            case "halfweg":
                return [52.3819918, 4.7538293];
                break;
            case "castricum":
                return [52.5452585, 4.6727354];
                break;
            case "uitgeest":
                return [52.5312254, 4.7120459];
                break;
            case "akersloot":
                return [52.5609159, 4.7338008];
                break;
            case "beverwijk":
                return [52.4869842, 4.6574468];
                break;
            case "heemskerk":
                return [52.514146, 4.6821367];
                break;
            case "alkmaar":
                return [52.6323813, 4.7533754];
                break;
            case "egmond aan den hoef":
                return [52.6209748, 4.6531215];
                break;
            case "egmond aan zee":
                return [52.6186114, 4.6302431];
                break;
            case "egmond-binnen":
                return [52.5938149, 4.6560387];
                break;
            case "groet":
                return [52.7220044, 4.6670183];
                break;
            case "heerhugowaard":
                return [52.662677, 4.8324767];
                break;
            case "heiloo":
                return [52.6012341, 4.7004931];
                break;
            case "limmen":
                return [52.5715831, 4.6942467];
                break;
            case "zuidschermer":
                return [52.5843905, 4.7812001];
                break;
            case "ijmuiden":
                return [52.4569544, 4.6060138];
                break;
            case "assendelft":
                return [52.4870604, 4.7560638];
                break;
            case "jisp":
                return [52.5078271, 4.8483414];
                break;
            case "koog aan de zaan":
                return [52.4607871, 4.8047292];
                break;
            case "krommenie":
                return [52.5034775, 4.7571696];
                break;
            case "oostzaan":
                return [52.4376266, 4.8756005];
                break;
            case "west-grafdijk":
                return [52.5542536, 4.7950025];
                break;
            case "westknollendam":
                return [52.515415, 4.77787];
                break;
            case "westzaan":
                return [52.4642168, 4.7719876];
                break;
            case "wormer":
                return [52.4986623, 4.8124621];
                break;
            case "wormerveer":
                return [52.4903502, 4.7980674];
                break;
            case "zaandam":
                return [52.4420399, 4.8291992];
                break;
            case "zaandijk":
                return [52.4740433, 4.8028179];
                break;
            case "zaanstad":
                return [52.4579659, 4.7510425];
                break;
            case "haarlem":
                return [52.3873878, 4.6462194];
                break;
            case "heemstede":
                return [52.3510634, 4.6203004];
                break;
            default:
                return [0, 0];
        }
    }
}
