## Démarrez le projet
il faut exécuter la commande dans une ligne de commande :
> php artisan serve

qui affichera le lien de l'application web : **http://localhost:PORT/**

## Remarque
+ Pour la configuration de l'environnement de développement consultez la page d'installation de Laravel :
https://laravel.com/docs/7.x/installation
+ Pour l'installation de : 
	+ VueJS : https://5balloons.info/laravel-7-installation-with-vue-js/
	+ ChartJS: 
		+ >npm install chart.js lodash --save
+ Pour se connecter autant que parent il faut cliquer sur Login de la page d'accueil
+ Pour se connecter autant qu'employé il faut cliquer sur "Espace employé"
+ Pour l'installation de Stripe: https://www.itsolutionstuff.com/post/laravel-6-stripe-payment-integration-tutorialexample.html
et aussi sa documentation dans le site de Laravel: https://laravel.com/docs/7.x/billing
+ Pour l'installation de DomPDF: https://github.com/barryvdh/laravel-dompdf
+ Remplacer l'email dans le fichier **/app/Http/Middleware/SuperUserMiddleware.php** par l'email du compte admin que vous souhaitez qu'il soit super admin:
```php
if(Auth::guard('employe')->check() &&  !Auth::guard('employe')->user()->admin){
	return  redirect('espace_employe')->with('failure', 'Désolé, cet espace est réservé aux super admins uniquement');
}else  if(Auth::guard('employe')->check() &&  Auth::guard('employe')->user()->admin &&  Auth::guard('employe')->user()->email !=  "hamgimiso@gmail.com"){
	return  redirect('espace_admin')->with('failure', 'Désolé, cet espace est réservé aux super admins uniquement');
}
```
