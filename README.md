Sample
==========

## Wymagania
* PHP 7.1 albo wyżej (np. 7.1.4)

##Instalacja
* host `127.0.0.1    sample.local`
* vhost 

```
#################################### SAMPLE
<VirtualHost *:80>
	ServerName sample.local
	DocumentRoot "${INSTALL_DIR}/www/sample/web"
	<Directory "${INSTALL_DIR}/www/sample/web">
		 AllowOverride All
		 Order Allow,Deny
		 Allow from All
	</Directory>
</VirtualHost>
```

* `git clone https://github.com/piotrp321/sample.git .` w folderze gdzie ma być projekt
*  w mysql `CREATE DATABASE sample`
*  utworzenie plików konfiguracyjnych `parameters.yml` na podstawie odp. plików `parameters.yml.dist` w `app/config`
* `composer install` w głównym katalogu projektu, zaciąga zależności
* `php bin/console doctrine:schema:update --force` tworzy schemat bazy danych