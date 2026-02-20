Structure Logique (Diagramme)
User
- id
- name
- email
- password
- role (admin, formateur, apprenant)

Formation
- id
- titre
- description
- formateur_id
- statut

Module
- id
- titre
- formation_id

Contenu
- id
- titre
- type
- module_id

Ressource
- id
- fichier
- contenu_id

Inscription
- id
- user_id
- formation_id

Evaluation
- id
- note
- commentaire
- inscription_id


Plateforme de Gestion de Formations

Projet Laravel API + Application Flutter

Présentation

Cette application est une plateforme e-learning permettant de gérer des formations en ligne avec trois rôles :

Administrateur → gère la plateforme

Formateur → crée le contenu pédagogique

Apprenant → suit les formations

Le back-end est développé avec Laravel (API REST) et le front-end mobile avec Flutter.

Architecture du Projet
Technologie	Rôle
Laravel 12	API REST & logique métier
MySQL	Base de données
Flutter	Application mobile
Sanctum / Token API	Authentification
JSON	Communication API



Analyse des Acteurs et Cas d’Utilisation
1. ADMIN — Gestionnaire du Système

L’admin ne crée pas le contenu pédagogique, il administre la plateforme.

Fonctionnalités :

Créer / gérer les utilisateurs (formateurs, apprenants)

Créer les formations (structure globale)

Affecter un formateur à une formation

Activer / désactiver une formation

Suivre les statistiques

Gérer les inscriptions

Modérer les évaluations et messages

2. FORMATEUR — Créateur de Contenu

Le formateur ne crée pas la formation, il construit le contenu.

Fonctionnalités :

Créer des modules

Ajouter des contenus pédagogiques

Ajouter des ressources (PDF, vidéos…)

Suivre les apprenants inscrits

Répondre aux messages

Consulter les évaluations

3. APPRENANT — Utilisateur de la Formation

L’apprenant ne crée rien.

Fonctionnalités :

S’inscrire à une formation

Consulter les modules et contenus

Télécharger les ressources

Envoyer des messages

Donner une évaluation

Suivre sa progression

MCD — Modèle Conceptuel de Données
Entités Principales

User

Formation

Module

Contenu

Ressource

Inscription

Evaluation

Message

Relations

Un Formateur est affecté à plusieurs Formations

Une Formation contient plusieurs Modules

Un Module contient plusieurs Contenus

Un Contenu peut avoir plusieurs Ressources

Un Apprenant peut s’inscrire à plusieurs Formations

Une Inscription relie Apprenant ↔ Formation

Une Evaluation appartient à une Inscription
 Structure Logique (Diagramme de Classe Simplifié)
User
- id
- name
- email
- password
- role (admin, formateur, apprenant)

Formation
- id
- titre
- description
- formateur_id
- statut

Module
- id
- titre
- formation_id

Contenu
- id
- titre
- type
- module_id

Ressource
- id
- fichier
- contenu_id

Inscription
- id
- user_id
- formation_id

Evaluation
- id
- note
- commentaire
- inscription_id
Connexion Flutter ↔ Laravel (API)

L’application Flutter communique avec Laravel via API sécurisée.

 Authentification API
Méthode	Route	Description
POST	/api/register	Inscription
POST	/api/login	Connexion
GET	/api/formations	Liste formations
POST	/api/inscriptions	S’inscrire
GET	/api/modules/{id}	Voir contenu
📱 Exemple de Login Flutter
final response = await http.post(
  Uri.parse("http://10.0.2.2:8000/api/login"),
  body: {
    "email": email,
    "password": password
  },
);

final token = jsonDecode(response.body)['token'];

Utilisation du token :

headers: {
  "Authorization": "Bearer $token",
  "Accept": "application/json"
}
⚙️ Installation du Projet Laravel
git clone projet.git
cd projet

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan serve
Lancer Flutter
cd flutter_app
flutter pub get
flutter run
Objectif du Projet

Ce projet met en pratique :
 (Acteurs, MCD)

Architecture API REST

Laravel comme Back-End

Flutter comme Client Mobile

Authentification par Token

Gestion complète d’une plateforme de formation

✅ Résultat

Une plateforme moderne permettant :

✔ Gestion centralisée des formations
✔ Séparation claire des rôles (Admin / Formateur / Apprenant)
✔ Accès mobile via Flutter
✔ Architecture professionnelle basée sur API

Si tu veux maintenant, je peux aussi t’ajouter :

le MLD (tables SQL exactes)

les routes API documentées

ou vérifier que ça correspond exactement à tes Models Laravel.