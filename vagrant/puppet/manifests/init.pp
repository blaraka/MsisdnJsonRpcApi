exec { 'composer':
    command => '/usr/local/bin composer install -d /var/www/MsisdnJsonRpcApi/';
}

include apache::mod::php

stage { 'pre':
  before => Stage["main"],
}

class { 'apache':
    default_vhost => false,
    default_mods => false,
    mpm_module => 'prefork',
    stage => 'pre'
}
  
apache::vhost { 'localhost':
    port    => '80',
    docroot => '/var/www',
    rewrites => [ { rewrite_rule => ['^/?msisdnresolver[/]?$ /MsisdnJsonRpcApi/src/MsisdnJsonRpcApi.php'] } ],
    stage = 'pre'
}

class { 'composer':
    command_name => 'composer',
    target_dir   => '/usr/local/bin',
    auto_update => true,
    stage = 'pre'
}
 
 