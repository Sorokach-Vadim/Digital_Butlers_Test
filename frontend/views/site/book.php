<?php
/** @var array $books */
/** @var array $authors */
?>
Книги
<?php foreach ($books as $book):?>
    <p><?= $book->title?> <?= $book->year_publication?></p>
<?php endforeach;?>
Авторы
<?foreach ($authors as $book):?>
    <p><?= $book->name?> <?= $book->born_year?></p>
<?php endforeach;?>