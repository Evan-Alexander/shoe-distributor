<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();
    $app['debug']=true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/", function() use ($app) {
        $brand = new Brand($_POST['brand-name']);
        $brand->save();
        $store = new Store('store-name');
        $store->save();
        $brand->addStore($store);
        return $app->redirect('/');
    });

    // $app->post("/store", function() use ($app) {
    //     $store = new Store('store-name');
    //     $store->save();
    //     $store->addBrand($brand);
    //     return $app->render('store.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    // });
    return $app;
?>
