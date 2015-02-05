$gittoken = ''

Exec { path => '/usr/local/bin:/usr/bin:/bin:/usr/local/sbin:/usr/sbin:/sbin' }

class { 'apache':
    default_vhost => false,
    default_mods => false,
    mpm_module => 'prefork',
}
 
apache::vhost { 'localhost':
    port => '80',
    docroot => '/var/www',
    rewrites => [ { rewrite_rule => ['^/?msisdnresolver[/]?$ /MsisdnJsonRpcApi/src/MsisdnJsonRpcApi.php'] } ],
} 

class { '::apache::mod::php':
}

class { 'composer':
    command_name => 'composer',
    target_dir   => '/usr/local/bin',
    auto_update => true,
}
 
exec { 'composergittoken':
    command => 'composer config -g github-oauth.github.com ${gittoken}',
    environment => ["COMPOSER_HOME=/home/vagrant"],
}
 
exec { 'composerinstall':
    command => 'composer install -d /var/www/MsisdnJsonRpcApi',
    environment => ["COMPOSER_HOME=/home/vagrant"],
    creates => "/var/www/MsisdnJsonRpcApi/composer.lock",
}

exec { 'composerupdate':
    command => 'composer update -d /var/www/MsisdnJsonRpcApi',
    environment => ["COMPOSER_HOME=/home/vagrant"],
    onlyif => "test `ls /var/www/MsisdnJsonRpcApi | grep composer.lock`",
}

Class['composer']  ~>  Exec['composergittoken'] ~> Exec['composerupdate'] ~> Exec['composerinstall']
 