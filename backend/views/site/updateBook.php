<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>
<?php echo $form->field($model, 'title')->textInput()?>
<?php echo $form->field($model, 'year_publication')->textInput()?>
<?php echo $form->field($model, 'author_id')->dropDownList($selectauthor)?>
<?php echo  Html::submitButton('Создать', ['class' => 'btn'])?>
<?php ActiveForm::end();?>


