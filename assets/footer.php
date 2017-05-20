<div class="pagenering col-12">
  <?php
    require_once 'php/classes/product.class.php';
    require_once 'php/classes/view.class.php';
    $product = new Product();
    $productsTotal = $product->countAllProducts();

    $pages = ceil($productsTotal / 10);
    $view = new View();
    echo $view->createPagenering($pages);

  ?>
</div>

<div class="footer col-12">
    &copy;Multiversum - webshop
</div>
