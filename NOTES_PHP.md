# NOTES PHP
* * *
## Ouvrir fichier PHP
 Les fichiers PHP se lisent avec un serveur.
 
 - Avec phpStorm on peut ouvrir un serveur local en tapant la ligne de commande suivante :
 
    ```
    php -S localhost:8080 
    ```
   
- Avec un logiciel comme MAMP (Ou WAMP sur Windows)

## Petites choses basiques à faire

- Séparer les présentations `views` de tout ce qui est traitement `controller` 

- Factoriser son code en _plusieurs fichiers_

- Utiliser les fonctions : 

    ```php
    include('view.php');
    ```
  
    > Version moins restrictive, si le `Path` n'est pas bon, on aura un avertissement mais le code ne s'arrêtera pas, contraiment à son alternative qui est :
                                                                   
    ```php
    require('view.php');
    ```
  
  > Cette fonction-ci génèrera une `erreur fatale` en cas d'erreur, pour éviter les inclusions multiples, on peut également utiliser : 
        
    ```php
    include_once('view.php');
    require_once('view.php');
    ```

## Coder 

- Créer une variable: voir aussi sur [w3school](https://www.w3schools.com/php/php_variables.asp) ou sur [php.net](https://www.php.net/manual/fr/language.variables.variable.php)
    ```php
    $nomVariable = "les données de la variables";
    ```

                                                                                                                                                                                                                                                                                                                                                        






