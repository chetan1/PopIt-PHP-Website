<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
    </head>
    <body>
        <div id="header">
            <div class="container-fluid">
                <div class="row-fluid">
                    <h1>
                        <a href="<?= $this->createAbsoluteUrl('site/index') ?>">
                            <?= Yii::app()->name ?>
                        </a>
                    </h1>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container-fluid">
                <?php echo $content; ?>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                Copyright &copy; <?php echo date('Y'); ?> <?= Yii::app()->name ?>. All rights reserved.
            </div>
        </div><!-- footer -->
        <script>
            $(document).ready(function(){
                var defaultSearchVal = "Type something..."
                $('.searchClickClear').focus(function(){
                    curDefaultVal = $(this).val();
                    if(curDefaultVal==defaultSearchVal)
                        $(this).val('');
                });

                $('.searchClickClear').blur(function(){
                    if ($(this).val() == "") {
                        $(this).val(defaultSearchVal);
                    }
                });
            });
        </script>
        </div><!-- footer -->
    </body>
</html>
