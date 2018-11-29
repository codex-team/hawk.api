# The GraphQL-API-Server of "uptime-monitor" project
Easy to use API to save/retrieve all data, related to monitor project.

## Available API methods
### Create Project
```graphql
mutation CreateProject {
  project(
    name:"HAWK",
    url:"https://hawk.so"
  ){
    name,
    url
  }
}
```

### Update Project
```graphql
mutation UpdateProject {
  project(
    id:"5a70ac62e1d8ff5cda8322a0",
    name:"Capella",
    url:"https://capella.pic"
  ){
    name,
    url
  }
}
```

#### Parameters
| Parameter | Type | Description |
| -- | -- | -- |
| ID | String | Projects's unique identifier. 24-character hexadecimal string |
| name | String | Project's name |
| url | String | Project's URL |

### Retrieve all projects
```graphql
query AllProjects {
  projects {
    name,
    url
  }
}
```

## How to send a request?
To test API you can use <a href="https://insomnia.rest">Insomnia</a>\
For cURL request to GraphQL it looks like:
```
curl -X POST -H "Content-Type: application/json" \ 
--data '{ "query": "{ projects { name, url } }" }' https://api.monitor.ifmo.su 
```

## Deployment
### Docker
1. Download and setup Docker from the official  <a href="https://www.docker.com/products/docker-desktop">site</a>
2. In project root directory run ```docker-compose up --build```

### Server
1. Install PHP@7.2
```
add-apt-repository ppa:ondrej/php
apt-get install nginx php php-pear php-dev php-mbstring unzip -y
pecl install mongodb (than add to php.ini as "extension=mongodb.so")
```
2. Follow this <a href="https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/">link</a> to install the correct version of MongoDB
3. Follow this <a href="https://getcomposer.org/download/">link</a> to install Composer and then make it global
4. Configure your nginx according to this <a href="https://ifmo.su/devops-basics">article</a>
