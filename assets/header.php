<?php

  session_start();

 ?>
<nav>
      <a href="index.php">
          <img class="col-1 col-m-3" src="file/site/logo_nt.png">
          <div class="col-2 col-m-9 title">Multiversum</div>
      </a>
        <div id="nav" class="col-8 col-m-8">
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
