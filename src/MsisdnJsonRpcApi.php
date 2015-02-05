<?php
/*
 * JSON-RCP API provider, MsisdnJsonRpcApi Package.
 * RPC exposure package for Msisdn Resolver - a simple PHP package for interpreting MSISDN numbers. 
 *
 * (c) Mateusz Krasucki 2015
 *
 * License in LICENSE file in root directory of repository.
 */

 namespace MateuszKrasucki\MsisdnJsonRpcApi;

 require __DIR__ . '/../vendor/autoload.php';

 $apiMethods = new ApiMethods();
 $server = new \JsonRpc\Server($apiMethods);
 $server->receive();
