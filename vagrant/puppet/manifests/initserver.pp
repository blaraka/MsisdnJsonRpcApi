$gittoken = ""

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
 
exec { 'composerdo::setgittoken':
    command => 'composer config -g github-oauth.github.com ${gittoken}',
    environment => ["COMPOSER_HOME=/home/vagrant"],
    onlyif => 'test ${gittoken} != ""',
}
 
exec { 'composerdo::installpackage':
    command => 'composer install -d /var/www/MsisdnJsonRpcApi',
    environment => ["COMPOSER_HOME=/home/vagrant"],
    creates => "/var/www/MsisdnJsonRpcApi/composer.lock",
}

exec { 'composerdo::updatepackage':
    command => 'composer update -d /var/www/MsisdnJsonRpcApi',
    environment => ["COMPOSER_HOME=/home/vagrant"],
    onlyif => "test `ls /var/www/MsisdnJsonRpcApi | grep composer.lock`",
}

Class['composer']  ~>  Exec['composerdo::setgittoken'] ~> Exec['composerdo::updatepackage'] ~> Exec['composerdo::installpackage']
 