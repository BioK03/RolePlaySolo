<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new RolePlaySolo\DAO\ClientDAO($app['db']);
            }),
        ),
    ),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

// Register services.
$app['dao.produit'] = $app->share(function ($app) {
    return new RolePlaySolo\DAO\ProduitDAO($app['db']);
});

$app['dao.serie'] = $app->share(function ($app) {
    return new RolePlaySolo\DAO\SerieDAO($app['db']);
});

$app['dao.client'] = $app->share(function ($app) {
    return new RolePlaySolo\DAO\ClientDAO($app['db']);
});

$app['dao.commentaire'] = $app->share(function ($app) { //un commentaire possède un produit et un client
    $commentaireDAO = new RolePlaySolo\DAO\CommentaireDAO($app['db']);
    $commentaireDAO->setProduitDAO($app['dao.produit']);
	$commentaireDAO->setClientDAO($app['dao.client']);
    return $commentaireDAO;
});

$app['dao.panier'] = $app->share(function ($app) { //un panier possède un client et un produit
    $panierDAO = new RolePlaySolo\DAO\PanierDAO($app['db']);
    $panierDAO->setProduitDAO($app['dao.produit']);
	$panierDAO->setClientDAO($app['dao.client']);
    return $panierDAO;
});