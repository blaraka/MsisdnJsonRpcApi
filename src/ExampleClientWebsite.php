<?php
/*
 * Example client website script for MsisdnJsonRpcApi Package.
 * RPC exposure package for Msisdn Resolver - a simple PHP package for interpreting MSISDN numbers. 
 *
 * (c) Mateusz Krasucki 2015
 *
 * License in LICENSE file in root directory of repository.
 */
 
 namespace MateuszKrasucki\MsisdnJsonRpcApi;
 
 require __DIR__ . '/../vendor/autoload.php';
 
 error_reporting(-1);
 header('Content-type: text/html; charset=utf-8');
 
 #url set for local VM isntance created using vagrant file
 $url = 'http://localhost:5555/msisdnresolver';
 $client = new \JsonRpc\Client($url);
 $method = 'getAllProperties';
 $params = array(array_key_exists('msisdn', $_POST) ? $_POST['msisdn'] : '');
 $success = false;
 $success = $client->call($method, $params);
  
 echo '<form method="post">';
 echo 'MSISDN: <input type="text" name="msisdn" value="' .
        (array_key_exists('msisdn', $_POST) ? $_POST['msisdn'] : "") . '">';
 echo '<input type="submit" value="Parse">';
 echo '</form>';
 
 echo '<b>MSISDN:</b> ' . $client->result->msisdn;
 echo '<br>';
 echo '<b>National Number:</b> ' . $client->result->nationalNumber;
 echo '<br>';
 echo '<b>Country Code:</b> ' . $client->result->countryCode;
 echo '<br>';
 echo '<b>Country ID:</b> ' . $client->result->countryId;
 echo '<br>';
 echo '<b>MNO:</b> ' . $client->result->mno;
 echo '<br>';
