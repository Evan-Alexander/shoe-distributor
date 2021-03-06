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
// BRANDS
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/", function() use ($app) {
        $brand = new Brand($_POST['brand-name']);
        $brand->save();
        return $app->redirect('/');
    });

    $app->post("/delete-brands", function() use ($app) {
        Brand::deleteAll();
        return $app->redirect('/');
    });

    $app->get('brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->patch("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->update($_POST['new-brand']);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->post("/add_store", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->delete("/delete-brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app->redirect('/');
    });

// STORES
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['store-name']);
        $store->save();
        return $app->redirect('/stores');
    });

    $app->post("/delete-stores", function() use ($app) {
        Store::deleteAll();
        return $app->redirect('/stores');
    });

    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('edit-stores.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll(), 'stores' => Store::getAll()));
    });

    $app->patch("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['new-store']);
        return $app['twig']->render('edit-stores.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/add_brand", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('edit-stores.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->delete("/delete-store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });
    return $app;
?>
