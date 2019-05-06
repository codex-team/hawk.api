# The GraphQL HAWK.API Server
API to save/retrieve all data, related to the Hawk.io.

## Docker Installation
1. Before installation follow the 'setup configuration' chapter
2. Download and setup Docker from the official [site](https://www.docker.com/products/docker-desktop)
3. In project root directory run `docker-compose up --build`

API will be available at 8080 port\
MongoDB will be available at 27017 port

## Setup configurations

To setup application in any environment copy `base.yml` which is
in `app/config` folder and copy and rename `.env.example` to `.env`

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

