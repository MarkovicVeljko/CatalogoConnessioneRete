<div class="container">
  <h2>Accedi per procedere</h2>
  <form class="form-horizontal" action="login/run" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Nome utente:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nome_login" placeholder="Inserisci il nome utente" name="nome_login">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pass">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pass" placeholder="Inserisci la password" name="pass">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Accedi</button>
      </div>
    </div>
  </form>
</div>