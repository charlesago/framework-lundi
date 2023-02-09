<?php foreach ($films as $film) :  ?>



    <div class="post mt-3">
        <h3><?= $film->getTitle() ?></h3>
        <p><?= $film->getSynopsis() ?></p>
        <img width="50px" class="img " src="images/<?= $film->getImage() ?>" alt="">
        <a href="index.php?type=film&action=show&id=<?= $film->getId() ?>" class="btn btn-success">Voir</a>
    </div>

<?php endforeach; ?>