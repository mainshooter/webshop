function shopcard(method, id) {
  // This function
}
(function() {
  shoppingcard = {
    add: function(productID) {
      var result = ajax("php/ctrl/shoppingcard.ctrl.php?shoppingcard=add&productID=" + productID + "&amount=1");
      // console.log(result.responseText);
    }
  }
}());

function ajax(url) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
     return(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}
