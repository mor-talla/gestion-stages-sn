# 🎓 Gestion Stages SN

Plateforme web de gestion de stages au Sénégal développée avec **Laravel 10**.  
Ce projet permet de mettre en relation les étudiants, les entreprises et les administrateurs pour faciliter la recherche et la gestion de stages.

---

## 📌 Fonctionnalités du site

### 👨‍🎓 Pour les étudiants
- Consulter la liste complète des stages disponibles
- Filtrer les stages par **type** et par **ville**
- Voir les détails d’un stage (description, entreprise, durée, rémunération)
- Postuler à un stage en envoyant son **CV** et une **lettre de motivation**
- Suivre l’état de ses candidatures : **En attente**, **Acceptée** ou **Refusée**
- Voir ses statistiques personnelles (nombre de candidatures, taux de réussite)

### 🏢 Pour les entreprises
- Publier des offres de stage
- Modifier ou supprimer ses propres offres
- Consulter la liste des candidatures reçues pour chaque stage
- **Accepter** ou **refuser** les candidats
- Voir ses statistiques (nombre de stages publiés, candidatures reçues)

### 👑 Pour l’administrateur
- Accéder à un **tableau de bord** avec des statistiques globales :
  - Nombre total d’utilisateurs, stages, entreprises, candidatures
  - Répartition des stages par région
  - Évolution des stages sur 12 mois
  - Top 5 des entreprises avec le plus de stages
- Gérer tous les **utilisateurs** (CRUD complet)
- Gérer toutes les **entreprises** (ajout, modification, suppression)
- Gérer tous les **stages** (modération)
- Gérer toutes les **candidatures** (accepter/refuser globalement)

### 🌍 Fonctionnalités géographiques
- Données réelles du Sénégal :
  - **14 régions**
  - **46 départements**
  - **200+ villes**
- Filtrage des stages par localisation

---

## 🛠️ Technologies utilisées

| Catégorie | Technologies |
|-----------|--------------|
| Backend | Laravel 10, PHP 8.2 |
| Frontend | Tailwind CSS, Flowbite, Blade |
| Base de données | MySQL |
| Authentification | Laravel Breeze |
| Graphiques | Chart.js |
| Animations | CSS3, JavaScript vanilla |
| Icônes | Font Awesome 6 |

---

## 🔑 Comptes de test

| Rôle | Email | Mot de passe | Accès |
|------|-------|--------------|-------|
| Administrateur | `dabo@isi.sn` | `dabo123` | Gestion totale du site |
| Étudiant | `dabo.etudiant@isi.sn` | `dabo123` | Consulter et postuler aux stages |
| Étudiant | `baba@isi.sn` | `password` | Consulter et postuler aux stages |
| Étudiant | `anta@isi.sn` | `password` | Consulter et postuler aux stages |
| Entreprise | `contact@sonatel.sn` | `sonatel123` | Publier des stages et gérer les candidatures |

---

## 🧭 Accès aux différentes pages

| Page | URL |
|------|-----|
| **Page d'accueil** | `/` |
| **Liste des stages** | `/stages` |
| **Liste des entreprises** | `/entreprises` |
| **Dashboard Administrateur** | `/admin/dashboard` |
| **Gestion des utilisateurs** | `/admin/users` |
| **Gestion des entreprises** | `/admin/entreprises` |
| **Gestion des stages** | `/admin/stages` |
| **Gestion des candidatures** | `/admin/candidatures` |
| **Mes candidatures** (étudiant) | `/candidatures` |
| **Mon profil** | `/profile` |

---

## 📁 Structure du projet
