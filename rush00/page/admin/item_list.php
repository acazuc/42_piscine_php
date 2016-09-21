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
    if ($_GET["cat"])
    {
      foreach ($items as $key => $item)
      {
        if (!in_array($_GET["cat"], $item[2]))
          unset($items[$key]);
      }
    }
    foreach ($items as $item)
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
          <a href="index.php?p=admin&amp;sub=item_edit&amp;id=<?php echo $item[0]; ?>" style="text-decoration:none;">
            <input type="button" value="Modifier">
          </a>
          <a href="index.php?p=admin&amp;sub=item_remove&amp;id=<?php echo $item[0]; ?>" style="text-decoration:none;">
            <input type="button" value="Supprimer">
          </a>
          <?php echo htmlspecialchars($item[5]); ?>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
