<?php require VIEWS.'/incs/header.tpl.php'; ?>

<div class="container-fluid my-3 col-6">
 <p>
     order number = <?=$id?>
 </p>
 
 <table class="table table-dark border border-secondary table-hover">
  <thead>
    <tr>
      <th scope="col">date</th>
      <th scope="col">name</th>
      <th scope="col">count</th>
    </tr>
  </thead>
  <tbody>
        
    <?php foreach($result as $item): ?>
        <tr>
          <th scope="row"><?=$item['event date'];?></th>
          <!--<td><?=$item['name'];?></td>-->
          <td><a href='item?id=<?=$item['id_delivery'];?>' target='_blank'><?=$item['name'];?></a></td>
          <td>-<?=$item['count'];?></td>
        </tr>
    <?php endforeach; ?>

  </tbody>
</table>

</div>

<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>