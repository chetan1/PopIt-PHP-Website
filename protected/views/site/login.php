<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Login</h1><br />

<p>Please fill out the following form with your login credentials:</p><br />
<? if($error): ?>
    <div class="alert alert-error">
      Please check your email and password.
    </div>
<? endif; ?>
<div class="form">
    <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'login-form',
            'type' => 'horizontal',
            'htmlOptions' => array('class' => 'well'),
            'enableClientValidation' => true,
            'clientOptions' => array(
            'validateOnSubmit' => true,
            ),
        ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->textFieldRow($model, 'email', array('prepend'=>'@')); ?>
    <?php echo $form->passwordFieldRow($model, 'password'); ?>
    <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
    <?php echo CHtml::htmlButton('<i class="icon-ok icon-white"></i> Login', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<?php
    Yii::app()->clientScript->registerScript('forgot-password', "
    $('#forgotPassword').click(function(){
            var email = $('#LoginForm_email').val();
            if(email == '')
            {
                alert('Please enter your email id')
                $('#LoginForm_email').focus();
            }
            else
            {
                var url = '" . $this->createAbsoluteUrl('site/login', array('forgot' => 1, 'email' => '')) . "' + email;
                document.location = url;
            }
    });

", CClientScript::POS_READY);
?>