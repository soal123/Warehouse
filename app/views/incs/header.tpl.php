<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <base href='<?=PATH?>/'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="assets/styles.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
  </head>

<body class='bg-black'>



<div class='wrapper'>
        
<header class='header mb-3'>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="https://github.com/soal123/Warehouse" target='_blank'>GitHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav col me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/"><?=$lang['Home']?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="orders"><?=$lang['Orders']?></a>
        </li>
        
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Show
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li class="nav-item">
              <a class="dropdown-item" aria-current="page" href="movements" target='_blank'><?=$lang['Movements']?></a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=1" target='_blank'>In work</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=2" target='_blank'>Separate</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=3" target='_blank'>Fastener</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=4" target='_blank'>Movement</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=5" target='_blank'>Arrival</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=6" target='_blank'>Needs production</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=7" target='_blank'>Needs store</a>
            </li>
            <li>
              <a class="dropdown-item" aria-current="page" href="flags?flag=8" target='_blank'>Needs office</a>
            </li>
          </ul>
        </li>
        
        <?php if ($_SESSION['user role'] == 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="movement/create"><?=$lang['new Movement']?></a>
            </li>
            
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link active" aria-current="page" href="compare"><?=$lang['Compare']?></a>-->
            <!--</li>-->
            
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link active" aria-current="page" href="verification"><?=$lang['Verification']?></a>-->
            <!--</li>-->
            
            <li class="nav-item dropdown">
              <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
              </button>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li class="nav-item">
                  <a class="dropdown-item" aria-current="page" href="compare"><?=$lang['Compare']?></a>
                </li>
                <li>
                  <a class="dropdown-item" aria-current="page" href="verification"><?=$lang['Verification']?></a>
                </li>
                <li>
                  <a class="dropdown-item" aria-current="page" href="inventory">Inventory<?=$lang['Inventory']?></a>
                </li>
              </ul>
            </li>
            
        <?php endif; ?>
        
      </ul>
      
      
      
      <ul class="navbar-nav me-4">
        <select class='form-select'>
          <!--<option selected>Choose language</option>-->
          <option value="en"<?=($_SESSION['language'] == 'en') ? ' selected' : ''?>>english</option>
          <option value="ru"<?=($_SESSION['language'] == 'ru') ? ' selected' : ''?>>russian</option>
        </select>
      </ul>

      <form class="d-flex" role="search">
        <!--<input class="form-control me-2" id='search2' type="search" placeholder="" aria-label="Search">-->

        <div class="input-group">
          <input type="search" class="form-control" id='search' placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="button" id="button-addon2">x</button>
        </div>
        <!--<button class="btn btn-outline-success" type="submit" disabled><?=$lang['Search']?></button>-->
      </form>

      <?php if ($_SESSION['user role'] == 'admin'): ?>
          <ul class="navbar-nav ms-4 mb-2 mb-lg-0">
            <li class="nav-item">
                <?=$lang['Admin']?>
            </li>
          </ul>
          <ul class="navbar-nav mx-4 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="logout"><?=$lang['Logout']?></a>
            </li>
          </ul>
      <?php else: ?>
          <ul class="navbar-nav mx-4 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="login"><?=$lang['Login']?></a>
            </li>
          </ul>
      <?php endif; ?>

    </div>
  </div>
</nav>

</header>
    
    <?php get_alerts(); ?>