# Configuration de l'environnement de développement PHP

## Prérequis
- XAMPP
- Navigateur web
- Un éditeur de code (VS Code, PHPStorm, etc.)

## Étapes de configuration

### 1. Installation de XAMPP
XAMPP est un environnement de développement local complet qui inclut :
- Apache (serveur web)
- MySQL (base de données)
- PHP
- phpMyAdmin

**Installation :**
- Télécharger la dernière version sur [apachefriends.org](https://www.apachefriends.org/)
- Installer XAMPP sur votre système d'exploitation
- Démarrer les modules Apache et MySQL via le panneau de contrôle

### 2. Configuration de la base de données
- Accéder à phpMyAdmin via `http://localhost/phpmyadmin`
- Créer une nouvelle base de données pour le projet
- Définir les tables et champs nécessaires selon les besoins fonctionnels


### 3. Tests locaux
- Placer le dossier du projet dans `htdocs` de XAMPP
- Accéder au projet via `http://localhost/client_project/`

### 4. Débogage
Outils et méthodes pour résoudre les erreurs :
- Consulter les journaux d'erreur d'Apache
- Utiliser `var_dump()` pour inspecter les variables
- Vérifier les chemins de fichiers
- Corriger les erreurs de syntaxe PHP

