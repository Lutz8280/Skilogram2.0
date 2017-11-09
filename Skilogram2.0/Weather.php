<?php

class Weather {
    const UNITS_METRIC = 'metric';
    const UNITS_IMPERIAL = 'imperial';
    const API_URL = 'http://api.openweathermap.org/data/2.5/weather';
    private $api_key, $units;

    public function __construct($api_key, $units = self::UNITS_METRIC) {
        $this->api_key = $api_key;
        $this->units = $units;
    }
    
    public function getWeatherByCity($city_name, $country_name) {
        $config = [
            'q' => $city_name . ',' . $country_name,
        ];

        return $this->sendRequest($config);
    }

    public function getWeatherByCoordinates($lat, $lon) {
        $config = [
            'lat' => $lat,
            'lon' => $lon,
        ];

        return $this->sendRequest($config);
    }
    
    private function getWeather($config) {
        $result = $this->sendRequest($config);
        
        $icon = 'https://openweathermap.org/img/w/' . $result['weather'][0]['icon'] . '.png';
        
        return [
            'icon' => $icon,
            'humidity' => $result['main']['humidity'],
            'temperature' => $result['main']['temp'],  
        ];
    }
    
    private function sendRequest($config) {
        $common_config = [
        'appid' => $this->api_key,
        'units' => $this->units,    
        ];
        $config = array_merge($config, $common_config);
        $params = http_build_query($config);

        $url = self::API_URL . '?' . $params;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        return $result;
    }

}
