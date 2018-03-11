<?php

use yii\helpers\Html;
use yii\helpers\Url;

$notifications = $this->params['arrmixReturnNotification'];
?>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><?= $title ?></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= $title ?></b> Administrator</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning"><?= $notifications['count']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?= $notifications['count']; ?> notification(s) today.</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    <?php
                                    unset($notifications['count']);
                                    foreach ($notifications AS $intNotificationTypeId => $notification) {
                                        $strStyleClass = '';
                                        $strDisplayString = '';
                                        $strUrl = '';
                                        if (\app\models\Notifications::REGISTRATION == $intNotificationTypeId) {
                                            $strStyleClass = 'fa fa-users text-aqua';
                                            $strDisplayString = $notification . 'new members joined today';
                                            $strUrl = Url::toRoute(['/customers']);
                                        } elseif (\app\models\Notifications::APPLIED_FOR_JOB == $intNotificationTypeId) {
                                            $strStyleClass = 'fa fa-warning text-yellow';
                                            $strDisplayString = $notification . 'members applied for job.';
                                            $strUrl = Url::toRoute(['/applied-jobs']);
                                        }
                                        ?>
                                        <li>
                                            <a href="<?= $strUrl ?>">
                                                <i class="<?= $strStyleClass ?>"></i> <?= $strDisplayString ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li class="footer"><a href="?r=notifications">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs">
                                <?= yii::$app->user->identity->username; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    <?= yii::$app->user->identity->username; ?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!--<li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">                      
                                    <a href="?r=site/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>

                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </nav>
</header>
