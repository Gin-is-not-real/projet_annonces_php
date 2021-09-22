# Annonces 
Projet de formation - un site de petites annonces en php  
## 1 - Main
Le routing est effectué par /index.php.  
Dans un premier temps le routeur appelle /main.php  
### Procédure: 
* Stocke les controllers et managers dans des vars GLOBALS  
* si ils ne sont pas instanciés (lancement du site), appelle la fonction __initControllers()__

### fonctions:
#### getConnectionInformations()  
 * analyse la variable SERVER[HTTP_HOST] pour determiner si on travaille en local ou sur site distant :  
 * En fonction de sa valeur, elle retourne les infos de connection necessaires pour communiquer avec la database, que l'on as renseigné dans la fonction
  * __localhost__: renvoi les info de connection au serveur local
  * __autre__:  renvoi les info de connection au serveur distant
 * __return obj__: {hostname, basename, username, password}
 
#### initControllers()
* Appele __getConnectionInformation()__
* Instancie les controllers  
* Attache à chaque controller une instance du Manager correspondant 

#### clearSession()  
* Verifie les variables de SESSION [username] et [user_id], et session_id()
* Si il y a une session active, elle est détruite, et les variables sont effacées  

#### initNavigation()  
 * Appelle __clearSession()__  
 * Appelle __loginController->clearFolder()__
 * Appelle __offerController->index()__

## 2 - index  
Il récupère et interprete le __GET['action']__, et apelle les fonctions de controllers correspondantes.  
Pour le moment il effectue aussi parfois des verifications de variables POST avant d'appeler les fonctions de controller

# ROUTES
En fonction de la valeur de __GET[action]__:  

|  GET[action]  |  controller     |  fonction      | parametres |
|---------------|-----------------|----------------|------------|
| !isset        | main.php        | initNavigation | |
| login         | loginController | login          | POST[username], POST[pass] |
| register      | loginController | register       | POST[username], POST[email], POST[pass] |
| logout        | loginController | logout         | |
|admin          | offerController | listByUser     | SESSION[user_id], GLOBALS[imageController], string |
|admin          | loginController | index          | |
| offer-index   |