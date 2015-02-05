Exec { path => '/usr/local/bin:/usr/bin:/bin:/usr/local/sbin:/usr/sbin:/sbin' }

exec {'puppetmodule::apache':
    command => 'puppet module install puppetlabs/apache',
    onlyif => "test ! `puppet module list | grep apache`",
}


exec {'puppetmodule::composer':
    command => 'puppet module install willdurand/composer',
    onlyif => "test ! `puppet module list | grep composer`",
}

package {'git':
    ensure => "installed"
}

