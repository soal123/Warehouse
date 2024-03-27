<?php require VIEWS.'/incs/header.tpl.php'; ?>

<div class="container-fluid my-3 col-3">

<div class='text-center my-4'>
    <button type='button' class='btn btn-success w-100' id='create-button'><?=$lang['add order']?></button>
</div>

 <table id='table' class="table table-dark border border-secondary table-hover text-center">
  <thead>
    <tr>
      <th scope="col"><?=$lang['order number']?></th>
      <th scope="col"><?=$lang['order shipped']?></th>
      <th scope="col"><?=$lang['action']?></th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($result as $item): ?>
    
        <?php if ($item['order shipped'] == 1): ?>
          <tr>
            <td><a href='order?id=<?=$item['order number'];?>' target='_blank'><?=$item['order number'];?></a></td>
            <td style="color: Gray;" data-order='<?=$item['order number'];?>'>отгружен</td>
            <td>
                <button type="button" class="btn btn-secondary mx-2" data-order='<?=$item['order number'];?>' data-shipped='1'>отменить</button>
            </td>
          </tr>
        <?php else: ?>
          <tr>
            <td><a href='order?id=<?=$item['order number'];?>' target='_blank'><?=$item['order number'];?></a></td>
            <td style="color: Lime;" data-order='<?=$item['order number'];?>'>комплектуется</td>
            <td>
                <button type="button" class="btn btn-success mx-2" data-order='<?=$item['order number'];?>' data-shipped='0'>отгрузить</button>
            </td>
          </tr>
        <?php endif; ?>
          
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
            document.getElementById('create-button').addEventListener('click',function()
            {

                
                $.post('ajax/order/create', function(data)
                {
                    if (data != false)
                    {
                        let answer = JSON.parse(data);
                        console.log(answer);
                        
                        let new_order = document.createElement('tr');
                        new_order.innerHTML = '<td><a href="order?id=' + answer + '" target="_blank">' + answer + '</a></td><td style="color: Lime;" data-order="' + answer + '">комплектуется</td><td><button type="button" class="btn btn-success mx-2" data-order="' + answer + '" data-shipped="0">отгрузить</button></td>';
                        
                        document.querySelector('tbody').prepend(new_order);
                        let new_button = new_order.querySelector('button');
                        console.log('new_button = ',new_button);
                        new_button.addEventListener('click', function(e)
                        {
                            // console.log(this.dataset.order, this.dataset.shipped);
                            // console.log('this = ',this); // this is button element
                            $.post('ajax/order', {order: this.dataset.order, shipped: this.dataset.shipped}, function(data)
                            {
                                let arr = JSON.parse(data);
                                
                                // console.log('arr = ',arr);
                                // console.log(e.target.parentElement.parentElement.childNodes[1]);

                                // console.log(e);
                                if (arr[1] == true)
                                {
                                    e.target.classList.replace('btn-success','btn-secondary');
                                    e.target.innerHTML = 'отменить';
                                    e.target.dataset.shipped = 1;
                                    e.target.parentElement.parentElement.childNodes[1].innerHTML = 'отгружен';
                                    e.target.parentElement.parentElement.childNodes[1].style.color = 'Gray';
                                }
                                else
                                {
                                    e.target.classList.replace('btn-secondary','btn-success');
                                    e.target.innerHTML = 'отгрузить';
                                    e.target.dataset.shipped = 0;
                                    e.target.parentElement.parentElement.childNodes[1].innerHTML = 'комплектуется';
                                    e.target.parentElement.parentElement.childNodes[1].style.color = 'Lime';
                                }
                            });
                        });

                    }
                    
                    
                });

            });
            let array = document.getElementById('table').querySelectorAll('button');
            

            for (let i = 0; i < array.length; i++)
            {
                array[i].addEventListener('click', function(e)
                    {
                        // console.log(this.dataset.order, this.dataset.shipped);
                        console.log(this); // this is button element
                        $.post('ajax/order', {order: this.dataset.order, shipped: this.dataset.shipped}, function(data)
                            {
                                let arr = JSON.parse(data);
                                
                                // arr[0] - order number
                                // arr[1] - order shipped
                                
                                // console.log($('td[data-order='+arr[0]+']').css('color','Lime'));
                                // console.log($('td[data-order='+arr[0]+']').parent().html());
                                // console.log($('td[data-order='+arr[0]+']').text());
                                
                                // console.log('e.target.parentElement.parentElement.childNodes[0] = ',e.target.parentElement.parentElement.childNodes[0]);
                                // console.log(e);
                                if (arr[1] == true)
                                {
                                    e.target.classList.replace('btn-success','btn-secondary');
                                    e.target.innerHTML = 'отменить';
                                    e.target.dataset.shipped = 1;
                                    e.target.parentElement.parentElement.childNodes[3].innerHTML = 'отгружен';
                                    e.target.parentElement.parentElement.childNodes[3].style.color = 'Gray';
                                    
                                    // $(array[arr[0]-1]).addClass('btn-secondary');
                                    // $(array[arr[0]-1]).removeClass('btn-success');
                                    // $(array[arr[0]-1]).text('отменить');
                                    // $('td[data-order='+arr[0]+']').css('color','Gray');
                                    // $('td[data-order='+arr[0]+']').text('отгружен');
                                    // array[arr[0]-1].dataset.shipped = 1;
                                }
                                else
                                {
                                    e.target.classList.replace('btn-secondary','btn-success');
                                    e.target.innerHTML = 'отгрузить';
                                    e.target.dataset.shipped = 0;
                                    e.target.parentElement.parentElement.childNodes[3].innerHTML = 'комплектуется';
                                    e.target.parentElement.parentElement.childNodes[3].style.color = 'Lime';
                                    
                                    // console.log('dot 02');
                                    // $(array[arr[0]-1]).addClass('btn-success');
                                    // $(array[arr[0]-1]).removeClass('btn-secondary');
                                    // $(array[arr[0]-1]).text('отгрузить');
                                    // $('td[data-order='+arr[0]+']').css('color','Lime');
                                    // $('td[data-order='+arr[0]+']').text('комплектуется');
                                    // array[arr[0]-1].dataset.shipped = 0;
                                }
                            });
                    });
            }
            
        }
    </script>
</body>
</html>