# Documentation du Projet Laravel + Docker

## Structure de la documentation

| Fichier | Contenu |
|---|---|
| [01-architecture.md](01-architecture.md) | La stack technique et pourquoi ces choix |
| [02-creation.md](02-creation.md) | Comment le projet a ete cree de zero |
| [03-problemes-rencontres.md](03-problemes-rencontres.md) | Les erreurs qu'on a eues et comment on les a resolues |
| [04-commandes.md](04-commandes.md) | Toutes les commandes pour travailler au quotidien |
| [05-scenario-application.md](05-scenario-application.md) | Scenario et fonctionnement de l'application de reservation |
| [06-plan-developpement.md](06-plan-developpement.md) | Plan de developpement, workflow equipe, CI/CD et GitHub |

## Demarrage rapide

```powershell
# Se mettre dans le bon dossier
cd C:\Users\Administrator\Documents\PROJETS\TEST_DOCKER

# Lancer tout l'environnement
docker compose up

# Acceder a l'app
# http://localhost:8080  → Laravel
# http://localhost:8081  → Adminer (base de donnees)
```
