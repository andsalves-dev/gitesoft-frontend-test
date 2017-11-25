<?php

header('Access-Control-Allow-Origin: *');
sleep(3);

/**
 * This script mirrors metaweather API.
 * It offers two commands:
 *
 * command: search
 * uri: weather.php?command=search&keyword={your_keyword}
 * 
 * command: location
 * uri: weather.php?command=location&woeid={target_woeid}
 */

/**
 * Declarations
 */
$validCommands = [
	'search',
	'location'
];

$command = isset($_GET['command']) ? $_GET['command'] : null;
$baseUrl = 'https://www.metaweather.com/api/location/';

/**
 * Functions
 */
function quitWithResponse($output, $code = 200) {
	header('Content-Type: text/json');
	http_response_code($code);
	echo $output;
	exit;
}

function quitWithJsonResponse($output, $code = 200) {
	return quitWithResponse(
		json_encode($output),
		$code
	);
}

function mirrorToEndpointMock($uri) {
	global $baseUrl;
	$response = '{
    "consolidated_weather": [
        {
            "id": 5778032493068288,
            "weather_state_name": "Heavy Rain",
            "weather_state_abbr": "hr",
            "wind_direction_compass": "NNW",
            "created": "2017-11-25T17:31:52.979650Z",
            "applicable_date": "2017-11-25",
            "min_temp": 2.3639999999999999,
            "max_temp": 4.774,
            "the_temp": 4.7349999999999994,
            "wind_speed": 6.4385559211834886,
            "wind_direction": 345.00605196589186,
            "air_pressure": 1009.505,
            "humidity": 93,
            "visibility": 5.4292307921737049,
            "predictability": 77
        },
        {
            "id": 4714143122718720,
            "weather_state_name": "Heavy Cloud",
            "weather_state_abbr": "hc",
            "wind_direction_compass": "SW",
            "created": "2017-11-25T17:31:56.582770Z",
            "applicable_date": "2017-11-26",
            "min_temp": 2.512,
            "max_temp": 5.5179999999999998,
            "the_temp": 3.8900000000000001,
            "wind_speed": 10.737100759206236,
            "wind_direction": 232.1806711734128,
            "air_pressure": 1018.9549999999999,
            "humidity": 82,
            "visibility": 16.895082716933111,
            "predictability": 71
        },
        {
            "id": 6747843423371264,
            "weather_state_name": "Showers",
            "weather_state_abbr": "s",
            "wind_direction_compass": "SW",
            "created": "2017-11-25T17:31:59.489670Z",
            "applicable_date": "2017-11-27",
            "min_temp": 3.6079999999999997,
            "max_temp": 5.3819999999999997,
            "the_temp": 4.6500000000000004,
            "wind_speed": 10.911709234585222,
            "wind_direction": 221.55269544993968,
            "air_pressure": 1020.01,
            "humidity": 81,
            "visibility": 17.876227829475859,
            "predictability": 73
        },
        {
            "id": 4509237749219328,
            "weather_state_name": "Showers",
            "weather_state_abbr": "s",
            "wind_direction_compass": "SSW",
            "created": "2017-11-25T17:32:02.673500Z",
            "applicable_date": "2017-11-28",
            "min_temp": 3.6280000000000001,
            "max_temp": 6.2619999999999996,
            "the_temp": 5.7949999999999999,
            "wind_speed": 9.9056579301487311,
            "wind_direction": 204.80216246242639,
            "air_pressure": 1007.23,
            "humidity": 85,
            "visibility": 12.392005686789151,
            "predictability": 73
        },
        {
            "id": 5676493292175360,
            "weather_state_name": "Heavy Cloud",
            "weather_state_abbr": "hc",
            "wind_direction_compass": "SSW",
            "created": "2017-11-25T17:32:05.084900Z",
            "applicable_date": "2017-11-29",
            "min_temp": 2.5339999999999998,
            "max_temp": 5.6120000000000001,
            "the_temp": 5.3450000000000006,
            "wind_speed": 7.4878564839195105,
            "wind_direction": 210.68138452100771,
            "air_pressure": 1000.375,
            "humidity": 82,
            "visibility": 17.691059214189135,
            "predictability": 71
        },
        {
            "id": 4800750534262784,
            "weather_state_name": "Heavy Cloud",
            "weather_state_abbr": "hc",
            "wind_direction_compass": "SW",
            "created": "2017-11-25T17:32:09.266340Z",
            "applicable_date": "2017-11-30",
            "min_temp": 1.5640000000000001,
            "max_temp": 4.0540000000000003,
            "the_temp": 4.5499999999999998,
            "wind_speed": 5.3744811301996336,
            "wind_direction": 228.90863399485582,
            "air_pressure": 1007.9,
            "humidity": 82,
            "visibility": null,
            "predictability": 71
        }
    ],
    "time": "2017-11-25T20:31:36.287830+01:00",
    "sun_rise": "2017-11-25T07:45:29.550150+01:00",
    "sun_set": "2017-11-25T16:01:05.945357+01:00",
    "timezone_name": "LMT",
    "parent": {
        "title": "Germany",
        "location_type": "Country",
        "woeid": 23424829,
        "latt_long": "51.164181,10.454150"
    },
    "sources": [
        {
            "title": "BBC",
            "slug": "bbc",
            "url": "http://www.bbc.co.uk/weather/",
            "crawl_rate": 180
        },
        {
            "title": "Forecast.io",
            "slug": "forecast-io",
            "url": "http://forecast.io/",
            "crawl_rate": 480
        },
        {
            "title": "HAMweather",
            "slug": "hamweather",
            "url": "http://www.hamweather.com/",
            "crawl_rate": 360
        },
        {
            "title": "Met Office",
            "slug": "met-office",
            "url": "http://www.metoffice.gov.uk/",
            "crawl_rate": 180
        },
        {
            "title": "OpenWeatherMap",
            "slug": "openweathermap",
            "url": "http://openweathermap.org/",
            "crawl_rate": 360
        },
        {
            "title": "Weather Underground",
            "slug": "wunderground",
            "url": "https://www.wunderground.com/?apiref=fc30dc3cd224e19b",
            "crawl_rate": 720
        },
        {
            "title": "World Weather Online",
            "slug": "world-weather-online",
            "url": "http://www.worldweatheronline.com/",
            "crawl_rate": 360
        },
        {
            "title": "Yahoo",
            "slug": "yahoo",
            "url": "http://weather.yahoo.com/",
            "crawl_rate": 180
        }
    ],
    "title": "Berlin",
    "location_type": "City",
    "woeid": 638242,
    "latt_long": "52.516071,13.376980",
    "timezone": "Europe/Berlin"
}';
    $response = json_decode($response, true);
    $response['woeid'] = $_GET['woeid'];
    $response = json_encode($response);
	
	if ( $response ) {
		return quitWithResponse($response);	
	}	
	
	quitWithJsonResponse(['error' => 'Not found'], 404);
}

function requireParameters($params) {
	foreach ($params as $param) {
		if (!isset($_GET[$param])) {
			quitWithJsonResponse(['error' => $param . ' is missing']);
		}
	}
}


function mirrorToEndpoint($uri) {
    global $baseUrl;
    $response = @file_get_contents($baseUrl . $uri);

    if ( $response ) {
        return quitWithResponse($response);
    }

    quitWithJsonResponse(['error' => 'Not found'], 404);
}

/**
 * Commands
 */
function search() {
	requireParameters(['keyword']);
	return mirrorToEndpoint('search/?query=' . $_GET['keyword']);
}

function location() {
	requireParameters(['woeid']);
	return mirrorToEndpointMock($_GET['woeid']);
}

/**
 * Execution
 */
if (is_null($command) or !in_array($command, $validCommands)) {
	quitWithJsonResponse(['error' => 'Invalid command'], 422);
}

$command();