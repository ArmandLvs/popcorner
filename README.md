# Popcorner

# TODO


N° étape	Tâche à faire	Obligatoire / Optionnel	Séance de début prévisionnel	Etat
1	prise de connaissance du cahier des charges	OBLIGATOIRE	TP 3
2	initialisation du projet Symfony	OBLIGATOIRE	TP 3
3	gestion du code source avec Git	RECOMMANDÉ
4	ajout au modèle des données des entités liées [inventaire] et [objet] minimales	OBLIGATOIRE	TP 3
4.1	- entité [inventaire]	''	''
4.2	- entité [objet]	''	''
4.3	- association 1-N entre [inventaire] et [objet]	''	''
4.4	- propriétés non-essentielles des [objets] (optionnel)	OPTIONNEL	(en 2ème moitié de projet
5	ajout de données de tests chargeables avec les fixtures	OBLIGATOIRE	TP 3
 	- pour [inventaire]
 	- pour [objet]
 	- …
6	ajout d'une interface EasyAdmin dans le back-office avec les 2 contrôleurs CRUD [inventaire] et [objet]
 	- CRUD [inventaire]	OBLIGATOIRE	TP 3/4
 	- CRUD [objet]	OBLIGATOIRE	TP 3/4
 	- navigation entre [inventaire] et ses [objets]	OPTIONNEL	TP 5
7	ajout de l'entité membre et du lien membre - [inventaire]	OBLIGATOIRE	TP 3/4
 	- ajout de membre au modèle des données
 	- ajout de l'association 1-N entre membre et ses inventaires (optionnellement 1-1)
8	création des pages du "front-office" de consultation des [inventaires]
 	- consultation de la liste de tous les inventaires (dans un premier temps)	OBLIGATOIRE	TP 4
 	- consultation d'une fiche d'[inventaire] à partir de la liste	OBLIGATOIRE	TP 4
9	ajout de la navigation entre [inventaire] et [objet] dans le back-office EasyAdmin	OPTIONNEL	TP 4/5
10	utilisation de gabarits pour les pages de consultation du front-office	OBLIGATOIRE	TP 5
 	- consultation d'un [objet]
 	- consultation de la liste des [objets] d'un [inventaire]
 	- navigation d'un [inventaire] vers la consultation de ses [objets]
11	intégration d'une mise en forme CSS avec Bootstrap dans les gabarits Twig	OBLIGATOIRE	TP 6
12	intégration de menus de navigation	OBLIGATOIRE
13	ajout de l'entité [galerie] au modèle des données et de l'association M-N avec [objet]	OBLIGATOIRE
14	ajout de [galerie] dans le back-office	OPTIONNEL
15	ajout d'un contrôleur CRUD au front-office pour [galerie]	OBLIGATOIRE	TP xxx
16	ajout de fonctions CRUD au front-office pour [inventaire]	OBLIGATOIRE
17	ajout de la consultation des [objets] depuis les [galeries] publiques	OBLIGATOIRE
18	ajout d'un contrôleur CRUD pour Membres	OBLIGATOIRE
19	consultation de la liste des seuls inventaires d'un membre dans le front-office	OBLIGATOIRE
20	contextualisation de la création d'[inventaire] en fonction du Membre	OBLIGATOIRE
21	contextualisation de la création d'un [objet] en fonction de l'[inventaire]	OBLIGATOIRE
22	contextualisation de la création d'une [galerie] en fonction du membre	OPTIONNEL
23	affichage des seules galeries publiques	OPTIONNEL
24	contextualisation de l'ajout d'un [objet] à une [galerie]	OPTIONNEL
25	ajout des Utiisateurs au modèle de données et du lien utilisateur - membre	OBLIGATOIRE	TP 9
26	ajout de l'authentification	OBLIGATOIRE	TP 9
27	protection de l'accès aux routes interdites réservées aux membres	OPTIONNEL	TP 9
28	protection de l'accès aux données à leurs seuls propriétaires	OPTIONNEL	TP 9
29	contextualisation du chargement des données en fonction de l'utilisateur connecté	OPTIONNEL
30	Gestion de la suppression	OPTIONNEL
31	ajout de la gestion de la mise en ligne d'images pour des photos dans les [objet]	OPTIONNEL	TP 8
32	utilisation des messages flash pour les CRUDs	OPTIONNEL
33	ajout d'une gestion de marque-pages/panier dans le front-office	OPTIONNEL	TP 9

[inventaire] = bibliothèque
[objet] = film
[galerie] = collection

Transformer cette liste en todo list en remplaçant les trois variables précédentes par les noms des entités correspondantes.

- [ ] Entités
    - [x] Création de Library
    - [x] Création de Movie
    - [ ] Création de Collection
    - [x] Création de Member
    - [x] Association entre Library et Movie
    - [x] Association entre Library et Member
    - [ ] Association entre Movie et Collection
    - [ ] Association entre Collection et Member
    - [ ] Ajout des propriétés non-essentielles des objets
- [ ] Fixtures
    - [x] Fixtures pour Library
    - [x] Fixtures pour Movie
    - [ ] Fixtures pour Collection
    - [x] Fixtures pour Member
- [ ] Interface Admin avec EasyAdmin
    - [x] CRUD Library
    - [x] CRUD Movie
    - [ ] CRUD Collection
    - [x] CRUD Member
    - [ ] Navigation entre une bibliothèque et un film
    - [ ] Navigation entre une bibliothèque et une collection
    - [ ] Navigation entre une collection et un film
- [ ] Front-office
    - [x] Consultation de toutes les bibliothèques
    - [x] Consultation d'une bibliothèque
    - [x] Consultation d'un film
    - [x] Navigation entre une bibliothèque et un film et inversement
    - [x] Passage sur Twig
    - [ ] Intégration de Bootstrap
    - [ ] Intégration de menus de navigation
    - [ ] Consultation d'une collection
    - [ ] Navigation entre une collection et un film
    - [ ] Affichage des consultations publiques avec navigation vers les films
    - [ ] Ajout d'un film à une collection
    - [ ] Ajout d'une collection à un membre
    - [ ] Ajout d'un film à une bibliothèque
    - [ ] Création de la bibliothèque à un membre
    - [ ] Gestion de la suppression
    - [ ] Gestion de la mise en ligne d'images pour les films
    - [ ] Gestion de marque-pages/panier
- [ ] Utilisateurs
    - [ ] Création de l'entité User
    - [ ] Association entre User et Member
    - [ ] Authentification
    - [ ] Protection des routes interdites aux membres
    - [ ] Protection des données aux seuls propriétaires
    - [ ] Contextualisation du chargement des données en fonction de l'utilisateur connecté
- [ ] Utilisation des messages flash pour les CRUDs



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


## Entité Collection
L'utilisateur peut créer des collections de ses films selon ses envies. Une collection peut être les films préférées d'un utilisateur, ou une liste de recommandations pour un genre en particulier.

### Propriétés
- `name` **`[string:255]`** : nom de la collection
- `description` **`[text]`** : description de la collection
- `private` **`[boolean]`** : visibilité de la collection


# Commandes utiles

## Symfony

- Démarrage du serveur : `symfony server:start`

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
