
<a href="/backend/web/index.php?r=site%2Fcreateauthor">Добавить автора</a><br>
<?php foreach ($var as $author):?>
    <p>
        <?= $author->name?> <?= $author->born_year?> <a href="/backend/web/index.php?r=site%2Fupdateauthor&author_id=<?=$author->id?>">Редактировать</a><a href="/backend/web/index.php?r=site%2Fdeleteauthor&author_id=<?=$author->id?>">Удалить</a>
    </p>
<?php endforeach;?>
