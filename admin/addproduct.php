<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add a product</title>
  </head>
  <body>
    <form action="http://localhost/leerjaar2/webshop/php/ctrl/product.ctrl.php" enctype='multipart/form-data' method="post">
      <div>Product naam</div>
      <input type="text" name="productName" />

      <div>Product Prijs</div>
      <input type="number" step="0.01" name="productPrice">

      <div>Beschrijving</div>
      <textarea name="discription"></textarea>

      <div>Product Image</div>
      <input type="file" name="file_upload"/>

      <div>Product catagorie</div>
      <select name="catagorie">
        <option value="1">VR</option>
      </select>

      <div>EAN-code</div>
      <input type="text" name="ean-code" />

      <div></div>
      <input type="submit" name="product" value="add">
    </form>
  </body>
</html>