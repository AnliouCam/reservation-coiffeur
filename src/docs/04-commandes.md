# Commandes du Quotidien

## Toujours se mettre dans le bon dossier d'abord

```powershell
cd C:\Users\Administrator\Documents\PROJETS\TEST_DOCKER
```

---

## Demarrer le Projet

```powershell
# Lancer tous les containers (sans rebuild)
docker compose up

# Lancer en arriere-plan (terminal libre)
docker compose up -d

# Lancer ET reconstruire l'image PHP (apres modif du Dockerfile)
docker compose up --build
```

---

## Arreter le Projet

```powershell
# Arreter les containers (les donnees sont conservees)
docker compose down

# Arreter et supprimer les volumes (ATTENTION : efface la base de donnees)
docker compose down -v
```

---

## Verifier l'Etat

```powershell
# Voir les containers qui tournent
docker compose ps

# Voir les logs en temps reel
docker compose logs -f

# Logs d'un seul service
docker compose logs -f php
docker compose logs -f nginx
docker compose logs -f mysql
```

---

## Commandes Laravel (Artisan)

```powershell
# Migrations
docker compose exec php php artisan migrate
docker compose exec php php artisan migrate:rollback
docker compose exec php php artisan migrate:fresh

# Creer des fichiers
docker compose exec php php artisan make:controller UserController
docker compose exec php php artisan make:model Post -m
docker compose exec php php artisan make:migration create_posts_table
docker compose exec php php artisan make:seeder UserSeeder

# Cache
docker compose exec php php artisan cache:clear
docker compose exec php php artisan config:clear
docker compose exec php php artisan route:clear
docker compose exec php php artisan view:clear

# Voir les routes
docker compose exec php php artisan route:list

# Tinker (console interactive Laravel)
docker compose exec php php artisan tinker
```

---

## Commandes Composer

```powershell
# Installer un package
docker compose exec php composer require nom/package

# Mettre a jour les packages
docker compose exec php composer update

# Reinstaller les dependances
docker compose exec php composer install
```

---

## Entrer dans un Container

```powershell
# Entrer dans le container PHP (shell interactif)
docker compose exec php sh

# Entrer dans MySQL
docker compose exec mysql mysql -u laravel_user -p laravel_db
```

---

## Acces aux Interfaces

| URL | Description |
|-----|-------------|
| http://localhost:8080 | Application Laravel |
| http://localhost:8081 | Adminer — interface base de donnees |

**Connexion Adminer :**
- Serveur : `mysql`
- Utilisateur : `laravel_user`
- Mot de passe : `laravel_pass`
- Base de donnees : `laravel_db`

---

## Workflow de Developpement

```
1. docker compose up          → lancer l'environnement
2. Editer les fichiers dans src/ avec VS Code
3. Rafraichir localhost:8080  → les changements sont immediats
4. docker compose down        → arreter quand tu as fini
```

Pas besoin de rebuilder pour les changements de code Laravel.
On rebuild uniquement si on modifie le Dockerfile.
