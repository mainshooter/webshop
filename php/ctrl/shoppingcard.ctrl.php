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
        if ($shoppingcard->checkIfIdExists($_REQUEST['productID']) == false) {
          // It isn't existsing in the shoppingcard
          $shoppingcard->add($_REQUEST['productID'], $_REQUEST['amount']);
        }
        else if ($shoppingcard->checkIfIdExists($_REQUEST['productID']) == true) {
          // Exists in the shoppingcard
          $amount = $shoppingcard->getProductAmount($_REQUEST['productID']);
          $amount = $amount + 1;
          echo " " . $amount;
          $shoppingcard->update($_REQUEST['productID'], $amount);
        }
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
      case 'count':
        // Counts all products in the shoppingcard
        echo $shoppingcard->count();
        break;
    }
  }


?>
