
<a href="/backend/web/index.php?r=site%2Fcreatebook">Добавить книгу</a><br>
<?php foreach ($var as $book):?>
    <p>
        <?= $book->title?> <?= $book->year_publication?> <a href="/backend/web/index.php?r=site%2Fupdatebook&book_id=<?=$book->id?>">Редактировать</a><a href="/backend/web/index.php?r=site%2Fdeletebook&book_id=<?=$book->id?>">Удалить</a>
    </p>
<?php endforeach;?>
