# Architecture du Projet

## La Stack

```
Internet
   ↓
Nginx (port 8080)        ← recoit les requetes HTTP
   ↓
PHP-FPM (Laravel)        ← execute le code PHP
   ↓           ↓
MySQL        Redis        ← base de donnees / cache & sessions
   ↓
Adminer (port 8081)      ← interface graphique pour voir la DB
```

## Les 5 Services Docker

| Service  | Image              | Port         | Role |
|----------|--------------------|--------------|------|
| nginx    | nginx:alpine       | 8080         | Serveur web / reverse proxy |
| php      | custom (Dockerfile)| -            | PHP 8.4 + Laravel |
| mysql    | mysql:8.0          | 3306         | Base de donnees |
| redis    | redis:alpine       | -            | Cache et sessions |
| adminer  | adminer            | 8081         | Interface web MySQL |

## Structure des Fichiers

```
TEST_DOCKER/
├── docker/
│   ├── nginx/
│   │   └── default.conf     ← configuration du serveur web
│   └── php/
│       ├── Dockerfile        ← recette pour construire l'image PHP
│       └── php.ini           ← configuration PHP
├── src/                     ← tout le code Laravel est ici
│   ├── app/
│   ├── docs/                ← cette documentation
│   ├── public/
│   ├── routes/
│   └── ...
├── docker-compose.yml       ← orchestration des 5 services
└── .env                     ← variables d'environnement (mots de passe, etc.)
```

## Concepts Docker Appliques

### Multi-Stage Build (Module 6)
Le Dockerfile a 2 etapes :
- **Stage "builder"** : installe tous les outils de compilation, compile les extensions PHP, installe les dependances Composer
- **Stage "production"** : image finale legere, contient uniquement ce qui est necessaire pour faire tourner l'app

Resultat : image 3x plus petite, moins de failles de securite.

### Utilisateur Non-Root (Module 6)
PHP-FPM tourne avec l'utilisateur `laravel` (pas `root`). Si quelqu'un pirate l'app, il n'a pas les droits admin sur le serveur.

### Volumes Persistants (Module 4)
```yaml
volumes:
  mysql_data:   # les donnees MySQL survivent aux redemarrages
  redis_data:   # idem pour Redis
```

### Network Interne (Module 4)
Tous les services communiquent par leur nom (`mysql`, `redis`, `php`) sans exposer leurs ports sur internet.
