


<div class="film mt-5 ">
    <h3><?= $film->getTitle() ?></h3>
    <p><?= $film->getSynopsis() ?></p>
    <img width="50px" src="images/<?=$film->getImage()?>" alt=""> <br>
    <a href="index.php" class="btn btn-primary">Retour</a>
    <a href="index.php?type=film&action=remove&id=<?= $film->getId() ?>" class="btn btn-danger">supprimer</a>
</div>


<?php foreach ($comment as $comment) : ?>

    <hr>

    <p><strong><?= $comment->getContent() ?></strong></p>
    <a href="?type=comment&action=remove&id=<?= $comment->getId() ?>" class="btn btn-danger">supprimer</a>
    <a href="?type=comment&action=update&id=<?= $comment->getId() ?>" class="btn btn-warning">modifier</a>

    <hr>


<?php endforeach; ?>

<form method="post" class="form" action="?type=comment&action=create">
    <input class="form-control"  type="text" name="content" placeholder="add a comment">
    <input name="film_id" class="form-control" type="hidden" value="<?= $film->getId() ?>">
    <button class="btn btn-success" type="submit">Send</button>
</form>
