# projet offers
Adaptation et optimisation du projet de formation 'projet_offers', un site de petites annonces en php (MVC).  

## derniers ajouts
**mars 2022: sécurité**
Verification et amélioration de la sécurité:
- ajout du script securize_form.php   *(3 mars 22)*
- sécurisation des données POST et GET dans l'index via fonctions du script   *(4 mars 22)*
- verification antibot via champs cachés et condition dans l'index   *(4 mars 22)*


## a optimiser
- offer manager:
    - fonction add(): 
        - A voir: les POST sont récupérés dans la fonction (elles sont cependant securisée dans l'index)
        - dans les fonctions addCategory et addNewCategorie, les données sont passées en parametre

    - les fonctions liées aux categories devraient étre à part (sauf addCategory qui concerne l'offre)

    - isFavorite devrait etre rennomée (check_if_is_favorite ?)

## todo - version prod (demo)
[ ] Limiter la durée d'inscription pour ne pas saturer la bdd
    [X] un fichier json stocke des id et des valeur de temps
    [ ] script php
        [ ] enregistre les ids de l'user et la valeur de time() au moment de la connection dans le json
        [X] recupere les donnée, compare les dates (valeurs tests à remplacer) pour definir si le delai est expiré
        [X] met à jour le fichier json
        
    [ ] mettre en place la suppression d'un utilisateur. doit supprimer aussi ses annonces etc


[ ] prévenir l'utilisateur des conditions:
    [X] information affiché dans le formulaire register
    [ ] rapeller les conditions d'enregistrement dans le mail


[ ] L'utilisateur recevra lui même les mails lorsqu'il contacte un vendeur               


[ ] Verifier l'envoi de mails lors de l'insription
    [ ] formater le mail (rappel conditions)


[X] Verifier la sécurité
    [X] ajout du script securize_form.php   *(3 mars 22)*
    [X] appel de valid_data_array() sur les données POST et GET dans l'index    *(4 mars 22)*
    [X] verif antibot   *(4 mars 22)*
        
## Base de données
[X] exporter la bdd locale
[X] gerer l'import de la bdd
    - ajouter un script d'import automatique
        [X] revoir mes scripts de creation de bdd (database_manager/accounts_manager 2021)