# Resume du Projet — Laravel + Docker

## C'est quoi ce projet ?

Un environnement de developpement Laravel complet tourne entierement dans Docker.
Aucun logiciel (PHP, MySQL, Redis) n'est installe sur Windows — tout est dans des containers.

---

## La Stack

```
Navigateur
    ↓
Nginx (localhost:8080)       → serveur web
    ↓
PHP 8.4 + Laravel 13         → logique de l'application
    ↓           ↓
MySQL 8.0     Redis           → base de donnees / cache
    +
Adminer (localhost:8081)     → interface pour voir la base de donnees
```

---

## Ce qu'on a appris en construisant ca

| Concept | Ou on l'a applique |
|---|---|
| Dockerfile + layers | docker/php/Dockerfile |
| Multi-stage build | Stage builder → stage production |
| Utilisateur non-root | Utilisateur `laravel` dans le container |
| Volumes persistants | Donnees MySQL et Redis survivent aux redemarrages |
| Networks Docker | Les containers se parlent par leur nom (`mysql`, `redis`) |
| Docker Compose | 5 services lances avec une seule commande |
| Variables d'environnement | Mots de passe dans `.env`, jamais dans le code |

---

## Les 3 Commandes a Retenir

```powershell
# Demarrer
docker compose up

# Arreter (conserve les donnees)
docker compose down

# Executer une commande Laravel
docker compose exec php php artisan <commande>
```

---

## Acces

| Adresse | Description |
|---|---|
| http://localhost:8080 | Application Laravel |
| http://localhost:8081 | Adminer — base de donnees |

**Connexion Adminer :** serveur `mysql` / user `laravel_user` / mdp `laravel_pass` / db `laravel_db`

---

## Organisation des Fichiers

```
TEST_DOCKER/
├── docker/              → configuration Docker (Nginx, PHP)
├── src/                 → code Laravel (on travaille ici)
│   └── docs/            → cette documentation
├── docker-compose.yml   → assemble les 5 services
└── .env                 → mots de passe (ne pas mettre sur Git)
```

---

## Ce que ca prouve

Tu es capable de :
- Containeriser une application web complète
- Ecrire un Dockerfile multi-stage propre
- Orchestrer plusieurs services avec Docker Compose
- Appliquer les bonnes pratiques de securite (non-root, secrets en .env)
- Deboguer des erreurs de compatibilite dans un environnement Docker

C'est exactement le niveau attendu en entreprise pour un developpeur qui utilise Docker.
