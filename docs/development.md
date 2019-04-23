# The GraphQL HAWK.API Server
API to save/retrieve all data, related to the Hawk.io.

## Installation

### Docker
1. Download and setup Docker from the official  <a href="https://www.docker.com/products/docker-desktop">site</a>
2. In project root directory run ```docker-compose up --build```

### Server
1. Install PHP@7.2 or greater with required dependencies
```
add-apt-repository ppa:ondrej/php
apt-get install nginx php php-pear php-dev php-mbstring unzip -y
pecl install mongodb

```

3. Configure php.ini file to add extension=mongodb.so
```
php --ini
(path for example will be – Loaded Configuration File: /usr/local/etc/php/7.2/php.ini)
echo "extension=mongodb.so" >> /usr/local/etc/php/7.2/php.ini

```

2. Follow this <a href="https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/">link</a> to install the correct version of MongoDB

3. Follow this <a href="https://getcomposer.org/download/">link</a> to install Composer and then make it global

4. Configure your nginx according to this <a href="https://ifmo.su/devops-basics">article</a>

## Setup configurations

To setup application in any environment copy `base.yml` which is
in `app/config` folder.

There are two cases of configuration usage: development or production modes

1) If you want to use your local environment to develop, name the file 
`development.yml` and set `DEBUG=true` in `.env` file

2) If you want to use in production, name file `production.yml` and set
`DEBUG=false` in `.env` file 