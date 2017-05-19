function shopcard(method, id) {
  // This function
}
var result;
(function() {
  shoppingcard = {
    add: function(productID) {
      result = shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=add&productID=" + productID + "&amount=1");
      console.log(result);
      shoppingcard.count();
    },
  count: function() {
    // This function gets all products from the shoppingcard counts the row - php
    // Displays it
    result = shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=count");
    console.log(shoppingcard.ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=count"));
    document.getElementById('shoppingcardCount').innerHTML = result;
    // $('shoppingcardCount').innerHTML = result.responseText;
  },
  ajax: function(url) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, false);
    xhttp.send();

    return(xhttp.responseText);
  }
}
})();
