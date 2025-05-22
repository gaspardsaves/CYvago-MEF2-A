# 🐫 CYvago-MEF2-A

**Projet ClickjourneY 🌍 — Deuxième année de pré-ingénieur CY Tech, Semestre 2 (2024–2025)**

## 🤝 Collaborateurs
- [Mathilde Nelva-Pasqual](https://github.com/mathildenelva)  
- [Jean-Luc Maslanka](https://github.com/JEAN-LUC7)  
- [Gaspard Savès](https://github.com/gaspardsaves)

## 📄 Documentation du projet
- [:scroll: Cahier des charges](Projet_Click_journeY_v1.4_PHASE4.pdf)  
- [:credit_card: Interface de paiement CYBank](Projet_Click_journeY_preing2_2024_2025_CYBANK_v1.1-1.pdf)  
- [:ledger: Rapport de projet](rapport-projet-click-journey-mef2-a.pdf)  
- [:pushpin: Charte graphique](charte-graphique-click-journey-mef2-a.pdf)  
- [:memo: Carnet de bord](carnet-de-bord.txt)

## 🐾 Description du projet

**ZanimoTrip** est un site web développé pour une agence de voyage fictive spécialisée dans les séjours centrés sur la découverte de la faune sauvage.

Les utilisateurs peuvent :
- Créer un compte,
- Explorer, rechercher et trier les séjours,
- Gérer leurs informations personnelles,
- Se connecter à une interface administrateur pour la gestion des comptes.

## 💻 Utilisation du site web

1. **Configuration de la base de données** :
   - Importez le fichier [`zanimotrip.sql`](zanimotrip.sql) dans votre système de gestion de base de données pour initialiser la structure et les données.
   
2. **Configuration du site** :
   - Renommez le fichier [`exampleconfig.php`](exampleconfig.php) en `config.php` et adaptez-le à votre environnement local. Ce fichier est inclus automatiquement dans [`database.php`](database.php) qui gère les requêtes SQL.

3. **Comptes de démonstration** :

| Rôle            | Adresse e-mail             | Mot de passe |
|-----------------|----------------------------|--------------|
| Admin           | gs@gmail.com               | azerty       |
| Admin           | maslankaje@cy-tech.fr      | dinopolska   |
| Utilisateur     | as@gmail.com               | hot          |
| Utilisateur     | dt@gmail.com               | qwerty       |
| Utilisateur     | tb@gmail.com               | carrefour    |
| Utilisateur VIP | saves.gaspard@gmail.com    | azerty       |
| Utilisateur     | iv@gmail.com               | qsdfghjk     |


## 📁 Structure du projet

```bash
CYvago-MEF2-A/
│
├── css/                      # Feuilles de style CSS
│   ├── accueil.css           # Styles de la page d'accueil
│   ├── administrateur.css    # Styles du panneau d'administration
│   ├── confirmation.css      # Styles de la page de confirmation du séjour
│   ├── def.css               # Définitions des variables CSS (couleurs, polices, transitions)
│   ├── designSite.css        # Styles communs à tout le site (mise en page, header, footer)
│   ├── detail.css            # Styles pour la page détaillée des séjours
│   ├── echecpaiement.css     # Styles de la page d'échec de paiement
│   ├── formulaire.css        # Styles pour les formulaires (connexion, inscription)
│   ├── legal.css             # Styles pour les pages légales
│   ├── mesreservations.css   # Styles pour la page d'historique des réservations
│   ├── mode-clair.css        # Styles pour le thème clair (dark/light mode)
│   ├── monCompte.css         # Styles pour la page de profil utilisateur
│   ├── paiement-redirect.css # Styles de la page de redirection
│   ├── paiement.css          # Style de la page permettant de refaire un paiement lorsqu'il a échoué
│   ├── panier.css            # Styles pour le panier d'achat
│   ├── personnalisation.css  # Styles pour la page de personnalisation des voyages
│   ├── presentation.css      # Styles pour la page de présentation de l'agence
│   ├── recapvoyage.css       # Styles pour la page de récapitulatif du voyage
│   └── sejours.css           # Styles pour la liste des séjours
│
├── favicon/                  # Fichiers favicon pour navigateurs et systèmes
│
├── img/                      # Images du site (photos, illustrations, logos)
│   ├── footer/               # Images utilisées dans le pied de page
│   ├── trav/                 # Images des destinations de voyage
│   └── ...                   # Autres images utilisées sur le site
│   
│
├── js/                       # Fichiers JavaScript
│   ├── administrateur.js              # Fonctionnalités du panneau administrateur
│   ├── formValidation.js     # Validation des formulaires côté client
│   ├── mode.js               # Gestion du changement de thème clair/sombre
│   ├── moncompte.js          # Fonctionnalités interactives de la page profil
│   ├── paiement-redirect.js  # Redirection vers la page de paiement
│   ├── tri.js                # Filtrage et tri des séjours sur la page séjours
│   └── updateprice.js        # Mise à jour dynamique des prix selon les options
│
├── phpFrequent/              # Composants PHP réutilisables
│   ├── footer.php            # Pied de page commun à toutes les pages
│   ├── navbar.php            # Barre de navigation principale
│   └── searchbar.php         # Barre de recherche commune à toutes les pages
│
├── exampleconfig.php         # Modèle de configuration pour la base de données
│
├── structure-database.svg    # Schéma visuel de la base de données
├── zanimotrip.sql            # Script SQL pour initialiser la base de données
│
├── Projet_Click_journeY_v1.4_PHASE4.pdf          # Cahier des charges du projet
├── Projet_Click_journeY_preing2_2024_2025_CYBANK_v1.1-1.pdf # Documentation API paiement
├── rapport-projet-click-journey-mef2-a.pdf         # Rapport technique du projet
├── charte-graphique-click-journey-mef2-a.pdf       # Charte graphique du site
├── carnet-de-bord.txt                              # Journal de développement
├── clipZanimoTrip.mp4                              # Vidéo promotionnelle
│
├── accueil.php               # Page d'accueil
├── admin_update.php          # Mise à jour du statut de l'utilisateur dans la base de données
├── administrateur.php        # Interface administrateur (gestion des utilisateurs)
├── bannis.php                # Page de bannissement
├── cancelbooking.php         # Permet l'annulation d'une réservation
├── cgu.php                   # Conditions générales d'utilisation
├── cgv.php                   # Conditions générales de vente
├── confidentialite.php       # Politique de confidentialité
├── confirmation.php          # Page de confirmation du séjour
├── connexion.php             # Page de connexion utilisateur
├── database.php              # Centralisation des connexions à la base de données
├── detail.php                # Affichage détaillé d'un séjour avec options
├── echecpaiement.php         # Page d'échec de paiement du séjour
├── getapikey.php             # API pour code de paiement CYBank
├── inscription.php           # Formulaire d'inscription utilisateur
├── logout.php                # Script de déconnexion utilisateur
├── mentions-legales.php      # Mentions légales du site
├── mesreservations.php      # Permet de voir l'historique des voyages du client
├── moncompte.php             # Gestion du profil et historique des réservations
├── newaccount.php            # Création d'un nouveau compte après inscription
├── paiement-redirect.php     # Page de redirection du paiement
├── paiement.php              # Permet de refaire le paiement lorsqu'il a été refusé
├── parametre.php             # Page de paramètre utilisateur (thème, préférences)
├── pasadmin.php              # Page pour signaler à un utilisateur qu'il n'a pas le droit d'accéder à une page
├── presentation.php          # Page de présentation de l'agence ZanimoTrip
├── recapvoyage.php           # Page de récapitulatif du voyage
├── retourpaiement.php        # Page de retour après paiement (succès/échec)
├── sejours.php               # Catalogue des séjours avec filtres
├── session.php               # Gestion des sessions utilisateur
├── update_profile.php        # Mise à jour des informations de profil
└── verifconnexion.php        # Vérification des identifiants de connexion
```

## Schéma de base de données

![Schéma de la base de données](structure-database.svg)