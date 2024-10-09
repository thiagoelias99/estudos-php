<?php

require_once __DIR__ . "/html-start.php";
?>
<main class="container">
  <form
    enctype="multipart/form-data"
    class="container__formulario"
    method="post">
    <input type="hidden" name="id" value="<?= $id ?>" />
    <h2 class="formulario__titulo">Envie um vídeo!</h3>
      <div class="formulario__campo">
        <label class="campo__etiqueta" for="url">Link embed</label>
        <input name="url" value="<?= $url ?>" class="campo__escrita" required
          placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
      </div>

      <div class="formulario__campo">
        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
        <input name="titulo" value="<?= $titulo ?>" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
          id='titulo' />
      </div>

      <div class="formulario__campo">
        <label class="campo__etiqueta" for="image">Imagem do vídeo</label>
        <input name="image"
          accept="image/*"
          type="file"
          class="campo__escrita"
          id='image' />
      </div>

      <input class="formulario__botao" type="submit" value="Enviar" />
  </form>
</main>
<?php require_once __DIR__ . "/html-end.php";
