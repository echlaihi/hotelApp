

---

# Pour exécuter ce code sur votre machine :
1. Vérifiez que vous avez installé Composer.
2. Exécutez la commande suivante : `composer install`.
3. Créez une base de données nommée `hotel`.
4. Renommez le fichier `.env.example` en `.env`.
5. Exécutez la commande `php artisan migrate` pour la création des 
tables.

6.  Exécutez la commande `php artisan storage:link` pour les fonctionnalités de file uploading.

7. Exécutez la commande `php artisan serve` voir l'application
8. Enregistrez un utilisateur avec l'email `admin@email.com`.
9. Modifiez les informations de l'utilisateur créé pour le rendre administrateur en changeant la valeur du champ `is_admin = 1` dans la table `users`.

# Création des chambres
Après avoir créé l'utilisateur, vous devez créer des chambres en utilisant le compte administrateur. Utilisez les images disponibles à cette URL :
https://github.com/echlaihi/images_pfe.git
