<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use backend\models\Book;
use backend\models\Author;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'books', 'createbook', 'updatebook', 'deletebook', "authors", 'createauthor', 'updateauthor', 'deleteauthor'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBooks()
    {
        return $this->render('books', ["var" => Book::getAll()]);
    }

    public function actionCreatebook()
    {
        $var = new Book();
        $selectAuthor = [];
        foreach (Author::getAll() as $author) {
            $selectAuthor[$author->id] = $author->name;
        }

        if (!empty($_POST["Book"])) {
            $var->title = $_POST["Book"]["title"];
            $var->year_publication = $_POST["Book"]["year_publication"];
            $var->author_id = $_POST["Book"]["author_id"];
            if ($var->validate() && $var->save()) {
                return $this->render('books', ["var" => Book::getAll()]);
            }
        }

        return $this->render('createBook', ["model" => $var , "selectauthor" => $selectAuthor]);
    }

    public function actionUpdatebook()
    {
        if ($_REQUEST["book_id"]) {
            $var = Book::findOne($_REQUEST["book_id"]);
        } else {
            return $this->render('books', ["var" => Book::getAll()]);
        }

        if (!empty($_POST["Book"])) {
            $var->title = $_POST["Book"]["title"];
            $var->year_publication = $_POST["Book"]["year_publication"];
            $var->author_id = $_POST["Book"]["author_id"];
            if ($var->validate() && $var->save()) {
                return $this->render('books', ["var" => Book::getAll()]);
            }
        }

        return $this->render('createBook', ["model" => $var]);
    }

    public function actionDeletebook()
    {
        if ($_REQUEST["book_id"]) {
            $var = Book::findOne($_REQUEST["book_id"])->delete();
        } else {
            return $this->render('books', ["var" => Book::getAll()]);
        }

        return $this->render('books', ["var" => Book::getAll()]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAuthors()
    {
        return $this->render('authors', ["var" => Author::getAll()]);
    }

    public function actionCreateauthor()
    {
        $var = new Author();

        if (!empty($_POST["Author"])) {
            $var->name = $_POST["Author"]["name"];
            $var->born_year = $_POST["Author"]["born_year"];
            if ($var->validate() && $var->save()) {
                return $this->render('authors', ["var" => Author::getAll()]);
            }
        }

        return $this->render('createAuthor', ["model" => $var ]);
    }

    public function actionUpdateauthor()
    {
        if ($_REQUEST["author_id"]) {
            $var = Author::findOne($_REQUEST["author_id"]);
        } else {
            return $this->render('authors', ["var" => Author::getAll()]);
        }

        if (!empty($_POST["Author"])) {
            $var->name = $_POST["Author"]["name"];
            $var->born_year = $_POST["Author"]["born_year"];
            if ($var->validate() && $var->save()) {
                return $this->render('authors', ["var" => Author::getAll()]);
            }
        }

        return $this->render('createAuthor', ["model" => $var]);
    }

    public function actionDeleteauthor()
    {
        if ($_REQUEST["author_id"]) {
            Author::findOne($_REQUEST["author_id"])->delete();
        } else {
            return $this->render('authors', ["var" => Author::getAll()]);
        }

        return $this->render('authors', ["var" => Author::getAll()]);
    }
}
