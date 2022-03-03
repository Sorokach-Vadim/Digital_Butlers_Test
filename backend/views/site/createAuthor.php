<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>
<?php echo $form->field($model, 'name')->textInput()?>
<?php echo $form->field($model, 'born_year')->textInput()?>
<?php echo  Html::submitButton('Save', ['class' => 'btn'])?>
<?php ActiveForm::end();?>


