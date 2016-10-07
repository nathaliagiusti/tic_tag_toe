### Tic Tag Toe Game ###

#### Requirements ####
* PHP >= 5.6.4

* Vagrant >= 1.8.6

* Composer

* PHPUNIT(only required for running the tests)

#### Instalation ####
	git clone https://github.com/nathaliagiusti/tic_tag_toe.git
	cd tic_tag_toe

#### Configuring ####
	composer install
	php vendor/bin/homestead make
	
#### Add hostname to your hostfile  ####
Add the following line to your /etc/hosts file.

	192.168.10.10 homestead.app

#### Starting Server ####
	vagrant up
	
#### Open the application site ####

[http://homestead.app](http://homestead.app)

#### Run the tests ####
	phpunit


