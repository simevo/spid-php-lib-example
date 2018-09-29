<img src="https://github.com/italia/spid-graphics/blob/master/spid-logos/spid-logo-b-lb.png" alt="SPID" data-canonical-src="https://github.com/italia/spid-graphics/blob/master/spid-logos/spid-logo-b-lb.png" width="500" height="98" />

[![Join the #spid-php channel](https://img.shields.io/badge/Slack%20channel-%23spid--php-blue.svg?logo=slack)](https://developersitalia.slack.com/messages/CB6DCK274)
[![Get invited](https://slack.developers.italia.it/badge.svg)](https://slack.developers.italia.it/)
[![SPID on forum.italia.it](https://img.shields.io/badge/Forum-SPID-blue.svg)](https://forum.italia.it/c/spid)

# spid-php-lib-example

This repository contains a basic demo application based on [spid-php-lib](https://github.com/italia/spid-php-lib), easy to setup thanks to [Docker Compose](https://docs.docker.com/compose/overview/).

The supplied [docker-compose.yml](/docker-compose.yml) file defines and runs a two-container Docker application that comprises:
- this SPID Service Provider (SP) example
- and the SPID test Identity Provider (IdP) [spid-testenv2](https://github.com/italia/spid-testenv2)configured to talk to each other.

## Getting Started

Tested on: amd64 Debian 10 (buster, next stable) with Docker 18.06 and Docker Compose 1.17.

1. Install prerequisites:
```sh
apt install docker-io docker-compose
```

2. Run `docker-compose up --build`

3. Visit: http://localhost:8099/ and click `login`.

This screencast shows what you should see if all goes well:

![img](images/screencast.gif)

## Authors

Lorenzo Cattaneo and Paolo Greppi, simevo s.r.l.

## License

Copyright (c) 2018, Developers Italia

License: BSD 3-Clause, see [LICENSE](LICENSE) file.
