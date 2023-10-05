# Popcorner

# Entités

## Entité Member

### Propriétés
- `nickname` **`[string:255]`** : pseudo du membre
- `description` **`[text]`** : description du membre
- `role` **`[TBD]`** : role du membre
- `library` **`[relation:OneToOne]`** : bibliothèque de l'utilisateur


## Entité Library

### Propriétés
- `description` **`[text]`** : description de la bibliothèque
- `movies` **`[relation:OneToMany]`** : films contenus dans la bibliothèque de l'utilisateur
- `member` **`[relation:OneToOne]`** : utilisateur propriétaire de la bibliothèque

## Entité Movie
Un objet représentant un film que l'utilisateur a éventuellement vu

### Propriétés
- `title` **`[string:255]`** : titre officiel du film
- `year` **`[smallint]`** : année de sortie du film
- `imdbId` **`[integer]`** : identifiant du film sur la base de donnée IMDB
- `watched` **`[boolean]`** : l'utilisateur a-t-il regardé le film
- `rating` **`[smallint]`** : note de l'utilisateur sur le film
- `review` **`[text]`** : critique du film par l'utilisateur
- `library` **`[relation:ManyToOne]`** : bibliothèque dans laquelle se trouve le film


## Entité Playlist
L'utilisateur peut créer des collections de ses films selon ses envies. Une collection peut être les films préférées d'un utilisateur, ou une liste de recommandations pour un genre en particulier.

### Propriétés
- `name` **`[string:255]`** : nom de la playlist
- `description` **`[text]`** : description de la playlist
- `private` **`[boolean]`** : visibilité de la playlist
- `public` **`[boolean]`** : visibilité de la playlist
- `movies` **`[relation:ManyToMany]`** : films contenus dans la playlist
- `member` **`[relation:ManyToOne]`** : utilisateur propriétaire de la playlist



# Commandes utiles

## Symfony

- Démarrage du serveur : `symfony server:start`
- Table de routage : `symfony console debug:router --show-controllers`

## Doctrine

- Suppression de la BDD : `symfony console doctrine:database:drop`
- Création de la BDD : `symfony console doctrine:database:create`
- Création du schéma : `symfony console doctrine:schema:create`
- MAJ du schéma : `symfony console doctrine:schema:update`
- Chargement des données de test présentes dans src/DataFixtures : `symfony console doctrine:fixtures:load`

## Entité

- Création d'une entité : `symfony console make:entity`
- Création de la migration : `symfony console make:migration`
- Exécution de la migration : `symfony console doctrine:migrations:migrate`

## Controller / CRUD

- Création d'un controller : `symfony console make:controller [nom]Controller`
- Création d'un CRUD : `symfony console make:crud [nom]`
