# projet offers
Adaptation et optimisation du projet de formation 'projet_offers', un site de petites annonces en php (MVC).  

## derniers ajouts
**mars 2022: sécurité**
Verification et amélioration de la sécurité:
- ajout du script securize_form.php   *(3 mars 22)*
- sécurisation des données POST et GET dans l'index via fonctions du script   *(4 mars 22)*
- verification antibot via champs cachés et condition dans l'index   *(4 mars 22)*


## todo - version prod (demo)
[ ] Ne pas saturer la base de donnée
    [ ] Limiter le nombre d'annonces par utilisateur
    [ ] Limiter la durée d'inscription
    [ ] L'utilisateur ne doit pas recevoir les mails de contact (annonces)

    [ ] prévenir l'utilisateur des conditions

    [ ] supprimer un utilisateur doit supprimer ses annonces etc


[ ] Verifier l'envoi de mails lors de l'insription


[X] Verifier la sécurité
    [X] ajout du script securize_form.php   *(3 mars 22)*
    [X] appel de valid_data_array() sur les données POST et GET dans l'index    *(4 mars 22)*
    [X] verif antibot   *(4 mars 22)*
        
## Base de données
[X] exporter la bdd locale
[X] gerer l'import de la bdd
    - ajouter un script d'import automatique
        [X] revoir mes scripts de creation de bdd (database_manager/accounts_manager 2021)