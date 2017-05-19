<?php

  session_start();

 ?>
<nav>
    <a href="index.php">
        <img class="col-1" src="file/site/logo.png">
    </a>
        <div id="nav" class="col-10">
            <ul id="width-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Producten</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <a href="winkelmandje.php">
          <i class="fa fa-shopping-basket col-1 shopping_card" aria-hidden="true"></i>
        </a>
        <span id="shoppingcardCount">0</span>
    </nav>
