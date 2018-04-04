# PokeCard (WebService)

## Documentation de l'API
Environnement Postman : https://www.getpostman.com/collections/cdc54dda5c46e79ef3eb

Documentation de l'API : https://documenter.getpostman.com/view/2962586/pokecard/RVnTnMRn
 
##### /!\ Attention /!\ 
 - Toutes les données présentes dans les différents body sont des exemples (qui peuvent être faux ou déjà utilisés).
 - La `{{BASE_URL}}` de Postman peut être changer (`Environnement quick look` -> `Edit`)

## Installation de l'API

Configurer Apache : https://github.com/olivernight/mysilexmvc/wiki/Apache

Pour la Base de Données : Créer une base de donnée grâce au `.sql` disponible dans le Repository Git.

## Informations techniques

Nous avons choisi de faire l'API en PHP (silex) et la base de données en SQL car ce sont deux technologies que nous maîtrisions (déjà utilisé à l'IUT). Toutes les informations retournées par le web service sont au format JSON.

L'API est formé de trois classe :
- Pokemon
- User
- Exchange

Chaque classe dispose d'un `Repository` et d'un `Controller`.
Grâce a l'API il est possible de créer un compte à partir d'un compte Facebook, 10 pokemons sont alors ajouté aléatoirement à l'utilisateur. Il est possible de recevoir le détails d'un pokemon (description, photo, habitat, etc). 
L'utilisateur peut aussi créer un échange en indiquant l'ID du Pokémon qu'il souhaite envoyer et l'ID du Pokémon qu'il souhaite recevoir. Il est aussi possible d'envoyer un Pokémon en cadeau à un utilisateur.
