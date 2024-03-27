<?php require VIEWS.'/incs/header.tpl.php'; ?>

<div class="container-fluid my-3 col-10">
 <table class="table table-dark table-hover border border-secondary text-center">
  <thead>
    <tr>
      <th scope="col"><?=$lang['id']?></th>
      <th scope="col"><?=$lang['order number']?></th>
      <th scope="col"><?=$lang['name']?></th>
      <th scope="col"><?=$lang['count']?></th>
      <th scope="col"><?=$lang['event date']?></th>
      <th scope="col"><?=$lang['flag']?></th>
      <th scope="col"><?=$lang['verified']?></th>
    </tr>
  </thead><?=$lang['Navbar']?>
  <tbody>
    
    <?php foreach($result as $item): ?>

          <tr>
            <td><?=$item['id'];?></td>
            <td><a href='order?id=<?=$item['order_number'];?>' target='_blank'><?=$item['order_number'];?></a></td>
            <td><?=$item['name'];?></td>
            <td><?=$item['count'];?></td>
            <td><?=$item['event date'];?></td>
            <td><?=$item['flag'];?></td>
            <td><?=$item['verified'];?></td>
          </tr>

    <?php endforeach; ?>

  </tbody>
</table>
 
 
</div>

<hr>
<?=$pagination?>	

<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>