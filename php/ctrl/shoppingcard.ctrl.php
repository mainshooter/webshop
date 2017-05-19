<?php
  session_start();
  if (ISSET($_REQUEST['shoppingcard'])) {
    require '../classes/shoppingcard.class.php';
    require '../classes/view.class.php';
    // require '../classes/webshop.class.php';
    $shoppingcard = new shoppingcard();

    switch ($_REQUEST['shoppingcard']) {
      case 'add':
        // Add product from shoppingcard
        $shoppingcard->add($_REQUEST['productID'], $_REQUEST['amount']);
        break;
      case 'delete':
        // Remove product form shoppingcard
        $shoppingcard->delete($_REQUEST['productID']);
        break;
      case 'update':
        // Updates the amount of a product
        $shoppingcard->update($_REQUEST['productID'], $_REQUEST['amount']);
        break;
      case 'show':
        $card = $shoppingcard->get();

        $view = new View();
        $view->displayShoppingCard($card);
        break;
    }
  }


?>
