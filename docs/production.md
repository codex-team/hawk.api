## Installation

1. Install PHP@7.2 or greater with required dependencies
    ```bash
    add-apt-repository ppa:ondrej/php
    apt-get install nginx php php-pear php-dev php-mbstring unzip -y
    pecl install mongodb
    ```
    
2. Configure php.ini file to add extension=mongodb.so
    ```
    php --ini
    (path for example will be – Loaded Configuration File: /usr/local/etc/php/7.2/php.ini)
    echo "extension=mongodb.so" >> /usr/local/etc/php/7.2/php.ini
    ```
    
3. Follow this [link](https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/) to install the correct version of MongoDB

4. Follow this [link](https://getcomposer.org/download/) to install Composer and then make it global

5. Configure your nginx according to this [article](https://ifmo.su/devops-basics)
