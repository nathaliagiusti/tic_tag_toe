### Tic Tag Toe Game ###

#### Requirements ####
* Vagrant

* Composer

* PHPUNIT(only required for running the tests)

#### Instalation ####
	git clone https://github.com/nathaliagiusti/tic_tag_toe.git
	cd tic_tag_toe

#### Configuring ####
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


