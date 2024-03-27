<?php
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
?>

<?php require VIEWS.'/incs/header.tpl.php'; ?>
    
    <main class='main'>
        <!--CONTENT-->
        <div class="container-fluid my-0 px-0">
         <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th scope="col"><?=$lang['id']?></th>
              <th scope="col"><?=$lang['Name']?></th>
              <!--<th scope="col"><?php //echo $lang['sort']?></th> -->
              <!--<th scope="col"><?=$lang['initial count']?></th>-->
              <!--<th scope="col"><?=$lang['current count']?></th>-->
              <th scope="col"><?=$lang['separate in order']?></th>
              <th scope="col"><?=$lang['fact']?></th>
              <th scope="col"><?=$lang['Count 1C']?></th>
              <th scope="col"><?=$lang['difference']?></th>
              <th scope="col"><?=$lang['Place']?></th>
            </tr>
          </thead>
          <tbody>
            
            <?php foreach($result as $item): ?>
                <tr>
        
                  <th scope="row"><?=$item['id'];?></th>
                  <td>
                      <a href='item?id=<?=$item['id'];?>' target='_blank'>
                        <?=h($item['name']);?>
                      </a>
                  </td>
                  <!--<td><?php //echo $item['sort']; ?></td> -->
                  <!--<td><?=$item['initial count'];?></td>-->
                  <!--<td><?=$item['current count'];?></td>-->
                  <td><?=$item['separate in order'];?></td>
                  <td><?=$item['fact'];?></td>
                  <td style='color: #FFBF00;'><?=$item['count_1c'];?></td>
                  <?php if (($item['fact']+$item['separate in order'])>$item['count_1c']): ?>
                    <td style="color: blue;"><?=($item['fact']+$item['separate in order']-$item['count_1c'])?></td>
                  <?php elseif(($item['fact']+$item['separate in order'])==$item['count_1c']): ?>
                    <td style="color: green;"><?=0?></td>
                  <?php else: ?>
                    <td style="color: red;"><?=($item['fact']+$item['separate in order']-$item['count_1c'])?></td>
                  <?php endif; ?>
                  <td><?=h($item['place']);?></td>
        
                </tr>
            <?php endforeach; ?>
        
          </tbody>
        </table>
        </div>        
    </main>
    
<?php require VIEWS.'/incs/footer.tpl.php'; ?>
<script type="text/javascript">
    // search
    const searchField = document.getElementById('search');
    // console.log(searchField);
    searchField.addEventListener('input',(e) => {
        let search = e.target.value.trim();
        if (search.length > 1)
        {
            // console.log('search = ',search);
            // d(search,'search');
            fetch('search', {
                method: 'POST',
                body: JSON.stringify({search: search})
            })
                .then(response => response.text())
                .then(data => {
                    document.querySelector('tbody').innerHTML = data;
                });
        }
        
    });
    
</script>
</body>
</html>