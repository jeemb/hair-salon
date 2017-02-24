<?php
date_default_timezone_set("America/Los_Angeles");
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Stylist.php';

$app = new Silex\Application();

$server = 'mysql:host=localhost:8889;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

use Symfony\Component\HttpFoundation\Request;
Request::enableHttpMethodParameterOverride();

$app->get("/", function() use ($app) {

    return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

$app->post("/stylist_add", function() use ($app) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $stylist = new Stylist($name, $phone, $address, $id = null);
    $stylist->save();
    return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
});

return $app;
?>
