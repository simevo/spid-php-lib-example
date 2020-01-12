<img src="https://github.com/italia/spid-graphics/blob/master/spid-logos/spid-logo-b-lb.png" alt="SPID" data-canonical-src="https://github.com/italia/spid-graphics/blob/master/spid-logos/spid-logo-b-lb.png" width="500" height="98" />

[![Join the #spid-php channel](https://img.shields.io/badge/Slack%20channel-%23spid--php-blue.svg?logo=slack)](https://developersitalia.slack.com/messages/CB6DCK274)
[![Get invited](https://slack.developers.italia.it/badge.svg)](https://slack.developers.italia.it/)
[![SPID on forum.italia.it](https://img.shields.io/badge/Forum-SPID-blue.svg)](https://forum.italia.it/c/spid)
[![Build Status](https://travis-ci.com/simevo/spid-php-lib-example.svg?branch=master)](https://travis-ci.com/simevo/spid-php-lib-example)

# spid-php-lib-example

This repository contains a basic demo application based on [spid-php-lib](https://github.com/italia/spid-php-lib), easy to setup thanks to [Docker Compose](https://docs.docker.com/compose/overview/).

The supplied [docker-compose.yml](/docker-compose.yml) file defines and runs a two-container Docker application that comprises:
- this SPID Service Provider (SP) example
- and the SPID test Identity Provider (IdP) [spid-testenv2](https://github.com/italia/spid-testenv2) configured to talk to each other.

## Getting Started

Tested on: amd64 Debian 10 (buster, next stable) with Docker 18.06 and Docker Compose 1.17.

1. Install prerequisites:
```sh
sudo apt install docker.io docker-compose
```

2. Run `docker-compose up --build`

3. Visit the SP homepage http://localhost:8099/ and click `login` (user: `test`, password: `test`)

4. Visit the IdP homepage http://localhost:8088/ to review its configuration.

This screencast shows what you should see if all goes well:

![img](images/screencast.gif)

To stop the two containers and remove them and all the other bits created by `docker-compose up`, run the command:
```sh
docker-compose down
```

If you relaunch the docker-compose after a while, make sure you run it with the latest version of the SPID test IdP:
```sh
docker pull italia/spid-testenv2
```

## Refreshing key/certificate pairs

If on visiting http://localhost:8099/login you get "Errori di validazione. Il certificato è scaduto.", refresh key/certificate pairs for SP and IdP:

```
openssl req -x509 -nodes -sha256 -subj '/C=IT' -newkey rsa:2048 -keyout idp_conf/idp.key -out idp_conf/idp.crt
openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -subj "/C=IT/ST=Italy/L=Milan/O=myservice/CN=localhost" -keyout sp_conf/sp.key -out sp_conf/sp.crt
wget http://localhost:8099/metadata -O idp_conf/sp_metadata.xml
wget http://localhost:8088/metadata -O sp_conf/idp_testenv2.xml
```

## Authors

Lorenzo Cattaneo and Paolo Greppi, simevo s.r.l.

## License

Copyright (c) 2018-2020, Developers Italia

License: BSD 3-Clause, see [LICENSE](LICENSE) file.
