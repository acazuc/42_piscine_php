<?php
if (isset($_GET["ok"]))
{
  if ($_SESSION["login"] == true)
  {
    if (!empty($_SESSION["panier"]))
    {
      if (panier_add($_SESSION["username"], $_SESSION["panier"]))
      {
        $_SESSION["panier"] = array();
        unset($_GET["ok"]);
        include("page/panier.php");
      }
      else
      {
        echo "SORRY, CAN'T VALID YOUR PANIAY<br />";
      }
    }
    else
    {
      echo "Votre panier est vide...<br />";
      unset($_GET["ok"]);
      include("page/panier.php");
    }
  }
  else
  {
    include("page/login.php");
  }
}
else
{
  ?>
  <table id="item_list">
    <thead>
      <tr>
        <th style="width:100px">
          Image
        </th>
        <th>
          Nom
        </th>
        <th>
          Description
        </th>
        <th style="width:150px">
          Prix
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
      $tmp_items = array();
      foreach ($_SESSION["panier"] as $key => $panier_item)
      {
        foreach($items as $item)
        {
          if ($item[0] == $panier_item)
          {
            $tmp_items[$key] = $item;
            continue 2;
          }
        }
        unset($_SESSION["panier"][$key]);
      }
      $total = 0;
      foreach ($tmp_items as $key => $item)
      {
        ?>
        <tr>
          <td>
            <img src="<?php echo $item[3]; ?>"/>
          </td>
          <td>
            <?php echo htmlspecialchars($item[1]); ?>
          </td>
          <td>
            <?php echo htmlspecialchars($item[4]); ?>
          </td>
          <td>
            <a href="index.php?p=unbuy&amp;id=<?php echo $key; ?>" style="text-decoration:none;">
              <input type="button" value="REMOVE">
            </a>
            <?php echo htmlspecialchars($item[5]); ?>
          </td>
        </tr>
        <?php
        $total += $item[5];
      }
      ?>
      <tr>
        <td colspan="4">
          Total: <?php echo $total; ?>
        </td>
      </tr>
    </tbody>
  </table>
  <a href="index.php?p=panier&amp;ok" style="text-decoration:none">
    <input style="color:black;font-size:15px;margin:5px;padding:5px;" type="button" value="Valider ma commande">
  </a>
<?php
}
?>
