# MyRapport

## Dokumentation
[Aktuelle Projektskizze](PDF's/MyRapport_Projektstruktur_0.6.pdf)

##Allgemein
Das Projekt MyRapport wurde mit dem PHP Framework Symfony erstellt.
Webseite: https://symfony.com

## Installation Symfony
### Pakete installieren
Zuerst müssen die nötigen Pakete installiert werden:

```
sudo apt-get install php5-sqlite php5-pgsql
```

### Installation des Symfony Command
Danach das Symfony-Framework (siehe auch https://symfony.com/doc/current/book/installation.html) installieren:

```
$ sudo curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
$ sudo chmod a+x /usr/local/bin/symfony
```

### Anlegen des ersten Symphony Projektes

Im Verzeichnis /home/student/symfony/projects folgenden Befehl ausführen:

```
symfony new notes_project
```

Ausgabe:

```
 Downloading Symfony...

    4.97 MB/4.97 MB ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓  100%

 Preparing project...

 ✔  Symfony 3.0.3 was successfully installed. Now you can:

    * Change your current directory to /home/student/symphony/projects/notes_project

    * Configure your application in app/config/parameters.yml file.

    * Run your application:
        1. Execute the php bin/console server:run command.
        2. Browse to the http://localhost:8000 URL.

    * Read the documentation at http://symfony.com/doc
```

Anlegen der Postgres-Datenbank **symfony_notes_project** und die Konfiguration in app/config/parameters.yml anpassen:

```
This file is auto-generated during the composer install
parameters:
    database_host: 127.0.0.1
    database_port: 5432
    database_name: symfony_notes_project
    database_user: postgres
    database_password: postgres
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: a42a6cff6d9a238a9559ee6fd682a36ef6656b89
```

### Ausführen der Symfony Applikation

Starten des Servers

```
student@ubuntu:~/symphony/projects/notes_project$ php bin/console server:start
```

Ausgabe:

```
[OK] Server running on http://127.0.0.1:8000
```

Aufrufen der Webseite gibt die Startseite von Symphony aus.

## Installation MyRapport
1. Datenbank installieren
	```
	sudo apt-get install php5-sqlite php5-pgsql
	```

2. Installer installieren
	```
	$ sudo curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
	$ sudo chmod a+x /usr/local/bin/symfony
	```

3. GIT-Projekt von MyRapport clonen

	```
	git clone https://github.com/nitrobar/MyRapport.git
	```

4. Im Verzeichniss web/my_project composer ausführen: 
	```
	composer install
	```
	Datenbank-Parameter angeben:
	```
	parameters:
    	database_host: 127.0.0.1
    	database_port: 5432
    	database_name: myRapport
    	database_user: postgres
    	database_password: postgres
    	mailer_transport: smtp
    	mailer_host: 127.0.0.1
    	mailer_user: null
    	mailer_password: null
    	secret: ThisTokenIsNotSoSecretChangeIt
	```

5. Dantenbanktreiber installieren und Apache Server neustarten
	```
	sudo apt-get install php5-pgsql	
	sudo service apache2 restart

	```

6. Mit Doctrine die Datenbank erstellen und danach die Tabellen erzeugen: 
	```
	$ php bin/console doctrine:database:create
	$ php bin/console doctrine:schema:update --force
	```

7. Anschliessend müssen folgende SQL Anweisungen in der Datenbank "myRapport" ausgeführt werden, damit ein Mitarbeiter und Chef angelegt werden.
	```
	﻿INSERT INTO mitarbeiterliste VALUES (1, 'Mitarbeiter');
	INSERT INTO mitarbeiterliste VALUES (2, 'Chef');

	INSERT INTO mitarbeiter VALUES (1, 1, 'Mitarbeiter', 80, 'Mitarbeiter');
	INSERT INTO mitarbeiter VALUES (2, 2, 'Chef', 150, 'Chef');
	```

8. Im Verzeichniss web/my_project den Server starten
	```
	php bin/console server:start
	```

## Symfony Cookbook

https://symfony.com/doc/current/cookbook/index.html

## Managing Projects in Git

https://symfony.com/doc/current/cookbook/workflow/new_project_git.html



