# Problemes Rencontres et Solutions

## Probleme 1 — Installation Laravel dans le mauvais dossier

**Erreur :** Un dossier `src;c` a ete cree au lieu d'installer dans `src/`

**Cause :** La commande lancee depuis Git Bash avait mal interprete le chemin Windows avec `${PWD}`.

**Solution :** Utiliser le chemin Windows absolu avec PowerShell :
```powershell
# Mauvaise commande (Git Bash)
docker run --rm -v "${PWD}/src:/app" composer create-project laravel/laravel .

# Bonne commande (PowerShell avec chemin absolu)
docker run --rm -v "C:\Users\Administrator\Documents\PROJETS\TEST_DOCKER\src:/app" composer create-project laravel/laravel .
```

---

## Probleme 2 — `oniguruma` manquant dans le Stage 2

**Erreur :**
```
configure: error: Package requirements (oniguruma) were not met
```

**Cause :** Le Stage 2 essayait de recompiler les extensions PHP mais manquait le package `-dev` necessaire a la compilation.

**Solution :** Ne pas recompiler dans le Stage 2. Copier les extensions deja compilees depuis le Stage 1 :
```dockerfile
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
```

---

## Probleme 3 — `autoconf` manquant pour PECL

**Erreur :**
```
Cannot find autoconf. Please check your autoconf installation
ERROR: `phpize' failed
```

**Cause :** `docker-php-ext-install` supprime ses outils de compilation a la fin. Quand `pecl install redis` s'execute apres, `autoconf` a disparu.

**Solution :** Utiliser le script `install-php-extensions` qui gere tout ca automatiquement :
```dockerfile
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd xml redis
```

---

## Probleme 4 — Telechargement Redis incomplet

**Erreur :**
```
ERROR: unable to unpack /tmp/pear/download/redis-6.3.0.tgz
```

**Cause :** Coupure reseau pendant le telechargement (78% seulement).

**Solution :** Le script `install-php-extensions` (probleme 3) a aussi resolu celui-ci.

---

## Probleme 5 — PHP 8.3 vs PHP 8.4

**Erreur :**
```
symfony/console v8.0.9 requires php >=8.4 -> your php version (8.3.30) does not satisfy that requirement
```

**Cause :** Le container Composer qui a installe Laravel utilisait PHP 8.4. Le `composer.lock` generé exigeait PHP 8.4. Notre Dockerfile utilisait PHP 8.3.

**Solution :** Mettre a jour le Dockerfile :
```dockerfile
FROM php:8.4-fpm-alpine AS builder  # 8.3 → 8.4
FROM php:8.4-fpm-alpine             # idem pour le stage production
```

---

## Probleme 6 — Permissions sur le dossier storage

**Erreur :**
```
tempnam(): file created in the system's temporary directory
```

**Cause :** L'utilisateur `laravel` (non-root) n'avait pas les droits d'ecriture sur `storage/` pour compiler les templates Blade.

**Solution :** Fixer les permissions depuis le container en root :
```powershell
docker compose exec -u root php chmod -R 777 storage bootstrap/cache
```

Et dans le Dockerfile (permanent) :
```dockerfile
RUN chown -R laravel:laravel storage bootstrap/cache
```

---

## Probleme 7 — Extensions GD et Redis non chargees

**Erreur dans les logs :**
```
Unable to load dynamic library 'gd' - libavif.so.16: No such file or directory
Unable to load dynamic library 'redis.so' - liblz4.so.1: No such file or directory
```

**Cause :** Les extensions ont ete compilees dans le Stage 1 avec certaines librairies. Ces librairies runtime n'etaient pas installees dans le Stage 2 (production).

**Solution :** Ajouter les librairies manquantes dans le Stage 2 :
```dockerfile
RUN apk add --no-cache \
    libpng libjpeg-turbo oniguruma libxml2 \
    lz4-libs \   # pour redis.so
    libavif      # pour gd.so
```
