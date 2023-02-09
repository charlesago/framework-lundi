<?php

namespace Controllers;

use Attributes\DefaultEntity;
use Entity\Comment;
use Entity\Film;



#[DefaultEntity(entityName: Comment::class)]
class CommentController extends AbstractController
{

    protected string $defaultEntityName = Comment::class;
    public function create(){
        $content = null;
        $film_id = null;

        if (!empty($_POST['film_id']) && ctype_digit($_POST["film_id"])){
            $film_id = $_POST['film_id'];

        }

        if (!empty($_POST['content'])){
            $content = htmlspecialchars($_POST["content"]) ;
        }


        if ($content && $film_id){

            $filmEntity = new Film();


            $film= $this->getRepository(Film::class)->findById($film_id);

            if (!$film){
                return $this->redirect();
            }

            $comment = new Comment();
            $comment->setContent($content);
            $comment->setFilmId($film_id);

            $this->getRepository(Comment::class)->insert($comment);

            return $this->redirect([
                "type"=>"film",
                "action"=>"show",
                "id"=>$film->getId()
            ]);
        }
    }
    public function remove(){

        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){  return $this->redirect(); }

        $comment = $this->repository->findById($id);

        if(!$comment){  return $this->redirect(); }

        $this->repository->delete($comment);

        return $this->redirect([
            "type"=>"film",
            "action"=>"show",
            "id"=>$comment->getFilmId()
        ]);


    }

    public function update(){

        $id = null;
        $content = null;

        if(!empty($_POST['id']) && ctype_digit($_POST['id'])){
            $id = $_POST['id'];
        }

        if(!empty($_POST['content'])){
            $content = htmlspecialchars($_POST['content']);
        }

        if($id && $content){

            $comment = $this->repository->findById($id);

            if(!$comment){  return $this->redirect(); }

            $comment->setContent($content);

            $this->repository->update($comment);

            return $this->redirect([
                "type"=>"comment",
                "action"=>"update",
                "id"=>$comment->getFilmId()
            ]);

        }


        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){  return $this->redirect(); }

        $comment = $this->repository->findById($id);

        if(!$comment){  return $this->redirect(); }


        return $this->render('comments/update', [
            "comment"=>$comment,
            "pageTitle"=> "Modifier votre comment",

        ]);

    }
}