<?php

namespace Controllers;

use App\File;
use Attributes\DefaultEntity;
use Attributes\UsesEntity;
use Entity\Comment;
use Entity\Film;
use Repositories\FilmRepository;

#[DefaultEntity(entityName: Film::class)]

class FilmController extends AbstractController
{


    public function index()
    {


        return $this->render("films/index", [
            "films" => $this->repository->findAll(),
            "pageTitle" => "accueil du blog"
        ]);

    }

    public function show()
    {
        $id = null;
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!$id) {
            return $this->redirect();
        }

        $film = $this->repository->findById($id);

        if(!$film){ return $this->redirect();}

        $commentRepository = $this->getRepository(Comment::class);

        $comment = $commentRepository->findAllByFilm($film);

        return $this->render("films/show", [
            "pageTitle" => $film->getTitle(),
            "film" => $film,
            "comment"=>$comment,
        ]);
    }

    public function create()
    {

        $image = null;
        $title = null;
        $synopsis = null;

        if (!empty($_POST['title'])) {
            $title = htmlspecialchars($_POST['title']);
        }
        if (!empty($_POST['synopsis'])) {
            $synopsis = htmlspecialchars($_POST['synopsis']);
        }
        if (!empty($_POST['image'])) {
            $image = htmlspecialchars($_POST['image']);
        }

            if ($title && $synopsis) {

                $image = new File("image");

                $film = new Film();


                $film->setTitle($title);
                $film->setSynopsis($synopsis);


        if ($image->isImage()){$image->upload();

           $film->setImage($image->getName());

        };

                $this->repository->insert($film);


                return $this->redirect();

            }
            return $this->render("films/create", ["pageTitle" => "nouveau post"]);
        }


    public function remove()
    {
        $id = null;
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!$id) {
            return $this->redirect();
        }
        $film = $this->repository->findById($id);
        if(!$film){ return $this->redirect();}

            $this->repository->delete($film);


        return $this->redirect();
    }
}