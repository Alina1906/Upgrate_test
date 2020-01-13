<?php
function GetCountry($ip){
    $apiKey = "de760260d6144807b95595558bdab613";

    
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang="."en"."&fields="."*"."&excludes="."";
    $cURL = curl_init();

    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
 
    $location = curl_exec($cURL);
    $decodedLocation = json_decode($location, True);
    return $decodedLocation['country_name'];
}