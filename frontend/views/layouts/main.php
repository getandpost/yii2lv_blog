<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common', 'Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftMenuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => '文章', 'url' => ['/post/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightMenuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $rightMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $rightMenuItems[] = [
            'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="'.Yii::$app->user->identity->username.'">',
            'linkOptions' => ['class' => 'avatar'],
            'items' => [
                [
                    'label' => '<i class="fa fa-sign-out"></i> ' . Yii::t('common', 'Logout'),
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
                [
                    'label' => '<i class="fa fa-user"></i> ' . Yii::t('common', 'User Profile'),
                    'url' => ['/user/profile']
                ]
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftMenuItems,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $rightMenuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="pull-left">
            <p>Copyright &copy; 2017-<?= date('Y') ?> by <?= Html::encode(Yii::$app->name) ?> All Rights Reserved.</p>
        </div>

        <p class="pull-right"><?= Yii::powered() ?> <?= \Yii::getVersion() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
