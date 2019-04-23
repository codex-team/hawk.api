# The GraphQL HAWK.API Server
API to save/retrieve all data, related to the Hawk.io.

## Installation

### Docker
1. Download and setup Docker from the official [site](https://www.docker.com/products/docker-desktop)
2. In project root directory run ```docker-compose up --build```

### Server
1. Install PHP@7.2 or greater with required dependencies
```bash
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

2. Follow this [link](https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/) to install the correct version of MongoDB

3. Follow this [link](https://getcomposer.org/download/) to install Composer and then make it global

4. Configure your nginx according to this [article](https://ifmo.su/devops-basics)

## Setup configurations

To setup application in any environment copy `base.yml` which is
in `app/config` folder.

There are two cases of configuration usage: development or production modes

1) If you want to use your local environment to develop, name the file 
`development.yml` and set `DEBUG=true` in `.env` file

2) If you want to use in production, name file `production.yml` and set
`DEBUG=false` in `.env` file

### Mailing

In the project you are free to use any of two available mail services – [Mailgun](https://www.mailgun.com) and plain SMTP.

If you wish to use the first one, you have to create an account at Mailgun and write in `development.yml` or `production.yml` the following properties from this [page](https://app.mailgun.com/app/dashboard):
- API Key is for `key`
- Domain name is for `domain`
- Anything is for `from`

For using plain SMTP you must have only your mail account at any popular mail service (Yandex, Gmail, etc.) and fill `development.yml` or `production.yml`. Example:
```yaml
smtp:
  host: smtp.yandex.com
  port: 587
  username: hawk@yandex.ru
  password: HawkIsBird
```

