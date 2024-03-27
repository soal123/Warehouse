<?php // this views/flags.admin.tpl.php ?>

<?php require VIEWS.'/incs/header.tpl.php'; ?>



<div class="container-fluid my-3 col-8">
 <h3 class='my-3'>flag = <?=$str_flag[$flag]?></h3>
 
 <table class="table table-dark table-hover border border-secondary text-center" id='table'>
  <thead>
    <tr>
      <th scope="col"><?=$lang['id']?></th>
      <th scope="col"><?=$lang['date']?></th>
      <th scope="col"><?=$lang['order number']?></th>
      <th scope="col"><?=$lang['name']?></th>
      <th scope="col"><?=$lang['count']?></th>
      <th scope="col"><?=$lang['flag']?></th>
      <th scope="col"><?=$lang['verification']?></th>
    </tr>
  </thead>
  <tbody>
        
    <?php foreach($result as $item): ?>
        <tr>
          <td><?=$item['id']?></th>
          <td><?=$item['event date']?></th>
          <td><a href='order?id=<?=$item['order_number'];?>' target='_blank'><?=$item['order_number'];?></a></td>
          <td><a href='item?id=<?=$item['id_delivery']?>' target='_blank'><?=$item['name'];?></a></td>
          <td><?=$item['count']?></td>
          <td><?=$str_flag[$item['flag']]?></td>
          
          <?php if ($item['verified'] != 0): ?>
              <td>
                  <button type="button" class="btn btn-success mx-2" data-item-id='<?=$item['id_delivery']?>' data-id='<?=$item['id'];?>' data-verified='1'><?=$lang['verified']?></button>
              </td>
          <?php else: ?>
              <td>
                  <button type="button" class="btn btn-warning mx-2" data-item-id='<?=$item['id_delivery']?>' data-id='<?=$item['id'];?>' data-verified='0'><?=$lang['not verified']?></button>
              </td>
          <?php endif; ?>
          
        </tr>
    <?php endforeach; ?>

  </tbody>
</table>

</div>


<?php require VIEWS.'/incs/footer.tpl.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        window.addEventListener('load',pageLoaded);
        function pageLoaded()
        {
            let array = document.getElementById('table').querySelectorAll('button');
            
            for (let i = 0; i < array.length; i++)
            {
                array[i].addEventListener('click', function(e)
                    {
                        // console.log(this.dataset.id, this.dataset.verified);
                        console.log('this = ',this); // this is button element
                        
                        $.post('ajax/movement', {item_id: this.dataset.itemId, id: this.dataset.id, verified: this.dataset.verified}, function(data)
                            {
                                let responce_from_server = JSON.parse(data);
                                console.log('responce_from_server = ',responce_from_server);
                                
                                if (responce_from_server[1] == true)
                                {
                                    e.target.classList.replace('btn-warning','btn-success');
                                    e.target.innerHTML = '<?=$lang['verified']?>';
                                    e.target.dataset.verified = 1;
                                }
                                else
                                {
                                    e.target.classList.replace('btn-success','btn-warning');
                                    e.target.innerHTML = '<?=$lang['not verified']?>';
                                    e.target.dataset.verified = 0;
                                }
                            });
                    });
            }
            
        }
    </script>
</body>
</html>