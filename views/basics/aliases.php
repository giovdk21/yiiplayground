<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Path aliases';
$this->params['breadcrumbs'] = ['Basics', $this->title];
$this->params['guideUrl'] = 'http://www.yiiframework.com/doc-2.0/guide-basics.html#path-aliases';
?>


<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

    <h2>getAlias / setAlias</h2>
    <div class="demo_box" id="hyperlink">

        <?php
        Yii::$app->sc->setStart(__LINE__);

        Yii::setAlias('@myCssAlias', '@web/css');

        echo "@web alias: " . Yii::getAlias('@web')."<br>";
        echo "@myCss alias: " . Yii::getAlias('@myCssAlias')."<br>";
        echo "Css file: " . Yii::getAlias('@myCssAlias/site.css')."<br>";

        Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
        ?>

    </div>
    <?php Yii::$app->sc->renderSourceBox(); ?>
</article>
