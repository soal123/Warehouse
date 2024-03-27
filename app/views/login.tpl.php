<?php require VIEWS.'/incs/header.tpl.php'; ?>
    
<main class='main'>
    <div class='container'>
        <div class='row align-items-end' style='height: 500px;'>
            <h3 class='text-center'>Login page</h3>
            <div class='col-6 offset-3'>


    
<form action='' method='post'>
    
  <div class="mb-3 col">
    <label for="login" class="form-label">Login</label>
    <input name='login' type="text" class="form-control" id="login" aria-describedby="loginHelp">
    <div id="loginHelp" class="form-text">Enter you login.</div>
  </div>
  
  
  <div class="mb-3">
    <label for="exampleInputPassword" class="form-label">Password</label>
    <input name='password' type="password" class="form-control" id="exampleInputPassword">
  </div>
  
  
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck">
    <label name='check' class="form-check-label" for="exampleCheck">Save (not work)</label>
  </div>
  
  <button type="submit" class="btn btn-primary">Login</button>
</form>
                
            </div>
        </div>
    </div>
</main>


<?php require VIEWS.'/incs/footer.tpl.php'; ?>
</body>
</html>