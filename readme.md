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
Based on simple Vagrantfile and puppet manifestsi it should take care of setting up service available on 5555 port and 'msisdnresolver' resource. So locally it will be at 'localhost:5555/msisdnresolver'.
Since puppetlabs' module is used for Apache settings, adjusting it should be quite easy. The apache puppet module is installed through vagrant puppet provisioning itself so you don't have to worry about it. 
In case of problems with GitHub API limit (MsisdnResolver is being cloned by Composer during the process) set Github OAuthToken in 'vagrant/puppet/manifests

Usage
==
Example ExampleClientWebsite.php provided. 

