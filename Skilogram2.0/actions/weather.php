<?php
$weather = new Weather('012e34537b328a78762f56bb13b7ac8c');
$result = $weather->getWeatherByCity('Saint-Petersburg', 'ru');
var_dump($result);?>

Icon: <img src="<?=$result['icon']; ?>" /><br/>
Temp: <?=$result['temperature']; ?><br/>
Humidity: <?=$result['humidity']; ?><br/>