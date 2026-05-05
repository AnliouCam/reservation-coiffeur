# Scenario de l'Application — Plateforme de Reservation Coiffeur

## Description

Application web de reservation en ligne pour un salon de coiffure.
Le client reserve un creneau depuis son navigateur, l'admin gere les reservations depuis un tableau de bord.

---

## Cote Client

```
1. Le client arrive sur la page d'accueil
   → Il voit le nom du salon, les services proposes et les tarifs

2. Il clique sur "Reserver"
   → Il choisit un service (coupe homme, coupe femme, barbe...)
   → Il choisit une date sur un calendrier
   → Il voit les creneaux disponibles ce jour-la (ex: 9h, 10h, 11h...)
   → Il clique sur un creneau

3. Il remplit le formulaire
   → Nom, Prenom, Email, Telephone

4. Il confirme
   → Page de confirmation avec recapitulatif
   → Email de confirmation envoye (optionnel)
```

---

## Cote Admin

```
1. L'admin se connecte (email + mot de passe)
   → Tableau de bord avec les reservations du jour

2. Il peut voir toutes les reservations
   → Filtrees par date, par service, par statut

3. Il peut gerer les creneaux
   → Definir les horaires d'ouverture
   → Bloquer des creneaux (conges, indisponibilite)

4. Il peut changer le statut d'une reservation
   → En attente / Confirmee / Annulee
```

---

## Les Donnees (Modeles)

| Modele      | Champs principaux                              |
|-------------|------------------------------------------------|
| Service     | nom, duree (minutes), prix                     |
| Creneau     | date, heure, disponible (booleen)              |
| Reservation | client_nom, client_email, client_telephone, creneau_id, service_id, statut |
| User        | name, email, password (admin uniquement)       |

---

## Statuts d'une Reservation

```
En attente → Confirmee → Annulee
```

---

## Pages de l'Application

| Page                  | URL                  | Acces  |
|-----------------------|----------------------|--------|
| Accueil               | /                    | Public |
| Choisir un service    | /reserver            | Public |
| Choisir un creneau    | /reserver/creneaux   | Public |
| Formulaire client     | /reserver/formulaire | Public |
| Confirmation          | /reserver/confirmation | Public |
| Login admin           | /admin/login         | Public |
| Tableau de bord admin | /admin               | Admin  |
| Liste reservations    | /admin/reservations  | Admin  |
| Gestion creneaux      | /admin/creneaux      | Admin  |
