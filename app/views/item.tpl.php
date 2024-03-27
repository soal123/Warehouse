<?php require VIEWS.'/incs/header.tpl.php'; ?>

<div class="container-fluid my-3 col-6">
 <p>
     initial count = <?=$result[0]['initial count']?>
 </p>
 
 <table class="table table-dark border border-secondary table-hover">
  <thead>
    <tr>
      <th scope="col">date</th>
      <th scope="col">order</th>
      <th scope="col">name</th>
      <th scope="col">count</th>
      <th scope="col">total count</th>
      <th scope="col">where</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td></td>
      <td><?=$count?></td>
      <td></td>
    </tr>
        
    <?php foreach($result as $item): ?>
        <tr>
          <th scope="row"><?=$item['event date'];?></th>
          <!--<td><?=$item['order_number'];?></td>-->
          <td><a href='order?id=<?=$item['order_number'];?>' target='_blank'><?=$item['order_number'];?></a></td>
          <td><?=$item['name'];?></td>
          <?php if ($item['order_number'] == 'Приход'): ?>
              <td>+<?=$item['count']?></td>
              <td><?php $count += $item['count']; echo $count; ?></td>
          <?php else: ?>
              <td>-<?=$item['count']?></td>
              <td><?php $count -= $item['count']; echo $count; ?></td>
          <?php endif; ?>
          <td><?=$str_flag[$item['flag']]?></td>
        </tr>
    <?php endforeach; ?>

  </tbody>
</table>

 <p>
     current count = <?=$count?>
 </p>
 
</div>


<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>