<?php
$strStyle = '';

if( Yii::$app->user->isGuest ) {
    $strStyle = 'style="margin-left: 0px !important;"';
}

?>
<footer class="main-footer" <?= $strStyle ?>>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href=""></a>.</strong> All rights reserved.
</footer>