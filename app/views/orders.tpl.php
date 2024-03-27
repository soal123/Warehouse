<?php require VIEWS.'/incs/header.tpl.php'; ?>

<div class="container-fluid my-3 col-2">
 <table class="table table-dark border border-secondary table-hover text-center">
  <thead>
    <tr>
      <!--<th scope="col">id</th>-->
      <th scope="col"><?=$lang['order number']?></th>
      <th scope="col"><?=$lang['order shipped']?></th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($result as $item): ?>
    
        <?php if ($item['order shipped'] == 1): ?>
          <tr>
            <!--<td style="color: Gray;"><?=$item['order number'];?></td>-->
            <td><a href='order?id=<?=$item['order number'];?>' target='_blank'><?=$item['order number'];?></a></td>
            <td style="color: Gray;">отгружен</td>
          </tr>
        <?php else: ?>
          <tr>
            <!--<td><?=$item['order number'];?></td>-->
            <td><a href='order?id=<?=$item['order number'];?>' target='_blank'><?=$item['order number'];?></a></td>
            <td style="color: Lime;">комплектуется</td>
          </tr>
        <?php endif; ?>
          
    <?php endforeach; ?>

  </tbody>
</table>
 
 
</div>


<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>