<?php
// URL বা ফর্ম থেকে প্যারামিটার নেওয়া
$longitude = isset($_GET['longitude']) ? floatval($_GET['longitude']) : 90.403;
$latitude  = isset($_GET['latitude']) ? floatval($_GET['latitude']) : 23.786;
$days      = isset($_GET['days']) ? explode(',', $_GET['days']) : ["condition", "temperature"];
$conditions = isset($_GET['conditions']) 
    ? explode(',', $_GET['conditions']) 
    : [
        "sunShower","rainVeryLight","rainLight","rainModerate","rainHeavy",
        "rainExtreme","hail","snowLight","snowModerate","snowHeavy",
        "clearDay","clearNight","clearMostlyDay","clearMostlyNight",
        "cloudPartlyDay","cloudPartlyNight","cloudOvercast","windStrong"
      ];
$timeZone = true;

// JSON ডেটা তৈরি
$data = json_encode([
    "longitude" => $longitude,
    "latitude" => $latitude,
    "timeZone" => $timeZone,
    "daily" => [
        "days" => $days,
        "conditions" => $conditions
    ]
]);

// হেডারগুলো
$headers = [
    'User-Agent: Mozilla/5.0 (Linux; Android 13; V2116 Build/TP1A.220624.014_NONFC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.7204.181 Mobile Safari/537.36',
    'Accept-Encoding: gzip, deflate, br, zstd',
    'Content-Type: text/plain;charset=UTF-8',
    'sec-ch-ua-platform: "Android"',
    'sec-ch-ua: "Not)A;Brand";v="8", "Chromium";v="138", "Android WebView";v="138"',
    'request-signature: ZTD4MzL1A2ZhZQR5BTV0BTLlBGx4YwL5',
    'sec-ch-ua-mobile: ?1',
    'origin: https://zoom.earth',
    'x-requested-with: mark.via.gp',
    'sec-fetch-site: same-site',
    'sec-fetch-mode: cors',
    'sec-fetch-dest: empty',
    'referer: https://zoom.earth/',
    'accept-language: en-US,en;q=0.9',
    'priority: u=1, i'
];

// cURL রিকোয়েস্ট
$ch = curl_init('https://api.zoom.earth/weather/');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2);

// রেসপন্স
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    header('Content-Type: application/json');
    echo $response;
}

curl_close($ch);
?>