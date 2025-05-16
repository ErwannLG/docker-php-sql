# Starter Kit Docker PHP-MySQL

Ce starter kit vous permet de démarrer rapidement un projet PHP avec une base de données MySQL et PHPMyAdmin, le tout conteneurisé avec Docker.

## Prérequis

- **Docker** & **Docker Compose**
  - Pour Windows/Mac : [Docker Desktop](https://www.docker.com/products/docker-desktop/)
  - Vérifiez l'installation avec :
    ```bash
    docker --version
    docker compose version
    ```

## Structure du projet

```
.
├── docker-compose.yml    # Configuration des services Docker
├── Dockerfile           # Configuration de l'image PHP
├── data/               # Dossier contenant les fichiers SQL
│   └── data.sql       # Fichier SQL pour initialiser la base de données
└── src/                # Dossier contenant les fichiers PHP
    └── index.php      # Point d'entrée de l'application
```

## Configuration

Le projet inclut trois services Docker :

1. **PHP (Apache)** : PHP 8.3 avec Apache

   - Accessible sur `http://localhost:8000`
   - Le contenu du dossier `src/` est synchronisé avec le container

2. **MySQL** : Base de données MySQL 8.0

   - Port : 3306
   - Base de données : projet
   - Utilisateur : test
   - Mot de passe : test
   - Root password : root

3. **PHPMyAdmin** : Interface d'administration MySQL
   - Accessible sur `http://localhost:8080`
   - Utilisateur : root
   - Mot de passe : root

## Démarrage rapide

### Première utilisation

1. Clonez ce dépôt :

   ```bash
   git clone [URL_DU_REPO]
   cd [NOM_DU_DOSSIER]
   ```

2. Si vous souhaitez initialiser la base de données, ajoutez vos requêtes SQL dans le fichier `data/data.sql`

3. Construisez l'image PHP avec les extensions nécessaires :

   ```bash
   docker compose build
   ```

4. Lancez les containers :

   ```bash
   docker compose up -d
   ```

5. Accédez à votre application :
   - Application PHP : http://localhost:8000
   - PHPMyAdmin : http://localhost:8080

### Utilisations suivantes

1. Démarrer les containers :

   ```bash
   docker compose up -d
   ```

2. Accédez à votre application comme d'habitude :

   - Application PHP : http://localhost:8000
   - PHPMyAdmin : http://localhost:8080

3. Pour arrêter les containers :
   ```bash
   docker compose down
   ```

> **Note** : Si vous modifiez le fichier `data.sql` après la première utilisation et que vous souhaitez réinitialiser la base de données, vous devrez supprimer les volumes Docker. Voici la commande :
>
> ```bash
> docker compose down -v  # Arrête les containers et supprime les volumes
> docker compose up -d    # Redémarre les containers et réinitialise la base de données
> ```

## Base de données

- La base de données `projet` est automatiquement créée au démarrage des containers
- Un fichier `data.sql` vide est fourni dans le dossier `data/`. Vous pouvez le remplacer par votre propre fichier SQL contenant vos tables et données. Ce fichier sera automatiquement exécuté lors de la première initialisation de la base de données
- Cette fonctionnalité est configurée dans le `docker-compose.yml` grâce à la ligne :
  ```yaml
  volumes:
    - './data:/docker-entrypoint-initdb.d'
  ```
- Pour initialiser votre base de données :
  1. Copiez vos requêtes SQL dans le fichier `data/data.sql`
  2. Si les containers sont déjà en cours d'exécution, relancez-les avec :
     ```bash
     docker compose down
     docker compose up -d
     ```
- Les données sont persistantes entre les redémarrages des containers, donc le script `data.sql` ne sera exécuté qu'à la première initialisation

## Développement

1. Placez vos fichiers PHP dans le dossier `src/`
2. Les modifications sont automatiquement prises en compte grâce au montage du volume
3. Pour les modifications de la base de données :
   - Utilisez PHPMyAdmin (http://localhost:8080)
   - Ou modifiez directement le fichier `data/data.sql`

## Commandes utiles

```bash
# Démarrer les containers
docker compose up -d

# Arrêter les containers
docker compose down
```

## Extensions PHP installées

- mysqli
- pdo
- pdo_mysql

## Personnalisation

- Modifier les ports dans `docker-compose.yml` si nécessaire
- Ajouter des extensions PHP dans le `Dockerfile`
- Modifier les credentials de la base de données dans `docker-compose.yml`
