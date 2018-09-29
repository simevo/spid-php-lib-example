include .env

all:
	# Configure SP
	openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -subj "/C=IT/ST=Italy/L=Rome/O=myservice/CN=localhost" -keyout sp_conf/sp.key -out sp_conf/sp.crt & wait;\
	chmod o+r sp_conf/sp.key
	envsubst < sp_conf/config.php.tpl > sp_conf/config.php
	# Configure test IdP
	envsubst < idp_conf/config.yaml.tpl > idp_conf/config.yaml
	openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -subj "/C=IT/ST=Italy/L=Rome/O=myservice/CN=localhost" -keyout idp_conf/idp.key -out idp_conf/idp.crt

post:
	curl -o idp_conf/sp_metadata.xml http://localhost:8099/metadata
	curl -o sp_conf/idp_testenv2.xml http://localhost:8088/metadata

clean:
	rm -f idp_conf/idp.key
	rm -f idp_conf/idp.crt
	rm -f idp_conf/sp_metadata.xml
	rm -f sp_conf/sp.key
	rm -f sp_conf/sp.crt
	rm -f sp_conf/*.xml
