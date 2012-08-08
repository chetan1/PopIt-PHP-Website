<?php
$this->pageTitle = Yii::app()->name . ' - Change Password';
$this->breadcrumbs = array(
    'Change Password',
);
?>

<h1>Change Password</h1><br />
<form class="well form-horizontal span6" method="post">
    <p>Please fill out the following form with your old password and new password:</p>
    <? if(count($error)): ?>
        <div class="alert alert-error">
          <? foreach($error as $e): ?>
            <li><?= $e ?></li>
          <? endforeach; ?>
        </div>
    <? elseif(count($_POST)>0): ?>
        <div class="alert alert-success">
          Success. Your password has been changed.
        </div>
    <? endif; ?><br />
    <div class="control-group">
      <label class="control-label">Old Password</label>
      <div class="controls">
        <input type="password" class="input-xlarge" name="old">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">New Password</label>
      <div class="controls">
        <input type="password" class="input-xlarge" name="new">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Confirm Password</label>
      <div class="controls">
        <input type="password" class="input-xlarge" name="confirm">
      </div>
    </div><br />
    <div class="offset1">
        <button type="submit" class="btn btn-inverse"><i class="icon-ok icon-white"></i> Change Password</button>
    </div><br />
</form>