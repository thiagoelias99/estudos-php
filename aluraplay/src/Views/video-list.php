<?php

use App\Entity\Video;

/** @var Video[] $videos */

$this->layout("layout");
?>
<ul class="videos__container" alt="videos alura">
  <?php foreach ($videos as $video) : ?>
    <li class="videos__item">
      <?php if ($video->getFilePath() !== null): ?>
        <a href="<?= $video->url; ?>">
          <img src="img/uploads/<?= $video->getFilePath(); ?>" alt="" style="width: 100%" />
        </a>
      <?php else: ?>
        <iframe width="100%" height="72%" src="<?= $video->url ?>"
          title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      <?php endif; ?>
      <div class="descricao-video">
        <h3><?= $video->title ?></h3>
        <div class="acoes-video">
          <form action="/editar-video">
            <input type="hidden" name="id" value="<?= $video->id ?>" />
            <button type="submit">Editar</button>
          </form>
          <form action="/remover-video" method="post">
            <input type="hidden" name="id" value="<?= $video->id ?>" />
            <button type="submit">Excluir</button>
          </form>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>