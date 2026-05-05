# Comment le Projet a ete Cree

## Etape 1 — Structure des dossiers

Depuis `TEST_DOCKER/`, on a cree les dossiers manuellement :

```powershell
mkdir -p docker/nginx docker/php src
```

## Etape 2 — Le Dockerfile PHP (docker/php/Dockerfile)

On a ecrit un Dockerfile multi-stage avec PHP 8.4 :
- **Stage builder** : compile les extensions PHP et installe Laravel via Composer
- **Stage production** : image finale avec uniquement le necessaire

Extensions PHP installees : `pdo_mysql`, `mbstring`, `exif`, `pcntl`, `bcmath`, `gd`, `xml`, `redis`

On utilise le script `install-php-extensions` (outil communautaire) pour gerer les extensions proprement.

## Etape 3 — Config PHP (docker/php/php.ini)

Parametres personnalises :
- `memory_limit = 256M`
- `upload_max_filesize = 50M`
- `max_execution_time = 120`
- Logs d'erreurs actives, affichage desactive (securite)

## Etape 4 — Config Nginx (docker/nginx/default.conf)

- Root pointe vers `/var/www/public` (le dossier public de Laravel)
- `try_files` pour que les routes Laravel fonctionnent
- `fastcgi_pass php:9000` pour envoyer les requetes PHP a PHP-FPM
- Blocage des fichiers caches (`.env`, `.git`)

## Etape 5 — docker-compose.yml

5 services declares :
- `nginx`, `php`, `mysql`, `redis`, `adminer`
- Volumes nommes pour la persistance des donnees
- Network `laravel` pour la communication interne

## Etape 6 — Fichier .env (racine du projet)

Variables d'environnement pour Docker Compose :
```
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
DB_ROOT_PASSWORD=root_secret
```

## Etape 7 — Installation de Laravel

On a installe Laravel SANS installer PHP sur Windows, grace a un container temporaire :

```powershell
docker run --rm -v "C:\Users\Administrator\Documents\PROJETS\TEST_DOCKER\src:/app" composer create-project laravel/laravel .
```

Le container Composer s'est efface tout seul apres l'installation.

## Etape 8 — Configuration du .env Laravel (src/.env)

On a modifie le `.env` de Laravel pour pointer vers les containers Docker :

```env
DB_CONNECTION=mysql
DB_HOST=mysql          # nom du service Docker, pas une IP
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis

REDIS_HOST=redis       # nom du service Docker
```

## Etape 9 — Premier lancement

```powershell
docker compose up --build
```

## Etape 10 — Migrations

```powershell
docker compose exec php php artisan migrate
```
