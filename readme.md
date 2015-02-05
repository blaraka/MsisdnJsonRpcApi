MsisdnJsonRpcApi
=============

MsisdnJsonRpcApi package for PHP.

A simple PHP package exposing MsisdnResolver package through JSON-RPC. 

Features
==
MSISDN parsing system is being exposed to web via JSON-RPC. 
John Stevenson's JSON-RPC PHP library is used. 

Installation
==
To get functional VM running MSISDN resolving service using this package just download this repository and run 'vagrant up' in vagrant directory.
Based on simple Vagrantfile and puppet manifests should take care of setting up service available on 5555 port and 'msisdnresolver' resource. So locally it would be at 'localhost:5555/msisdnresolver'.
Since puppetlabs' module is used for Apache setting putting additional settings should be quite easy. The apache puppet module is installed through vagrant puppet provisioning itself so you don't have to worry about it. 
In cape of problem with API limit set Github OAuthToken in 'vagrant/puppet/manifests

Usage
==
Example ExampleClientWebsite.php provided. 

