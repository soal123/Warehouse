<?php
$sql = "SELECT `id`, `name`, `initial count`, `current count`, `count_1c`, `place` FROM `accessories` ORDER BY `name` ASC";
// ff($sql, 'sql');
$result = $db->query($sql)->findAll();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="assets/styles.css" rel="stylesheet">
  </head>

<body>

<div class="container-fluid my-3">
 <table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">initial count</th>
      <th scope="col">current count</th>
      <th scope="col">Count 1C</th>
      <th scope="col">Place</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach($result as $item): ?>
        <tr>

          <th scope="row"><?=$item['id'];?></th>
          <td>
              <a href='/' target='_blank'>
                <?=$item['name'];?>
              </a>
          </td>
          <td><?=$item['initial count'];?></td>
          <td><?=$item['current count'];?></td>
          <td><?=$item['count_1c'];?></td>
          <td><?=$item['place'];?></td>

        </tr>
    <?php endforeach; ?>

  </tbody>
</table>
 
 
</div>















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>