# 🦁 CYvago-MEF2-A

**Projet ClickjourneY 🌍 — Deuxième année de pré-ingénieur CY Tech, Semestre 2 (2024–2025)**

## 🤝 Collaborateurs
- [Mathilde Nelva-Pasqual](https://github.com/mathildenelva)  
- [Jean-Luc Maslanka](https://github.com/JEAN-LUC7)  
- [Gaspard Savès](https://github.com/gaspardsaves)

## 📄 Documentation du projet
- [:scroll: Cahier des charges](Projet_Click_journeY_v1.3_PHASE3-1.pdf)  
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

| Rôle          | Adresse e-mail             | Mot de passe |
|---------------|----------------------------|--------------|
| Admin         | gs@gmail.com               | azerty       |
| Admin         | maslankaje@cytech.fr       | Jas12345     |
| Utilisateur   | AS@gmail.com               | hot          |
| Utilisateur   | DonaldTrump@gmail.com      | qwerty       |
| Utilisateur   | TB@gmail.com               | carrefour    |

---

## 📁 Structure du projet

```bash
CYvago-MEF2-A/
│
├── css/                     # Feuilles de style CSS
│   ├── accueil.css
│   ├── administrateur.css
│   ├── def.css
│   ├── designSite.css
│   ├── formulaire.css
│   ├── legal.css
│   ├── monCompte.css
│   ├── presentation.css
│   └── sejours.css
│
├── favicon/                # Fichiers favicon pour navigateurs et systèmes
│
├── img/                    # Images du site (photos, illustrations, logos)
│
├── legal/                  # Pages légales
│   ├── mentions-legales.php
│   ├── confidentialite.php
│   ├── cgu.php
│   └── cgv.php
│
├── clipZanimoTrip.mp4      # Vidéo d’introduction sur la page d’accueil
│
├── zanimotrip.sql          # Script SQL pour recréer la base de données
│
├── exampleconfig.php       # Fichier de configuration à adapter (à renommer en config.php)
│
├── carnet-de-bord.txt      # Journal de bord des contributeurs
│
├── Projet_Click_journeY_v1.3_PHASE3-1.pdf         # Cahier des charges du projet
├── Projet_Click_journeY_preing2_2024_2025_CYBANK_v1.1-1.pdf  # Interface de paiement
├── rapport-projet-click-journey-mef2-a.pdf        # Rapport de projet
├── charte-graphique-click-journey-mef2-a.pdf      # Charte graphique
│
├── accueil.php              # Page d’accueil
├── administrateur.php       # Interface admin (ban, VIP)
├── connexion.php            # Connexion utilisateur
├── inscription.php          # Inscription utilisateur
├── monCompte.php            # Page de gestion des infos personnelles
├── presentation.php         # Présentation de l’agence
└── sejours.php              # Liste des séjours
```