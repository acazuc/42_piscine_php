<?php
if (($paniers = get_panier()) === false)
{
  echo "ERROR, SORRY :(";
}
else
{
  if (count($paniers) == 0)
  {
    echo "Aucun panier :/";
  }
  else
  {
    foreach($paniers as $user => $panier_user)
    {
      ?>
      <h1>Paniers de <?php echo htmlspecialchars($user); ?></h1>
      <?php
      foreach($panier_user as $panier)
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
            $total = 0;
            $tmp_items = array();
            foreach ($panier as $key => $panier_item)
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
        <?php
      }
    }
  }
}
?>
