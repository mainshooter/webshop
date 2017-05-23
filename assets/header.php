<?php

  session_start();
  session_set_cookie_params(0)
 ?>
<nav>
      <a href="index.php">
          <img class="col-1 col-m-3" src="file/site/logo_nt.png">
      </a>
        <div id="nav" class="col-10 col-m-12">
            <ul id="width-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Producten</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <a href="winkelmandje.php">
          <i class="fa fa-shopping-basket col-1 col-m-1 shopping_card" aria-hidden="true"><span id="shoppingcardCount">0</span></i>
        </a>
    </nav>

    <img class="col-12 image_header" src="file/site/header.jpg"/>
