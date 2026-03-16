# ChatViz 📱

**Analyseur de Conversations WhatsApp avec Verdict IA**

ChatViz est une application web (SaaS) conçue pour analyser les fichiers d'exportation de discussions WhatsApp (`_chat.txt`). Elle offre un tableau de bord interactif affichant des statistiques précises sur vos relations numériques, complété par un verdict humoristique généré par une Intelligence Artificielle.

## ⚙️ Concept et Workflow

1.  **Authentification** : Créez un compte sécurisé.
2.  **Importation** : Glissez-déposez votre fichier `_chat.txt`.
3.  **Analyse locale** : Le fichier est lu et analysé instantanément dans votre navigateur.
4.  **Verdict IA** : Générez un résumé sarcastique ou analytique basé sur les statistiques.
5.  **Sauvegarde** : Enregistrez vos analyses pour les consulter plus tard.

## 🛡️ Privacy by Design (RGPD)

La sécurité est au cœur de ChatViz. Le fichier `_chat.txt` **ne quitte jamais votre ordinateur**. 
- Le traitement du texte brut se fait exclusivement côté client (JavaScript).
- Seules les données mathématiques anonymisées sont envoyées au serveur pour le verdict IA et le stockage.
- Aucun message privé n'est jamais enregistré sur nos serveurs.

## 🏗️ Architecture Technique

- **Framework** : Laravel 11
- **Front-End** : JavaScript (Analyse Regex & Graphiques)
- **Base de données** : MySQL (Stockage JSON)
- **Infrastructure** : Docker (Laravel Sail)
- **IA** : API Mistral ou OpenAI

## 🚀 Installation

### Prérequis
- Docker Desktop

### Lancement du projet
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/Nicolas-77950/ChatViz.git
   cd ChatViz
   ```

2. Installez les dépendances (si nécessaire) :
   ```bash
   composer install
   ```

3. Démarrez l'environnement via Laravel Sail :
   ```bash
   ./vendor/bin/sail up -d
   ```

4. Exécutez les migrations :
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

L'application est maintenant disponible sur [http://localhost](http://localhost).

## 🛠️ Commandes utiles

- Arrêter les conteneurs : `./vendor/bin/sail stop`
- Accès au terminal artisan : `./vendor/bin/sail artisan`
- Installer les dépendances JS : `./vendor/bin/sail npm install`
- Lancer Vite : `./vendor/bin/sail npm run dev`
