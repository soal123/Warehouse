<?php // this views/item.admin.tpl.php ?>

<?php require VIEWS.'/incs/header.tpl.php'; ?>



<div class="container-fluid my-3 col-12">
    <div class='row'>
        <div class='col-3 text-light border border-light p-1'>
          <div class="mb-3 row" id='target-count-fact'>
            <label for="fact" class="col-sm-4 col-form-label text-end">fact:</label>
            <div class="col-sm-4">
              <input type="number" class="form-control text-black" value="<?=$item_data['fact']?>">
            </div>
            <button class="btn btn-outline-secondary col-sm-3" type="button" data-id='<?=$id?>'>&lt; save</button>
          </div>
          
          <div class="mb-3 row">
            <label for="count-1C" class="col-sm-4 col-form-label text-end">count 1C:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext text-light" id="count-1C" value="<?=$item_data['count_1c']?>">
            </div>
          </div>
          
          <div class="mb-3 row">
            <label for="title-1C" class="col-sm-4 col-form-label text-end">difference:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext text-light" id="title-1C" value="<?=($item_data['fact']+$item_data['separate in order']-$item_data['count_1c']);?>">
            </div>
          </div>
          
          <div class="mb-3 row">
            <label for="separate" class="col-sm-4 col-form-label text-end">separate:</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext text-light" id="separate" value="<?=$item_data['separate in order']?>">
            </div>
          </div>
        </div>
        
        
        
        <div class='col-7 text-light border border-light p-1'>
          <div class="mb-3 row">
            <label for="code" class="col-sm-1 col-form-label text-end">Code:</label>
            <div class="col-sm-9">
              <input type="text" readonly class="form-control-plaintext text-light" id="code" value="<?=h($item_data['code'])?>">
            </div>
            <button class="btn btn-outline-secondary col-sm-1" type="button" id="">&lt; save</button>
          </div>
          
          <div class="mb-3 row">
            <label for="name" class="col-sm-1 col-form-label text-end">name:</label>
            <div class="col-sm-9">
              <input type="text" readonly class="form-control-plaintext text-light" id="name" value="<?=h($item_data['name'])?>">
            </div>
            <button class="btn btn-outline-secondary col-sm-1" type="button" id="">&lt; save</button>
          </div>
          
          <div class="mb-3 row">
            <label for="title-1C" class="col-sm-1 col-form-label text-end">title 1C:</label>
            <div class="col-sm-9">
              <input type="text" readonly class="form-control-plaintext text-light" id="title-1C" value="<?=h($item_data['title 1C'])?>">
            </div>
            <button class="btn btn-outline-secondary col-sm-1" type="button" id="">&lt; save</button>
          </div>
          
          <div class="mb-3 row" id='target-place'>
            <label for="place" class="col-sm-1 col-form-label text-end">Place:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control text-black" id="place" value="<?=h($item_data['place'])?>">
            </div>
            <button class="btn btn-outline-secondary col-sm-1" type="button" id="" data-id='<?=$id?>'>&lt; save</button>
          </div>
        </div>
        
        
        
        <div class='col-2 text-light border border-light p-1'>
          <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">name:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext text-light" value="111">
            </div>
          </div>
          
          <div class="mb-3 row">
            <label for="title 1C" class="col-sm-2 col-form-label">title 1C:</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext text-light" value="111">
            </div>
          </div>
        </div>
    </div>
</div>





<div class="container-fluid my-3 col-10">
 <p>
     initial count = <?=isset($result[0]['initial count']) ?: 0;?>
 </p>
 
 <table class="table table-dark border border-secondary table-hover text-center" id='table'>
  <thead>
    <tr>
      <th scope="col"><?=$lang['id']?></th>
      <th scope="col"><?=$lang['date']?></th>
      <th scope="col"><?=$lang['order']?></th>
      <th scope="col"><?=$lang['name']?></th>
      <th scope="col"><?=$lang['count']?></th>
      <!--<th scope="col"><?php //$lang['total count']?></th>-->
      <th scope="col"><?=$lang['flag']?></th>
      <th scope="col"><?=$lang['title verified']?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <!--<td><?=$count?></td>-->
      <td></td>
      <td></td>
    </tr>
        
    <?php foreach($result as $item): ?>
        <tr>
          <td><?=$item['id'];?></td>
          <td><?=$item['event date'];?></td>
          <td><a href='order?id=<?=$item['order_number'];?>' target='_blank'><?=$item['order_number'];?></a></td>
          <td><?=$item['name'];?></td>
          <?php if (($item['order_number'] == 'Приход') || ($item['flag'] == '5')): ?>
              <td>+<?=$item['count']?></td>
          <!--    <td><?php //$count += $item['count']; echo $count; ?></td>-->
          <?php else: ?>
              <td>-<?=$item['count']?></td>
          <!--    <td><?php //$count -= $item['count']; echo $count; ?></td>-->
          <?php endif; ?>
          <td><a href='flags?flag=<?=$item['flag'];?>' target='_blank'><?=$str_flag[$item['flag']]?></a></td>
          
          <?php if ($item['verified'] != 0): ?>
              <td>
                  <button type="button" class="btn btn-success mx-2" data-item-id='<?=$id?>' data-id='<?=$item['id'];?>' data-verified='1'><?=$lang['verified']?></button>
              </td>
          <?php else: ?>
              <td>
                  <button type="button" class="btn btn-warning mx-2" data-item-id='<?=$id?>' data-id='<?=$item['id'];?>' data-verified='0'><?=$lang['not verified']?></button>
              </td>
          <?php endif; ?>
          
        </tr>
    <?php endforeach; ?>

  </tbody>
</table>

 <p>
     current count = <?=$count?>
 </p>
 
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
            
            // edit count-fact:
            let target_count_fact = document.getElementById('target-count-fact');
            let btn_target_count_fact = target_count_fact.querySelector('button');
            
            btn_target_count_fact.addEventListener('click', function(){
                let count_fact_value = target_count_fact.querySelector('input').value;
                $.post('ajax/item/edit', {id: btn_target_count_fact.dataset.id, field: 'fact', value: count_fact_value}, function(data){
                    console.log(JSON.parse(data));
                });
            });
            // edit place:
            let target_place = document.getElementById('target-place');
            let btn_target_place = target_place.querySelector('button');
            
            btn_target_place.addEventListener('click', function(){
                let place_value = target_place.querySelector('input').value;
                $.post('ajax/item/edit', {id: btn_target_place.dataset.id, field: 'place', value: place_value}, function(data){
                    console.log(JSON.parse(data));
                });
            });
        }
    </script>
</body>
</html>











































