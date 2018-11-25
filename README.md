# The API-Server of "uptime-monitor" project
Easy to use API to save/retrieve all data, related to monitor project.

## GraphQL API

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

## Deployment steps
1. Everything about PHP
```
add-apt-repository ppa:ondrej/php
apt-get install nginx php php-pear php-dev php-mbstring unzip -y
pecl install mongodb (than add to php.ini as "extension=mongodb.so")
```
2. Follow this <a href="https://getcomposer.org/download/">link</a> to install Composer and then make it global
3. Follow this <a href="https://docs.mongodb.com/manual/tutorial/install-mongodb-on-ubuntu/">link</a> to install the correct version of MongoDB
4. Configure your nginx according to this <a href="https://ifmo.su/devops-basics">article</a>
