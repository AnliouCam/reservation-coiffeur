# Plan de Developpement — Workflow Equipe

## Vue d'ensemble

On developpe l'application comme une vraie equipe :
- Chaque fonctionnalite = une branche `feature/xxx`
- Chaque branche = une Pull Request vers `dev`
- `dev` stable → PR vers `main` (mise en prod)
- GitHub Actions bloque les PR si les tests echouent

---

## Phase 1 — GitHub Setup

- [ ] Creer le repo GitHub
- [ ] Pousser le projet existant
- [ ] Creer la branche `dev` depuis `main`
- [ ] Proteger `main` : PR obligatoire, push direct interdit
- [ ] Proteger `dev` : PR obligatoire, push direct interdit
- [ ] Ajouter un template de Pull Request

### Regles de nommage des branches

| Type      | Format                  | Exemple                    |
|-----------|-------------------------|----------------------------|
| Fonctionnalite | `feature/nom`      | `feature/booking-form`     |
| Correction     | `fix/nom`          | `fix/slot-availability`    |
| Hotfix prod    | `hotfix/nom`       | `hotfix/email-not-sent`    |

---

## Phase 2 — CI/CD avec GitHub Actions

Pipeline declenche automatiquement sur chaque Pull Request.

```
Push sur feature/xxx
       ↓
Ouverture d'une PR vers dev
       ↓
GitHub Actions se declenche
       ↓
1. Installation des dependances (composer install)
2. Copie du .env de test
3. Generation de la cle app
4. Execution des migrations (base SQLite en memoire)
5. Lancement des tests PHPUnit
       ↓
✔ Tests passes → PR peut etre mergee
✘ Tests echoues → PR bloquee
```

Fichier : `.github/workflows/ci.yml`

```yaml
name: CI

on:
  pull_request:
    branches: [main, dev]

jobs:
  test:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.4'
          extensions: pdo, pdo_sqlite, mbstring, xml, bcmath

      - name: Installer les dependances
        run: composer install --no-interaction --prefer-dist

      - name: Configurer l'environnement de test
        run: |
          cp .env.example .env.testing
          php artisan key:generate --env=testing

      - name: Lancer les tests
        run: php artisan test --env=testing
```

---

## Phase 3 — Developpement par Features

Ordre de developpement :

| # | Feature                        | Branche                   |
|---|--------------------------------|---------------------------|
| 1 | Migrations base de donnees     | `feature/database`        |
| 2 | Liste des services             | `feature/services`        |
| 3 | Affichage des creneaux         | `feature/slots`           |
| 4 | Formulaire de reservation      | `feature/booking-form`    |
| 5 | Page de confirmation           | `feature/confirmation`    |
| 6 | Authentification admin         | `feature/admin-auth`      |
| 7 | Tableau de bord admin          | `feature/admin-dashboard` |
| 8 | Gestion des creneaux (admin)   | `feature/admin-slots`     |

### Workflow pour chaque feature

```powershell
# 1. Partir toujours de dev a jour
git checkout dev
git pull origin dev

# 2. Creer la branche feature
git checkout -b feature/nom-de-la-feature

# 3. Coder + commiter regulierement
git add .
git commit -m "feat: description du changement"

# 4. Pousser la branche
git push origin feature/nom-de-la-feature

# 5. Ouvrir une Pull Request vers dev sur GitHub
# 6. Attendre que GitHub Actions passe (tests verts)
# 7. Merger la PR
# 8. Supprimer la branche feature
```

---

## Phase 4 — Merge Final vers Main

Quand toutes les features sont mergees dans `dev` et validees :

```
PR : dev → main
     ↓
GitHub Actions tourne une derniere fois
     ↓
Review du code
     ↓
Merge → "mise en production"
```

---

## Conventions de Commits

Format : `type: description courte`

| Type     | Usage                              |
|----------|------------------------------------|
| `feat`   | Nouvelle fonctionnalite            |
| `fix`    | Correction de bug                  |
| `test`   | Ajout ou modification de tests     |
| `refactor` | Refactoring sans nouveau comportement |
| `docs`   | Documentation uniquement           |
| `chore`  | Config, outils, dependances        |

Exemples :
```
feat: ajouter le formulaire de reservation
fix: corriger la disponibilite des creneaux
test: ajouter tests unitaires pour le modele Reservation
docs: mettre a jour le plan de developpement
```
