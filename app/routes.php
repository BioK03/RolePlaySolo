<?php
use Symfony\Component\HttpFoundation\Request;

use RolePlaySolo\Domain\Commentaire;
use RolePlaySolo\Form\Type\CommentaireType;

use RolePlaySolo\Domain\Panier;
use RolePlaySolo\Form\Type\PanierType;

use RolePlaySolo\Domain\Client;
use RolePlaySolo\Form\Type\ClientType;

use RolePlaySolo\Form\Type\ClientPassType;
use RolePlaySolo\Form\Type\ClientRegisterType;

// Home page
$app->get('/', function () use ($app) {
    $produits = $app['dao.produit']->findAll();
	$series = $app['dao.serie']->findAll();
	$pan = 0;
	if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
	}
	
    return $app['twig']->render('index.html.twig', array(
		'produits' => $produits,
		'pan' => $pan,
		'series' => $series));
});

//Serie page
$app->match('/serie/{id}', function ($id) use ($app) {
	$serie = $app['dao.serie']->find($id);
	$produits = $app['dao.produit']->findAllBySerie($id);
    $series = $app['dao.serie']->findAll();
	$pan = 0;
	if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
	}
	
    return $app['twig']->render('serie.html.twig', array(
		'produits' => $produits,
		'serie' => $serie,
		'pan' => $pan,
		'series' => $series));
});

//All products page
$app->match('/tous', function () use ($app) {
	$serie = $app['dao.serie']->genAllProduits();
	$produits = $app['dao.produit']->findAll();
    $series = $app['dao.serie']->findAll();
	$pan = 0;
	if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
	}
	
    return $app['twig']->render('serie.html.twig', array(
		'produits' => $produits,
		'serie' => $serie,
		'pan' => $pan,
		'series' => $series));
});

// Page panier
$app->match('/panier', function (Request $request) use ($app) {
	$client = $app['security']->getToken()->getUser();
	$paniers = $app['dao.panier']->findAllByClient($client->getId());
    $series = $app['dao.serie']->findAll();
	$pan = 0;
	if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
	}
	
	$total = 0;
	foreach ($paniers as $panier)
	{
		$total += $panier->getTotal();
	}
	
	$panierFormTrash = $app['form.factory']->create(new PanierType());
	$panierFormTrash->handleRequest($request);
	$panierFormViewTrash = $panierFormTrash->createView();
	
	if($panierFormTrash->isSubmitted() && $panierFormTrash->isValid()) {
		$app['dao.panier']->deleteAllByClient($client->getId());
		return $app->redirect('/panier');
	}
	
    return $app['twig']->render('panier.html.twig', array(
		'paniers' => $paniers,
		'client' => $client,
		'total' => $total,
		'pan' => $pan,
		'panierFormTrash' => $panierFormViewTrash,
		'series' => $series));
});

// Product details with comments
$app->match('/produit/{id}', function ($id, Request $request) use ($app) {
    $produit = $app['dao.produit']->find($id);
    $client = $app['security']->getToken()->getUser();
	$commentaires = $app['dao.commentaire']->findAllByProduit($id);
    $commentaireFormView = null;
	$panierFormView = null;
	$series = $app['dao.serie']->findAll();
	$pan = 0;
	
    if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
        // A user is fully authenticated : he can add comments
        $commentaire = new Commentaire();
        $commentaire->setProduit($produit);
        $commentaire->setAuteur($client);
        $commentaireForm = $app['form.factory']->create(new CommentaireType(), $commentaire);
        $commentaireForm->handleRequest($request);
        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $app['dao.commentaire']->save($commentaire);
            $app['session']->getFlashBag()->add('success', 'Votre commentaire a été ajouté.');
        }
        $commentaireFormView = $commentaireForm->createView();
		
		// A user is fully authentificated: he can add a product to his panier
		$panier = new Panier();
		$panier->setProduit($produit);
		$panier->setQuantite(1);
		$panier->setClient($client);
		$panierForm = $app['form.factory']->create(new PanierType(), $panier);
		$panierForm->handleRequest($request);
		if ($panierForm->isSubmitted() && $panierForm->isValid()) {
			$app['dao.panier']->save($panier);
			return $app->redirect('/panier');
		}
		$panierFormView = $panierForm->createView();
    }
	
    return $app['twig']->render('produit.html.twig', array(
        'produit' => $produit,
		'pan' => $pan,
        'commentaires' => $commentaires,
        'commentaireForm' => $commentaireFormView,
		'panierForm' => $panierFormView,
		'series' => $series));
});

// Login form
$app->match('/login', function (Request $request) use ($app) {
	$series = $app['dao.serie']->findAll();
	$client = new Client();
	$clientRegisterForm = $app['form.factory']->create(new ClientRegisterType(), $client);
	$clientRegisterForm->handleRequest($request);
	if($clientRegisterForm->isSubmitted() && $clientRegisterForm->isValid()) {
		$succ = $app['dao.client']->mailExisteId($client->getUsername(), -1);
		if($succ)
		{
			$client->setMail('');
			$app['session']->getFlashBag()->add('success', 'L`adresse email fournie est déjà associé à un autre compte !');
			$app->redirect('/login');
		}
		else
		{
			$app['dao.client']->register($client);
			$app['session']->getFlashBag()->add('success', 'Vous êtes maintenant inscrit !');
			$app->redirect('/login');
		}
	}
	$clientRegisterFormView = $clientRegisterForm->createView();
	
    return $app['twig']->render('login.html.twig', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
		'clientFormRegister' => $clientRegisterFormView,
		'series' => $series
    ));
})->bind('login');  // named route so that path('login') works in Twig templates

// Modify account form
$app->match('/modify', function (Request $request) use ($app) {
    $client = null;
	$paniers = null;
	$clientFormView = null;
	$clientFormPassView = null;
	$series = $app['dao.serie']->findAll();
	$pan = 0;
	
	if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
		$client = $app['security']->getToken()->getUser();
		$paniers = $app['dao.panier']->findAllByClient($client->getId());
		
		$clientForm = $app['form.factory']->create(new ClientType(), $client);
		$clientForm->handleRequest($request);
		if($clientForm->isSubmitted() && $clientForm->isValid()) {
			$succ = $app['dao.client']->mailExisteId($client->getUsername(), -1);
			if($succ)
			{
				$client->setUsername('');
				$app['session']->getFlashBag()->add('success', 'L`adresse email fournie est déjà associé à un autre compte !');
				$app->redirect('/modify');
			}
			else
			{
				$app['dao.client']->save($client);
				$app['session']->getFlashBag()->add('success', 'Votre profil a été modifié avec succès !');
				$app->redirect('/');
			}
			
		}
		$clientFormView = $clientForm->createView();
		
		$clientFormPass = $app['form.factory']->create(new ClientPassType(), $client);
		$clientFormPass->handleRequest($request);
		if($clientFormPass->isSubmitted() && $clientFormPass->isValid()) {
			$app['dao.client']->modifyPass($client);
			$app['session']->getFlashBag()->add('modifySuccess', 'Votre mot de passe a été modifié avec succès !');
			return $app->redirect('/login');
		}
		$clientFormPassView = $clientFormPass->createView();
		
		$pan = sizeof($app['dao.panier']->findAllByClient($app['security']->getToken()->getUser()->getId()));
	}
	
    return $app['twig']->render('modify.html.twig', array(
		'paniers' => $paniers,
		'pan' => $pan,
		'clientForm' => $clientFormView,
		'clientFormPass' => $clientFormPassView,
        'client' => $client, 
		'series' => $series));
});