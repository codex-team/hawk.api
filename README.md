# The GraphQL HAWK.API Server
API to save/retrieve all data, related to the Hawk.io.

## Installation
Development and production installation guides are available [here](https://github.com/codex-team/hawk.api/tree/master/docs) 

## How to send a request?
To test API you can use <a href="https://insomnia.rest">Insomnia</a>\
For cURL request to GraphQL it looks like:
```
curl -X POST -H "Content-Type: application/json" \ 
--data '{ "query": "{ projects { name, url } }" }' https://api.hawk.so
```

## Requests
### New user registration
Welcome email will be send at the given email address
```graphql
mutation Reg {
  register(
    email: "hawk@gmail.com"
  ) {
    _id
  }
}
```