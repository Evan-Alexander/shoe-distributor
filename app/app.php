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
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/", function() use ($app) {
        $brand = new Brand($_POST['brand-name']);
        $brand->save();
        return $app->redirect('/');
    });

    $app->post("/delete-brand", function() use ($app) {
        Brand::deleteAll();
        Store::deleteAll();
        return $app->redirect('/');
    });

    $app->get('brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->patch("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->update($_POST['new-brand']);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'stores' => $brand->getstores(), 'all_stores' => Store::getAll()));
    });
         /* When trying to use redirect method here return $app->redirect('/brands/'. $id);
         I get a notification that the page is written in Afrikaans and Google asks if the viewer
         wants translation.  */
    $app->post("/update/{id}", function($id) use ($app) {
        $new_store = new Store($_POST['add-store']);
        $new_store->save();
        $brand = Brand::find($id);
        $brand->addStore($new_store);
        return $app['twig']->render('edit-brands.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

// STORES
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['store-name']);
        $store->save();
        return $app->redirect('/store');
    });

    $app->post("/delete-store", function() use ($app) {
        Brand::deleteAll();
        Store::deleteAll();
        return $app->redirect('/');
    });

    $app->get('stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('edit-stores.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->patch("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['new-store']);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getbrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/update-store/{id}", function($id) use ($app) {
        $new_brand = new Brand($_POST['add-brand']);
        $new_brand->save();
        $store = Store::find($id);
        $store->addBrand($new_brand);
        return $app->redirect('/stores/'. $id);
    });

    $app->delete("/delete-brand-from-store/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app['twig']->render('edit-stores.html.twig', array('brand' => Brand::find($id),'stores' => Store::getAll()));
    });

    return $app;
?>
