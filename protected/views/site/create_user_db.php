<?php $this->pageTitle=Yii::app()->name; ?>

<h1>user.db is missing</h1>

<p>Hello,<br />
we were unable to create/recreate for you the file
<b><?php echo Yii::app()->params['user_db']; ?></b>.</p>

<p>Please allow write permissions to the folder
<b><?php echo dirname(Yii::app()->params['user_db']); ?></b> and eventually to the
<b><?php echo Yii::app()->params['user_db']; ?></b> file or just copy your
<b><?php echo Yii::app()->params['factory_db']; ?></b> to
<b><?php echo Yii::app()->params['user_db']; ?></b>.</p>

<p>The <b><?php echo Yii::app()->params['user_db']; ?></b> will be used for your
local playground and you can reset it anytime to factory defaults overwriting it
with the <b><?php echo Yii::app()->params['factory_db']; ?></b> file.</p>

<p>When you're done, just refresh this page.</p>