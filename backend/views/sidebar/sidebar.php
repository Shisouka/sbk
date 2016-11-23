<?php
$baseUrl = isset(\Yii::$app->components['request']['baseUrl']) ? \Yii::$app->components['request']['baseUrl'] : '';

?>
<?php if (!Yii::$app->user->isGuest): ?>
    <div class="sidebar-inner mCustomScrollbar _mCS_2">
        <ul class="nav nav-sidebar">
            <?php if (Yii::$app->user->can('Administrator')) { ?>
                <li class="nav-parent  <?= \Yii::$app->controller->module->id == 'gii' ? 'active' : '' ?>">
                    <a href="#"><i class="icon-puzzle"></i><span>Gii</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li><a href="<?= $baseUrl ?>/gii/model">Model Generator</a></li>
                        <li><a href="<?= $baseUrl ?>/gii/crud">CRUD Generator</a></li>
                        <li><a href="<?= $baseUrl ?>/gii/controller">Controller Generator</a></li>
                        <li><a href="<?= $baseUrl ?>/gii/form">Form Generator</a></li>
                        <li><a href="<?= $baseUrl ?>/gii/module">Module Generator</a></li>
                        <li><a href="<?= $baseUrl ?>/gii/extension">Extension Generator</a></li>
                    </ul>
                </li>
                <li class="nav <?= \Yii::$app->controller->id == 'user' ? 'active' : '' ?>">
                    <a href="<?= $baseUrl ?>/user"><i class="icon-users"></i><span>Пользователи</span></a>
                </li>
                <li class="nav-parent  <?= \Yii::$app->controller->module->id == 'users-permissions' ? 'active' : '' ?>">
                    <a href="#"><i class="icon-user"></i><span>Права доступа пользователям</span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li class="<?= \Yii::$app->controller->id == 'index' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/users-permissions">Assignments</a></li>
                        <li class="<?= \Yii::$app->controller->id == 'role' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/users-permissions/role">Roles</a></li>
                        <li class="<?= \Yii::$app->controller->id == 'permission' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/users-permissions/permission">Permissions</a></li>
                        <li class="<?= \Yii::$app->controller->id == 'route' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/users-permissions/route">Routes</a></li>
                        <li class="<?= \Yii::$app->controller->id == 'rule' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/users-permissions/rule">Rules</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="nav  <?= \Yii::$app->controller->id == 'common' ? 'active' : '' ?>">
                <a href="<?= $baseUrl ?>/catalog"><i class="glyphicon glyphicon-list"></i><span>Каталог</span></a>
            </li>
           
        </ul>
        <div class="sidebar-footer clearfix">
            <a class="pull-left btn-effect" href="<?= $baseUrl ?>/site/logout" data-method="post" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
                <i class="icon-power"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
                <i class="icon-size-fullscreen"></i></a>
        </div>
    </div>
<?php endif; ?>
