<?php require VIEWS.'/incs/header.tpl.php'; ?>
    
<main class='main pb-3'>
    <div class='container col-4'>
        <div class='row'>
            <!--<h3 class='text-center'>New movement</h1>-->
            
<?php
    // d($_POST,'$_POST'); 
    // d(h(old('name')),'old(name)');
?>

    
<form action='' method='post'>

    <div class='mb-2'>
        <label for='flag' class='form-label'><?=$lang['select']?>:</label>
        <select name='flag' class="form-select" size="6" id='flag' aria-label="Size 3 select example">
          <option value="1" selected><?=$lang['in order(to work)']?></option>
          <option value="2"><?=$lang['in order(separate)']?></option>
          <option value="3"><?=$lang['in order(fastener)']?></option>
          <option value="4"><?=$lang['movement']?></option>
          <option value="5"><?=$lang['arrival']?></option>
          <option value="6"><?=$lang['needs production']?></option>
          <option value="7"><?=$lang['needs store']?></option>
          <option value="8"><?=$lang['needs office']?></option>
        </select>
        <?php if(isset($errors['flag'])): ?>
            <div class="invalid-feedback d-block">
                <?=$errors['flag']?>
            </div>
        <?php endif; ?>
    </div>

    <div class='mb-2'>
      <label for='order' class='form-label'><?=$lang['order number']?>:</label>
      <input name='order_number' type='text' class='form-control' id='order' placeholder='<?=$lang['order number']?>' value='<?=old("order_number") ?: ''?>'>
      <?=isset($validation) ? $validation->listErrors('order_number') : ''?>
    </div>
    
    <div class='mb-2'>
      <label for='name' class='form-label'><?=$lang['name']?>:</label>
      <input name='name' type='text' class='form-control' id='name' placeholder='<?=$lang['name']?>' value='<?=old("name") ?: ''?>'>
      <?=isset($validation) ? $validation->listErrors('name') : ''?>
    </div>
    
    <div class='mb-2'>
      <label for='count' class='form-label'><?=$lang['count']?>:</label>
      <input name='count' type='number' class='form-control' id='count' placeholder='0' value='<?=old("count") ?: ''?>'>
      <?=isset($validation) ? $validation->listErrors('count') : ''?>
    </div>
    
    <div class='mb-2'>
        <button type='submit' class='btn btn-primary'><?=$lang['Create movement']?></button>
    </div>

</form>

            
        </div>
    </div>
</main>


<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>