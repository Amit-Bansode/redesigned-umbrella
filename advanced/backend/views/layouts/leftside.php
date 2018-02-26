<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
        <?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p><?php
        if (FALSE == yii::$app->user->isGuest) {
            echo yii::$app->user->identity->username;
        }
        ?></p>

            </div>
        </div>-->
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard',
                            'url' => ['/'], 'active' => $this->context->route == 'site/index'
                        ],
                        [
                            'label' => 'Job Posts',
                            'icon' => 'fa fa-book',
                            'url' => ['/job-posts'],
                            'active' => $this->context->route == 'job-posts/index',
                        ],
                        [
                            'label' => 'Documents',
                            'icon' => 'fa fa-book',
                            'url' => ['/documents'],
                            'active' => $this->context->route == 'documents/index',
                        ],
                        [
                            'label' => 'Admin Users',
                            'icon' => 'fa fa-users',
                            'url' => ['/users'],
                            'active' => $this->context->route == 'users/index',
                        ],
                        [
                            'label' => 'Customers',
                            'icon' => 'fa fa-users',
                            'url' => ['/customers'],
                            'active' => $this->context->route == 'customers/index',
                        ],
                        [
                            'label' => 'Applied Jobs',
                            'icon' => 'fa fa-users',
                            'url' => ['/applied-jobs'],
                            'active' => $this->context->route == 'applied-jobs/index',
                        ],
                    /* [
                      'label' => 'Master',
                      'icon' => 'fa fa-database',
                      'url' => '#',
                      'items' => [
                      [
                      'label' => 'Master1',
                      'icon' => 'fa fa-database',
                      'url' => '?r=master1/',
                      'active' => $this->context->route == 'master1/index'
                      ],
                      [
                      'label' => 'Master2',
                      'icon' => 'fa fa-database',
                      'url' => '?r=master2/',
                      'active' => $this->context->route == 'master2/index'
                      ]
                      ]
                      ],
                      [
                      'label' => 'Users',
                      'icon' => 'fa fa-users',
                      'url' => ['/user'],
                      'active' => $this->context->route == 'user/index',
                      ],
                      ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                      ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],], */
                    ],
                ]
        )
        ?>

    </section>
    <!-- /.sidebar -->
</aside>
