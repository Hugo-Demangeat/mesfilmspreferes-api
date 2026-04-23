# Mes Films Préférés - API

Une application web Laravel permettant aux utilisateurs de découvrir, gérer et partager leurs films préférés avec leurs amis.

## Description

Cette application est une plateforme sociale centrée sur les films où les utilisateurs peuvent :
- Rechercher des films via l'API TMDB (The Movie Database)
- Ajouter des films à leurs favoris personnels
- Donner des avis sur leurs films favoris
- Gérer une liste d'amis
- Partager des films avec leurs amis
- Consulter les détails complets des films (synopsis, casting, bandes-annonces)

## Fonctionnalités

### Gestion des Utilisateurs
- Inscription et connexion sécurisées
- Profils utilisateurs avec avatars personnalisables
- Mise à jour des informations de profil

### Recherche et Découverte de Films
- Recherche par titre via l'API TMDB
- Affichage des films populaires, à venir, en salle et les mieux notés
- Détails complets des films : synopsis, casting, bandes-annonces YouTube

### Gestion des Favoris
- Ajout/suppression de films aux favoris
- Attribution d'avis personnels sur les films favoris
- Liste personnelle des films favoris

### Réseau Social
- Recherche et ajout d'amis
- Gestion de la liste d'amis (ajout/suppression)
- Partage de films avec les amis
- Consultation des partages reçus

### APIs AJAX
- Recherche d'utilisateurs pour ajouter des amis
- Recherche de films en temps réel
- Recherche d'amis existants
- Catégorisation des films (populaires, à venir, etc.)

## Prérequis

Avant d'installer l'application, assurez-vous d'avoir installé :

- **PHP** >= 8.2
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js** et **npm** (pour la compilation des assets front-end)
- **Serveur web** (Apache/Nginx) ou utiliser le serveur de développement Laravel
- **Base de données** (MySQL, PostgreSQL, SQLite, etc.) - Recommandé : MySQL avec XAMPP

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/Hugo-Demangeat/mesfilmspreferes-api.git
cd mesfilmspreferes-api
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Configuration de l'environnement

Copiez le fichier d'exemple d'environnement :

```bash
cp .env.example .env
```

Modifiez le fichier `.env` pour configurer votre base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mesfilmspreferes
DB_USERNAME=votre_username
DB_PASSWORD=votre_password
```

### 4. Générer la clé d'application

```bash
php artisan key:generate
```

### 5. Migrer la base de données

```bash
php artisan migrate
```

### 6. Installer les dépendances front-end

```bash
npm install
```

### 7. Compiler les assets

Pour le développement :
```bash
npm run dev
```

Pour la production :
```bash
npm run build
```

## Utilisation

### Lancer l'application

Utilisez la commande de développement incluse qui lance plusieurs services :

```bash
composer run dev
```

Ou lancez manuellement :

```bash
# Serveur web
php artisan serve

# Queue des jobs (si nécessaire)
php artisan queue:work

# Logs en temps réel
php artisan pail

# Compilation des assets
npm run dev
```

L'application sera accessible sur `http://localhost:8000`

### Utilisation de base

1. **Inscription/Connexion** : Créez un compte ou connectez-vous
2. **Rechercher des films** : Utilisez la barre de recherche pour trouver des films
3. **Ajouter aux favoris** : Cliquez sur "Ajouter aux favoris" depuis la page de recherche
4. **Gérer les amis** : Recherchez des utilisateurs et ajoutez-les comme amis
5. **Partager des films** : Partagez vos films favoris avec vos amis
6. **Consulter le profil** : Mettez à jour vos informations et uploadez un avatar

## Tests

Lancez les tests avec PHPUnit :

```bash
php artisan test
```

## Structure du Projet

```
app/
├── Http/Controllers/     # Contrôleurs (Film, Favori, Ami, etc.)
├── Models/              # Modèles Eloquent (User, Favori, Partage, etc.)
config/                  # Configuration Laravel

database/
├── migrations/          # Migrations de base de données
├── seeders/            # Seeders pour données de test
public/                  # Assets publics et avatars

resources/
├── views/              # Templates Blade
├── js/                 # JavaScript/Vue.js
├── css/                # Styles CSS

routes/
├── web.php             # Routes de l'application
```

## Technologies Utilisées

- **Laravel 12** : Framework PHP
- **TMDB API** : Base de données de films
- **MySQL** : Base de données
- **Blade** : Moteur de templates
- **Tailwind CSS** : Framework CSS
- **Alpine.js** : Framework JavaScript
- **Vite** : Outil de build front-end

## Auteur

Hugo Demangeat
