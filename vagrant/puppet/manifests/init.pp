class { 'apache':
    default_vhost => false,
    default_mods => false,
    mpm_module => 'prefork',
}
 
include apache::mod::php
 
apache::vhost { 'localhost':
    port    => '80',
    docroot => '/var/www',
    rewrites => [ { rewrite_rule => ['^/?msisdnresolver[/]?$ /MsisdnJsonRpcApi/src/MsisdnJsonRpcApi.php'] } ]
}

class { 'composer':
    command_name => 'composer',
    target_dir   => '/usr/local/bin',
    auto_update => true
}
 
exec { 'composer':
    command => 'composer install -d /var/www/MsisdnJsonRpcApi/';
}
 
 