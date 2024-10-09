<?php

require_once __DIR__ . "/html-start.php";
?>
<main class="container">

  <form class="container__formulario" method="post">
    <h2 class="formulario__titulo">Efetue login</h3>
      <div class="formulario__campo">
        <label class="campo__etiqueta" for="usuario">Usuario</label>
        <input name="usuario" class="campo__escrita" required
          placeholder="Digite seu usuário" id='usuario' />
      </div>


      <div class="formulario__campo">
        <label class="campo__etiqueta" for="senha">Senha</label>
        <input type="password" name="senha" class="campo__escrita" required placeholder="Digite sua senha"
          id='senha' />
      </div>

      <input class="formulario__botao" type="submit" value="Entrar" />
  </form>
</main>
<?php require_once __DIR__ . "/html-end.php";
