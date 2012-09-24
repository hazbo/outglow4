class mongodb{

	package{ "mongodb":
		ensure => present,
		require => Exec['phpunit']
	}


}