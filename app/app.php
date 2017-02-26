<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Stylist.php';
    require_once __DIR__.'/../src/Client.php';


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

    //root route//
    $app->get("/", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll(), 'clients' => Client::getAll()));
    });

    $app->post("/stylists_add", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $stylist = new Stylist($name, $phone, $address, $id = null);
        $stylist->save();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });
    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists_id_edit.html.twig', array('stylist' => $stylist));
    });
    $app->post("/delete_stylists", function() use ($app) {
            Stylist::deleteAll();
            return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::GetAll()));
    });

    //User clicks submit button to add new client
    $app->post("/client_add", function() use ($app) {
        $name_client = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($name_client, $stylist_id, $id=null);
        $stylist = Stylist::find($stylist_id);
        $new_client->save();
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });

    $app->get("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('stylists_id.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });

    //user clicks submit button to update client info
    $app->patch("/client/{id}", function($id) use ($app) {
        $name_client = $_POST['name'];
        $stylists = Stylist::getAll();
        $client = Client::find($id);
        $client->update($name_client);
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylists, 'client' => $client));
    });

    $app->get("/client/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client, 'clients' =>Client::getAll()));
    });

    //deletes all clients for specific stylist
    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll(), 'clients' => Client::GetAll()));
    });

    //user clicks submit button to delete client info
    $app->delete("/client/{id}", function($id) use ($app) {
        $stylists = Stylist::getAll();
        $client = Client::find($id);
        $client->delete();
        return $app['twig']->render('stylists.html.twig', array('stylists' => $stylists, 'clients' => Client::getAll()));
    });

    return $app;
?>
