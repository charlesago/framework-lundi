<form   action="?type=comment&action=update" method="post" class="form-control">
    <input type="hidden" name="id" value="<?=$comment->getId() ?>">
    <input type="text" name="content" value="<?=$comment->getContent() ?>">

    <button class="btn btn-success" type="submit">Ok</button>
</form>