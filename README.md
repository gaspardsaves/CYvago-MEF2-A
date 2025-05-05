# CYvago-MEF2-A

**Projet :earth_africa: ClickjourneY, deuxième année de pré-ingénieur CY-Tech, semestre 2 2024-2025**

## :handshake: Collaborateurs :
**- [Mathilde Nelva-Pasqual](https://github.com/mathildenelva)**  
**- [Jean-Luc Maslanka](https://github.com/JEAN-LUC7)**  
**- [Gaspard Savès](https://github.com/gaspardsaves)**  

## Description du projet :
[:scroll: Lire le sujet et le cahier des charges du projet](Projet_Click_journeY_v1.3_PHASE3-1.pdf)  
[:credit_card: Lire la documentation sur l'interface de paiement](Projet_Click_journeY_preing2_2024_2025_CYBANK_v1.1-1.pdf)  
[:ledger: Lire le rapport de réalisation du projet](rapport-projet-click-journey-mef2-a.pdf)  
[:pushpin: Lire la charte graphique du projet](charte-graphique-click-journey-mef2-a.pdf)  
[:memo: Lire le carnet de bord des collaborateurs](carnet-de-bord.txt)   

**ZanimoTrip** est le site web d'une agence de voyage spécialisée dans les voyages de découverte de la faune sauvage.

## Utilisation du site web :
Un fichier [zanimotrip.sql](zanimotrip.sql) est présent et peut être importé sur votre machine afin de recréer la structure de la base de données afin d'utiliser le site web.  
**Un fichier [exampleconfig.php](exampleconfig.php) est présent dans le dépot il est à personnaliser en fonction de la configuration de votre machine et il conviendra de le renommer [config.php](config.php) afin qu'il soit bien inclus dans [database.php](database.php).**   

Les deux utilisateurs administrateurs sont donnés par les identifiants suivants :  
- Mail : gs@gmail.com         Mdp : azerty  
- Mail : maslankaje@cytech.fr Mdp : Jas12345  

Les autres sont donnés par les identifiants suivants :  
- Mail : AS@gmai.com           Mdp : hot  
- Mail : DonaldTrump@gmail.com Mdp : qwerty  
- Mail : TB@gmail.com          Mdp : carrefour  

## Structure du projet :

### Répertoires :
- Le répertoire [css](css/) contient les différentes feuilles de style  
- Le répertoire [favicon](favicon/) contient tous les favicons du site dans tous les formats nécessaires aux différents usages et aux différents systèmes d'exploitation  
- Le répertoire [img](img/) contient toutes les images du site web  
- Le répertoire [legal](legal/) contient les Mentions Légales, la Politique de Confidentialité, les Conditions Générales d'Utilisation et les Conditions Générales de Vente  

### A la racine :
[accueil.php](accueil.php) est la page d'accueil du site web, elle est accessible depuis n'importe quelle autre page en cliquant sur le logo ZanimoTrip  
[administrateur.php](administrateur.php) est la page permettant de voir la liste des utilisateurs afin de pouvoir, le cas échéant les bannir ou les faire profiter du programme VIP  
[carnet-de-bord.txt](carnet-de-bord.txt) est le fichier de suivi des collaborateurs, il nous permet de suivre le travail menés par les autres.  
[clipZanimoTrip.mp4](clipZanimoTrip.mp4) est le clip présent sur la page d'accueil  
[connexion.php](connexion.php) est la page de connexion des utilisateurs  
[inscription.php](inscription.php) est la page d'inscription des nouveaux utilisateurs  
[monCompte.php](monCompte.php) est la page permettant d'avoir accès à ses informations personnelles  
[presentation.php](presentation.php) est une présentation du site ZanimoTrip  
[Projet_Click_journeY_v1.1_PHASE1.pdf](Projet_Click_journeY_v1.1_PHASE1.pdf) est le sujet du projet  
[recherche.php](recherche.php) est la page permettant de rechercher différents séjours   
[sejours.php](sejours.php) est la page permettant de découvrir et trier les différents séjours  

### Dans le répertoire CSS :
[accueil.css](css/accueil.css) est la feuille de style de la page [accueil.php](accueil.php)  
[administrateur.css](css/administrateur.css) est la feuille de style de la page [administrateur.php](administrateur.php)  
[def.css](css/def.css) est la feuille de style générale contenant la police de caractère utilisée, les variables de couleur définies ainsi qu'une transition d'écriture  
[designSite.css](css/designSite.css) est la feuille de style contenant la barre de navigation, la barre de recherche ainsi que le pied de page et plus généralement l'ensemble des paramétres graphiques communs à chaque page.  
[formulaire.css](css/formulaire.css) est la feuille de style des page [connexion.php](connexion.php) et [inscription.php](inscription.php)  
[legal.css](css/legal.css) est la feuille de style des page [mentions-legales.php](legal/mentions-legales.php), [confidentialite.php](legal/confidentialite.php), [cgu.php](legal/cgu.php) et [cgv.php](legal/cgv.php)  
[monCompte.css](css/monCompte.css) est la feuille de style de la page [monCompte.php](monCompte.php)  
[presentation.css](css/presentation.css) est la feuille de style de la page [presentation.php](presentation.php)  
[sejours.css](css/sejours.css) est la feuille de style de la page [sejours.php](sejours.php)  