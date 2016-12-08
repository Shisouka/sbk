<?php
/**
 * @var $catalog \common\models\Catalog
 * @var $subcatalog \common\models\Subcatalog
 */

use \common\models\Catalog;
use \yii\helpers\Url;

$catalogModel = Catalog::find()->orderBy('sort')->all();

$request = Yii::$app->request;
$hostInfo = strtolower($request->hostInfo);
$parsedUrl = parse_url($hostInfo);
$queryInfo = parse_url($request->url);
$path = explode('/', $queryInfo['path']);
?>
<div class="sidebar-inner mCustomScrollbar _mCS_2">
    <ul class="nav nav-sidebar">



        <?php foreach ($catalogModel as $catalog) :
            $catalogActive = false;
            $subcatalogActive = false;
            $subStyle = '';
            $arrow = '';
            $SUB_EX = false;
            if (!empty($catalog->subcatalog)) {
                $SUB_EX = true;
                $cat_class = "nav-parent";
                $arrow = "<span class=\"fa arrow\"></span>";
            } else {
                $cat_class = "nav";
            }
            if (!empty($catalog->content)) {
                $href = Url::to('/catalog/'.$catalog->slug);
                $cat_class = 'nav';
            } else {
                if (!$SUB_EX) {
                    continue;
                }
                $href = "#";
            }
            if (!empty($path[2]) && $path[2]==$catalog->slug) {
                $cat_class .=  ' active';
                $catalogActive = true;
                $subStyle = "style='display:block;'";
                if (!empty($catalog->subcatalog)) {
                    $arrow = "<span class=\"fa arrow active\"></span>";
                    $cat_class = "nav-parent active";
                }
            }

            ?>
        <li class="<?= $cat_class; ?>">
            <a href="<?= $href; ?>"><i class="glyphicon glyphicon-chevron-right"></i><span><?= $catalog->name ?></span><?= $arrow; ?></a>
            <?php if (!empty($catalog->subcatalog)) : ?>
                <ul class="children collapse" <?= $subStyle; ?>>
                    <?php foreach ($catalog->subcatalog as $subcatalog) :
                        if(!$subcatalog->content) continue;
                        if ($catalogActive && !empty($path[3]) && $path[3]==$subcatalog->slug) {
                            $sub_class = 'active';
                        } else {
                            $sub_class = '';
                        }
                        ?>
                        <li class="<?= $sub_class; ?>"><a href="<?=  Url::to('/catalog/'.$catalog->slug.'/'.$subcatalog->slug); ?>"><?= $subcatalog->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php ?>
        </li>
        <?php endforeach; ?>
        <hr style="margin: 0; border-top: 1px solid #888;">
        <li class="nav <?= \Yii::$app->controller->action->id == 'price' ? 'active' : '' ?>">
            <a href="<?= Url::to('/price'); ?>"><i class="glyphicon glyphicon-ruble"></i><span>Цены на продукцию</span></a>
        </li>
        <li class="nav <?= \Yii::$app->controller->action->id == 'advantages' ? 'active' : '' ?>">
            <a href="<?= Url::to('/advantages'); ?>"><i class="glyphicon glyphicon-thumbs-up"></i><span>Преимущества BORGE</span></a>
        </li>
        <hr>
        <li class="nav <?= \Yii::$app->controller->action->id == 'about' ? 'active' : '' ?>">
            <a href="<?= Url::to('/about'); ?>"><i class="glyphicon glyphicon-info-sign"></i><span>О НАС</span></a>
        </li>
        <li class="nav">
            <a href="#"><i class="glyphicon glyphicon-briefcase"></i><span>УСЛУГИ</span></a>
        </li>
        <li class="nav">
            <a href="#"><i class="glyphicon glyphicon-phone-alt"></i><span>КОНТАКТЫ</span></a>
        </li>

    </ul>
</div>
