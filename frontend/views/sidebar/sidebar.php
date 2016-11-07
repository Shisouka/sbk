<?php
$baseUrl = isset(\Yii::$app->components['request']['baseUrl']) ? \Yii::$app->components['request']['baseUrl'] : '';

?>
<?php if (!Yii::$app->user->isGuest): ?>
    <div class="sidebar-inner mCustomScrollbar _mCS_2">
        <ul class="nav nav-sidebar">
            <?php if (Yii::$app->user->can('users-admin')) { ?>
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
                <a href="<?= $baseUrl ?>/common"><i class="glyphicon glyphicon-cog"></i><span>Общие настройки</span></a>
            </li>
            <?php if (Yii::$app->user->can('domains-admin')) { ?>
                <li class="nav  <?= \Yii::$app->controller->id == 'domains' ? 'active' : '' ?>">
                    <a href="<?= $baseUrl ?>/domains"><i class="glyphicon glyphicon-cloud"></i><span>Настройки доменов</span></a>
                </li>
            <?php } ?>
            <li class="nav  <?= \Yii::$app->controller->id == 'cities' ? 'active' : '' ?>">
                <a href="<?= $baseUrl ?>/cities"><i class="icon-bar-chart"></i><span>Настройки городов</span></a>
            </li>
            <li class="nav-parent
            <?=
            (in_array(\Yii::$app->controller->id, [
                'offices',
                'teachers',
                'page-school',
                'reviews',
                'discounts',
                'popular-courses',
                'coupons',
                'courses',
                'schools',
                'points',
                'offices-get',
                'page-course-tpl-standart',
                'page-course-tpl-full',
                'page-course-tpl-all-inclusive',
                'page-course-tpl-3in1',
                'page-course-lessons',
                'page-course-learn-list',
                'page-course-graduation',
                'teacher-terms',
                'ankets-reviews',
            ]) ) ? 'active' : ''

            ?>">
                <a href="#"><i class="icon-list"></i><span>Списки</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?= in_array(\Yii::$app->controller->id, ['schools', 'page-school']) ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/schools">Факультеты</a></li>
                    <li class="<?=
                    in_array(\Yii::$app->controller->id, [
                        'courses',
                        'page-course-tpl-standart',
                        'page-course-tpl-full',
                        'page-course-tpl-all-inclusive',
                        'page-course-tpl-3in1',
                        'page-course-lessons',
                        'page-course-learn-list',
                        'page-course-graduation',
                    ]) ? 'active' : ''

                    ?>"><a href="<?= $baseUrl ?>/courses">Курсы</a></li>
                    <li class="<?= in_array(\Yii::$app->controller->id, ['offices', 'points', 'offices-get']) ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/offices">Офисы</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'teachers' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/teachers">Преподаватели</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'teacher-terms' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/teacher-terms">Категории преподавателей</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'reviews' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/reviews">Отзывы</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'discounts' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/discounts">Расписание скидок</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'popular-courses' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/popular-courses">Популярные курсы</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'coupons' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/coupons">Скидочные купоны</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'ankets-reviews' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/ankets-reviews">Озывы в анкетировании</a></li>
                </ul>
            </li>
            <li class="nav-parent  <?=
            in_array(\Yii::$app->controller->id, [
                'page-main',
                'page-about',
                'page-corporate',
                'page-franchising',
                'page-check',
            ]) ? 'active' : ''

            ?>">
                <a href="#"><i class="icon-docs"></i><span>Страницы</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?= \Yii::$app->controller->id == 'page-main' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/pages/main">Главные страницы</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'page-corporate' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/pages/corporate">Корпоративное обучение</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'page-about' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/pages/about">О нас</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'page-franchising' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/pages/franchising">Франчайзинг</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'page-check' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/pages/check">Проверка сертификата</a></li>
                </ul>
            </li>
            <li class="nav-parent  <?= in_array(\Yii::$app->controller->id, ['why-come', 'advantages', 'teach-companies', 'graduation-certificate']) ? 'active' : '' ?>">
                <a href="#"><i class="icon-calculator"></i><span>Виджеты</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?= \Yii::$app->controller->id == 'advantages' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/widgets/advantages">Наши преимущества</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'why-come' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/widgets/why-come">Почему к нам приходят?</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'teach-companies' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/widgets/teach-companies">Мы обучали сотрудников компаний</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'graduation-certificate' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/widgets/graduation-certificate">Фирменный сертификат</a></li>
                </ul>
            </li>
            <li class="nav  <?= \Yii::$app->controller->id == 'leads' ? 'active' : '' ?>">
                <a href="<?= $baseUrl ?>/leads"><i class="glyphicon glyphicon-envelope"></i><span>Заявки</span></a>
            </li>
            <li class="nav  <?= \Yii::$app->controller->id == 'meta' ? 'active' : '' ?>">
                <a href="<?= $baseUrl ?>/meta"><i class="glyphicon glyphicon-globe"></i><span>Мета</span></a>
            </li>
            <li class="nav  <?= \Yii::$app->controller->id == 'costs' ? 'active' : '' ?>">
                <a href="<?= $baseUrl ?>/costs"><i class="glyphicon glyphicon-rub"></i><span>Стоимость курсов</span></a>
            </li>
            <hr>
            <li class="nav-parent  <?= in_array(\Yii::$app->controller->id, ['satellites', 'landing', 'page-satellite']) ? 'active' : '' ?>">
                <a href="#"><i class="glyphicon glyphicon-tasks"></i><span>Cателлиты</span> <span class="fa arrow"></span></a>
                <ul class="children collapse">
                    <li class="<?= \Yii::$app->controller->id == 'satellites' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/satellites/">Список сателлитов</a></li>
                    <li class="<?= \Yii::$app->controller->id == 'landing' ? 'active' : '' ?>"><a href="<?= $baseUrl ?>/landing/">Список открых уроков</a></li>
                </ul>
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
