<?php
    use app\models\User;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
         /.search form -->

        <!-- Navigation Admin -->
        <?php if /*(Yii::$app->user->identity->id_user_role == 1):*/ (User::isAdmin()) { ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/site/index']],
                        ['label' => 'Menu Utama','options' => ['class' => 'header']],
                        [
                            'label' => 'Buku',
                            'icon' => 'book',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Buku', 'icon' => 'book', 'url' => ['/buku/index']],
                                ['label' => 'Kategori', 'icon' => 'cubes', 'url' => ['/kategori/index']],
                                ['label' => 'Peminjaman', 'url' => ['/peminjaman/index']],
                                ['label' => 'Penerbit', 'icon' => 'user','url' => ['/penerbit/index']],
                                ['label' => 'Penulis', 'icon' => 'user','url' => ['/penulis/index']],
                            ],
                        ],
                        ['label' => 'Sistem','options' => ['class' => 'header']],
                        [
                            'label' => 'User',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'User', 'icon' => 'user','url' => ['/user/index']],
                                ['label' => 'User Role', 'icon' => 'user','url' => ['/user-role/index']],
                                ['label' => 'Anggota', 'icon' => 'user','url' => ['/anggota/index']],
                                ['label' => 'Petugas', 'icon' => 'user','url' => ['/petugas/index']],
                            ],
                        ],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Logout','icon' => 'lock', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>', 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php //endif ?>

        <!-- | Navigation Anggota | -->
        <?php } elseif /* if (Yii::$app->user->identity->id_user_role == 2):*/ (User::isAnggota()) { ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/site/index']],
                        ['label' => 'Menu Utama','options' => ['class' => 'header']],
                        [
                            'label' => 'Buku',
                            'icon' => 'book',
                            'url' => '#',
                            'items' => [
                                //['label' => 'Buku', 'icon' => 'book', 'url' => ['/buku/index']],
                                //['label' => 'Kategori', 'icon' => 'cubes', 'url' => ['/kategori/index']],
                                ['label' => 'Peminjaman', 'url' => ['/peminjaman/index']],
                                //['label' => 'Penerbit', 'icon' => 'user','url' => ['/penerbit/index']],
                                //['label' => 'Penulis', 'icon' => 'user','url' => ['/penulis/index']],
                            ],
                        ],
                        // ['label' => 'Sistem','options' => ['class' => 'header']],
                        // [
                        //     'label' => 'User',
                        //     'icon' => 'users',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'User', 'icon' => 'user','url' => ['/user/index']],
                        //         ['label' => 'Anggota', 'icon' => 'user','url' => ['/anggota/index']],
                        //         ['label' => 'Petugas', 'icon' => 'user','url' => ['/petugas/index']],
                        //     ],
                        // ],
                         ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                         ['label' => 'Logout','icon' => 'lock', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>', 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php //endif ?>

        <!-- | Navigation Petugas | -->
        <?php } elseif /* if (Yii::$app->user->identity->id_user_role == 3):*/ (User::isPetugas()) { ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/site/index']],
                        ['label' => 'Menu Utama','options' => ['class' => 'header']],
                        [
                            'label' => 'Buku',
                            'icon' => 'book',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Buku', 'icon' => 'book', 'url' => ['/buku/index']],
                                ['label' => 'Kategori', 'icon' => 'cubes', 'url' => ['/kategori/index']],
                                ['label' => 'Peminjaman', 'url' => ['/peminjaman/index']],
                                ['label' => 'Penerbit', 'icon' => 'user','url' => ['/penerbit/index']],
                                ['label' => 'Penulis', 'icon' => 'user','url' => ['/penulis/index']],
                            ],
                        ],
                        ['label' => 'Sistem','options' => ['class' => 'header']],
                        [
                            'label' => 'User',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                //['label' => 'User', 'icon' => 'user','url' => ['/user/index']],
                                ['label' => 'Anggota', 'icon' => 'user','url' => ['/anggota/index']],
                                //['label' => 'Petugas', 'icon' => 'user','url' => ['/petugas/index']],
                            ],
                        ],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Logout','icon' => 'lock', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>', 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php } else { ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        //['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/site/index']],
                        // ['label' => 'Menu Utama','options' => ['class' => 'header']],
                        // [
                        //     'label' => 'Buku',
                        //     'icon' => 'book',
                        //     'url' => '#',
                        //     'items' => [
                                //['label' => 'Buku', 'icon' => 'book', 'url' => ['/buku/index']],
                                //['label' => 'Kategori', 'icon' => 'cubes', 'url' => ['/kategori/index']],
                                //['label' => 'Peminjaman', 'url' => ['/peminjaman/index']],
                                //['label' => 'Penerbit', 'icon' => 'user','url' => ['/penerbit/index']],
                                //['label' => 'Penulis', 'icon' => 'user','url' => ['/penulis/index']],
                        //     ],
                        // ],
                        // ['label' => 'Sistem','options' => ['class' => 'header']],
                        // [
                        //     'label' => 'User',
                        //     'icon' => 'users',
                        //     'url' => '#',
                        //     'items' => [
                        //         ['label' => 'User', 'icon' => 'user','url' => ['/user/index']],
                        //         ['label' => 'Anggota', 'icon' => 'user','url' => ['/anggota/index']],
                        //         ['label' => 'Petugas', 'icon' => 'user','url' => ['/petugas/index']],
                        //     ],
                        // ],
                         ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                         ['label' => 'Logout','icon' => 'lock', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>', 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php //endif ?>
        <?php } ?>
    </section>

</aside>
