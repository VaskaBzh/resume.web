&nbsp;
<p align="center" >
<img src="public/logo.svg" alt="Логотип" />
</p>
&nbsp;

Before starting the installation, make sure you have docker and docker-compose installed on your system
&nbsp;
###### Ubuntu installation guides:

[docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04)

[docker-compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04)

###### Mac Os: 
[docker desktop](https://docs.docker.com/desktop/install/mac-install/)


----

###### make command

~~~
sudo apt update
~~~
~~~
sudo apt install make
~~~

###### or for mac os

~~~
 brew install make
~~~

### Installation

###### This command will install all images, dependencies, generate an application key and run migrations
~~~
 make up
~~~

###### Put the token in .env file

~~~
BTC_AUTH_TOKEN=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N
~~~

###### Fill the database with permissions and user 

~~~
 make seed
~~~

###### You will also need to run commands to synchronize data with btc.com in the given order
~~~
 make stats
 make sync-workers
 make worker-hashes
~~~

###### For front end development

~~~
 make dev
~~~

###### Clear the cache if necessary

~~~
 make clear
~~~

###### Tests

~~~
 make test
~~~
