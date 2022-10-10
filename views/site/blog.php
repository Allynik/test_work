<?php
use yii\helpers\Html;
?>
<div class="counters-body">
    <!-- counters-body-open -->

    <!-- /counters-body-open -->
</div>

<header class="header header--main" data-component="Header">
    <div class="container header__container">
        <div class="header__logo">
            <a href="/" class="header-logo">
                <img src="assets/front/img/logo.svg" loading="lazy" width="220" height="40" intrinsicsize="220x40"
                     alt="Компания Reformat">

            </a>
        </div>
        <div class="header__language">
            <a href="#" class="button button_secondary button_small header-language">
                EN
            </a>
        </div>
        <div class="header__navbar">
            <div class="header-navbar">
                <a href="#" class="header-navbar__link">
                    О компании
                </a>
                <a href="#" class="header-navbar__link">
                    Услуги
                </a>
                <a href="#" class="header-navbar__link">
                    Кейсы
                </a>
                <a href="/blog" class="header-navbar__link">
                    Блог
                </a>
            </div>
        </div>
        <div class="header__contacts">
            <div class="header-contacts">
                <a href="tel:+73912046064" class="button button_secondary button_small header-contacts__phone">
                    +7 (391) 204-60-64
                </a>
            </div>
        </div>
        <div class="header__feedback">
            <div class="button-popup" data-component="PopUp">
                <button type="button" class="button button_primary button_small button-popup__button"
                        data-popup="toggle">
                    Перезвонить?
                </button>
                <div class="pop-up-backdrop" aria-hidden="true" data-popup="backdrop"></div>
                <div class="button-popup__popup pop-up" data-popup="dialog" tabindex="-1" aria-hidden="true">
                    <button aria-label="close" type="button" class="pop-up__button-close" data-popup="close">
                        <svg>
                            <use xlink:href="assets/front/img/svg-sprite.svg#icon-close" />
                        </svg>

                    </button>
                    <div class="pop-up__inner" data-popup="inner">
                        <form action="#" method="post" data-component="FormSubmit">
                            <div class="row">
                                <div class="col-11 mb-5">
                                    <h5>
                                        Оставьте Ваш номер телефона
                                        и наш менеджер свяжется с вами в течении 15 мин.
                                    </h5>
                                </div>

                                <div class="col-9 mb-4">
                                    <label class="d-none" for="header-form-name">Ваше имя *</label>
                                    <input id="header-form-name" name="name" type="text" placeholder="Ваше имя*"
                                           class="form-control" required>
                                </div>
                                <div class="col-9 mb-5">
                                    <label class="d-none" for="header-form-telephone">Телефон *</label>
                                    <input id="header-form-telephone" name="telephone" type="tel"
                                           placeholder="Телефон *" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-alert fade"></div>
                            <button type="submit" class="button button_primary button_wide">
                                Отправить
                                <span class="loading"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__menu">
            <button aria-label="menu" class="menu-button" type="button" data-component="Menu">
                    <span class="menu-button__icon-default">
                        <svg>
                            <use xlink:href="assets/front/img/svg-sprite.svg#icon-burger" />
                        </svg>

                    </span>
                <span class="menu-button__icon-active">
                        <svg>
                            <use xlink:href="assets/front/img/svg-sprite.svg#icon-close" />
                        </svg>

                    </span>
            </button>
        </div>
    </div>
</header>

<div class="barba-wrapper" data-barba="wrapper" data-component="Scroll" data-scroll-container="Main">
    <div id="top"></div>

    <main class="barba-container" data-barba="container" tabindex="-1" aria-label="Содержимое текущей страницы">
        <div class="page-transition" data-scroll-ignore></div>

        <section class="pt-3 pt-md-1">
            <div class="container">
                <div class="d-none d-md-block mb-7 mb-xl-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Ref.</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Блог</li>
                        </ol>
                    </nav>
                </div>
                <h1 class="mb-1 mb-md-2 mb-xl-3">
                    Блог
                </h1>
                <div class="tag-list mb-3 mb--md4 mb-xl-5">
                    <?php if($det_v == true): ?>
                    <?= Html::a('Выбрать все категории', ['blog'], ['class' => 'tag']) ?>
                    <?php endif;?>
                    <?php foreach ($blog_cat as $cat) : ?>
                        <?= Html::a($cat['title'], ['blog', 'cat_id' => $cat['id']], ['class' =>'tag'])?>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="hr mb-3 mb-md-0" data-scroll></div>
            <div class="container">
                <div class="row mb-md-10 mb-xl-14 blogs-list">
                    <?php if(!empty($blog)) : ?>
                    <?php foreach ($blog as $blog_item) : ?>
                            <div class="col-12 col-md-6 col-xl-4 pt-md-5 pt-xl-8 pb-4 pb-md-3 pb-xl-8 blog-news-wrapper">
                                <a href="#" class="blog-news" data-scroll>
                                    <div class="row">
                                        <div class="col-11 col-md-10">
                                            <div class="blog-news__image">
                                                <picture>
                                                    <?= Html::img('assets/front/image/'.$blog_item['image'], ['loading' => 'lazy', 'width' => 410, 'height' => 280, 'intrinsicsize' => '410x280','alt' => $blog_item['title']])?>
                                                </picture>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="blog-news__description">
                                                <?= $blog_item['title']?>
                                            </div>
                                            <div class="blog-news__data">
                                                <?= $blog_item['created']?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                     <?php endforeach;?>
                    <?php endif;?>
                </div>
                <div class="row mb-6 mb-md-12">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="button button_primary button_wide"
                               data-component="LoadMore" data-load-more="/_ajax-example-blog-page-1.html"
                               data-load-more-target=".blogs-list">
                                Загрузить ещё!
                                <span class="loading"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr" data-scroll></div>
        </section>

        <div class="questions" data-component="Questions">
            <div class="questions__form">
                <section class="section section_decor mt-5 pt-md-7 pt-xl-25 pb-xl-25 pb-5 pb-md-15">
                    <div class="decor-wrapper" data-component="DecorWrapper" data-scroll-delay="0.05">
                        <div class="decor decor_blue decor_any-question-left"></div>
                    </div>
                    <div class="container scroll-intro" data-scroll>
                        <div class="row">
                            <div class="col-10 offset-1 col-xl-8 offset-xl-2 pl-0 pr-0 pl-xxl-14 pr-xxl-14">
                                <div class="mb-3 mb-md-5 mb-xl-4">
                                    <div class="h1 text-center">
                                        Задать вопрос?
                                    </div>
                                </div>
                                <form action="#" class="ask-question" method="post"
                                      data-component="FormSubmit">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-2 mb-xl-3">
                                            <div class="d-flex justify-content-end">
                                                <label class="d-none" for="ask-question-form-name">Ваше имя *
                                                </label>
                                                <input id="ask-question-form-name" name="name" type="text"
                                                       placeholder="Ваше имя *" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 mb-xl-3">
                                            <label class="d-none" for="ask-question-form-company">Компания</label>
                                            <input id="ask-question-form-company" name="company" type="text"
                                                   placeholder="Компания" class="form-control">
                                        </div>

                                        <div class="col-12 col-md-6 mb-2 mb-xl-3">
                                            <div class="d-flex justify-content-end">
                                                <label class="d-none" for="ask-question-form-telephone">Телефон *
                                                </label>
                                                <input id="ask-question-form-telephone" name="telephone" type="tel"
                                                       placeholder="Телефон *" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2 mb-xl-3">
                                            <label class="d-none" for="ask-question-form-email">Эл. почта</label>
                                            <input id="ask-question-form-email" name="email" type="email"
                                                   placeholder="Эл. почта" class="form-control">
                                        </div>
                                        <div class="col-12 mb-4 mb-md-6 mb-xl-5">
                                            <label class="d-none" for="ask-question-form-comment">Комментарий
                                            </label>
                                            <textarea id="ask-question-form-comment" name="comment"
                                                      placeholder="Комментарий" class="form-control"></textarea>
                                        </div>
                                        <div class="col-12 mb-3 mb-xl-4">
                                            <div class="d-flex flex-wrap justify-content-center">
                                                <div class="form-alert fade"></div>
                                                <button type="submit" class="button button_primary button_wide">
                                                    Отправить
                                                    <span class="loading"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="form-agreement">
                                                * Нажимая на кнопку, вы даёте согласие на обработку ваших
                                                персональных данных и принимаете <a href="#">Пользовательское
                                                    соглашение.</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="questions__preview">
                <section class="section section_decor mt-5 pt-md-7 pt-xl-25 pb-xl-25 pb-5 pb-md-15">
                    <div class="decor-wrapper" data-component="DecorWrapper" data-scroll-delay="0.05">
                        <div class="decor decor_purple decor_any-question-left"></div>
                    </div>
                    <div class="any-questions scroll-intro" data-scroll>
                        <div class="container any-questions__container">
                            <div class="any-questions__image">
                                <picture>
                                    <source srcset="assets/front/img/cube-4.avif" type="image/avif">
                                    <source srcset="assets/front/img/cube-4.webp" type="image/webp">

                                    <img src="assets/front/img/cube-4.png" loading="lazy" width="364" height="425"
                                         intrinsicsize="364x425" alt="Кубик">
                                </picture>

                            </div>
                            <div class="any-questions__content">
                                <div class="text-center">
                                    <div class="any-questions__content-text mb-4 mb-md-5">
                                        Остались вопросы?
                                        <br> Свяжитесь с нами и получите консультацию
                                        <br> эксперта по внедрению Битрикс24.
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="button button_primary button_narrow questions__button"
                                                data-questions="toggle">
                                            Написать
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>

    <footer class="footer" data-scroll-section>
        <div class="container">
            <div class="footer__top">
                <div class="row mb-xl-3 mb-0 mb-md-6">
                    <div class="mb-4 mb-md-0 order-2 order-md-1 col-6 col-md-2">
                        <div class="footer__logo">
                            <svg>
                                <use xlink:href="assets/front/img/svg-sprite.svg#icon-logo-2" />
                            </svg>

                        </div>
                    </div>
                    <div class="mb-4 mb-md-0 order-1 order-md-2 col-6 col-md-3">
                        <div class="footer__nav">
                            <nav class="footer-nav">
                                <a href="#" class="footer-nav__link">
                                    О компании <span class="footer-nav__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-nav__link">
                                    Услуги <span class="footer-nav__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-nav__link">
                                    Кейсы <span class="footer-nav__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-nav__link">
                                    Блог <span class="footer-nav__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-nav__link">
                                    Контакты <span class="footer-nav__link-arr">←</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="mb-4 mb-md-0 order-3 order-md-3 col-6 col-md-4">
                        <div class="footer__contacts">
                            <div class="footer-contacts">
                                <div class="footer-contacts__phone">
                                    т. <a href="tel:+73912046064" class="footer-contacts__phone-link">+7 (391)
                                        204-60-64</a>
                                    / <a href="tel:+79509859592" class="footer-contacts__phone-link">+7 (950)
                                        985-95-92</a>
                                </div>
                                <div class="footer-contacts__address">
                                    <div class="footer-contacts__address-icon">
                                        <svg>
                                            <use xlink:href="assets/front/img/svg-sprite.svg#icon-address" />
                                        </svg>

                                    </div>
                                    <div class="footer-contacts__address-text">
                                        ул. Обороны 3в, офис 218
                                        <br> Красноярск
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 mb-md-0 order-4 order-md-4 col-6 col-md-3">
                        <div class="footer__socials">
                            <div class="footer-socials">
                                <a href="#" class="footer-socials__link">
                                    INSTAGRAM <span class="footer-socials__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-socials__link">
                                    Вконтакте <span class="footer-socials__link-arr">←</span>
                                </a>
                                <a href="#" class="footer-socials__link">
                                    FACEBOOK <span class="footer-socials__link-arr">←</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 offset-md-5 col-md-3 mb-3 mb-md-0">
                        <div class="d-flex justify-content-center d-md-block">
                            <a href="mailto:info@reformat.biz"
                               class="button button_secondary button_small footer__mail-button">
                                info@reformat.biz
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex justify-content-center justify-content-md-end">
                            <div class="button-popup button-popup_footer" data-component="PopUp">
                                <button type="button"
                                        class="button button_primary button_small button-popup__button"
                                        data-popup="toggle">
                                    Обратный звонок ↗
                                </button>
                                <div class="pop-up-backdrop" aria-hidden="true" data-popup="backdrop"></div>
                                <div class="button-popup__popup pop-up" data-popup="dialog" tabindex="-1"
                                     aria-hidden="true">
                                    <button aria-label="close" type="button" class="pop-up__button-close"
                                            data-popup="close">
                                        <svg>
                                            <use xlink:href="assets/front/img/svg-sprite.svg#icon-close" />
                                        </svg>

                                    </button>
                                    <div class="pop-up__inner" data-popup="inner">
                                        <form action="#" method="post" data-component="FormSubmit">
                                            <div class="row">
                                                <div class="col-11 mb-5">
                                                    <h5>
                                                        Оставьте Ваш номер телефона
                                                        и наш менеджер свяжется с вами в течении 15 мин.
                                                    </h5>
                                                </div>
                                                <div class="col-9 mb-4">
                                                    <label class="d-none" for="footer-form-name">Ваше имя *</label>
                                                    <input id="footer-form-name" name="name" type="text"
                                                           placeholder="Ваше имя *" class="form-control" required>
                                                </div>
                                                <div class="col-9 mb-5">
                                                    <label class="d-none" for="footer-form-telephone">Телефон *
                                                    </label>
                                                    <input id="footer-form-telephone" name="telephone" type="tel"
                                                           placeholder="Телефон *" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-alert fade"></div>
                                            <button type="submit" class="button button_primary button_wide">
                                                Отправить
                                                <span class="loading"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr hr_black" data-scroll></div>
            <div class="footer__bottom">
                <div class="row">
                    <div class="col-6 col-md-8 d-xl-none">
                        <div class="footer__copywrite">
                            © 2021, Reformat /
                            <span class="text-nowrap">ОГРНИП 316246800140614</span> /
                            <span class="text-nowrap">ИНН 246413707403</span>
                        </div>
                    </div>
                    <div class="col-5 d-none d-xl-block">
                        <div class="footer__copywrite">
                            © 2021, Reformat
                        </div>
                    </div>
                    <div class="col-3 d-none d-xl-block">
                        <div class="footer__ogrn">
                            <span class="text-nowrap">ОГРНИП 316246800140614</span> /
                            <span class="text-nowrap">ИНН 246413707403</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <a href="https://pitcher.agency/" class="footer__developer">
                            Разработка сайта Pitcher.agency
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="counters-body">
    <!-- counters-body-close -->

    <!-- /counters-body-close -->
</div>
<div class="modal-popup" id="consultation-modal" tabindex="-1" aria-hidden="true">
    <div class="decor-wrapper" data-component="DecorWrapper" data-scroll-delay="0.05">
        <div class="decor decor_blue-wide decor_modal-popup-top-center"></div>
        <div class="decor decor_blue-dark decor_modal-popup-bottom-right"></div>
        <div class="decor decor_purple decor_modal-popup-bottom-left"></div>
    </div>
    <header class="modal-popup__header header">
        <div class="container header__container">
            <div class="header__logo">
                <div class="header-logo">
                    <img src="assets/front/img/logo.svg" loading="lazy" width="220" height="40" intrinsicsize="220x40"
                         alt="Компания Reformat">

                </div>
            </div>
            <div class="header__popup-close">
                <button aria-label="close" type="button" class="modal-popup__close" data-modal="close">
                    <svg>
                        <use xlink:href="assets/front/img/svg-sprite.svg#icon-close" />
                    </svg>

                </button>
            </div>
        </div>
    </header>
    <div class="modal-popup__body" data-modal="body">
        <div class="modal-popup__transition" data-modal="transition"></div>
        <div class="container pb-4 pt-md-14 pt-4 pb-md-14">
            <div class="row">
                <div class="col-12 pl-lg-14 pr-lg-14">
                    <div class="mb-4">
                        <div class="h1 text-center">
                            Заказать консультацию
                        </div>
                    </div>
                    <form action="#" class="ask-question" method="post" data-component="FormSubmit">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="d-flex justify-content-end">
                                    <label class="d-none" for="modal-popup-form-name">Ваше имя *</label>
                                    <input id="modal-popup-form-name" name="name" type="text"
                                           placeholder="Ваше имя *" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="d-none" for="modal-popup-form-company">Компания</label>
                                <input id="modal-popup-form-company" name="company" type="text"
                                       placeholder="Компания" class="form-control">
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div class="d-flex justify-content-end">
                                    <label class="d-none" for="modal-popup-form-telephone">Телефон *</label>
                                    <input id="modal-popup-form-telephone" name="telephone" type="tel"
                                           placeholder="Телефон *" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="d-none" for="modal-popup-form-email">Эл. почта</label>
                                <input id="modal-popup-form-email" name="email" type="email" placeholder="Эл. почта"
                                       class="form-control">
                            </div>
                            <div class="col-12 mb-5">
                                <label class="d-none" for="modal-popup-form-comment">Комментарий</label>
                                <textarea id="modal-popup-form-comment" name="comment" placeholder="Комментарий"
                                          class="form-control"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="form-alert fade"></div>
                                    <button type="submit" class="button button_primary button_wide">
                                        Отправить
                                        <span class="loading"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-agreement">
                                    * Нажимая на кнопку, вы даёте согласие на обработку ваших
                                    персональных данных и принимаете <a href="#">Пользовательское соглашение.</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-popup__footer">
        <div class="container">
            <div class="copywrite">
                © 2021, Reformat
            </div>
        </div>
    </div>
</div>

<div class="mobile-menu" tabindex="-1" aria-hidden="true">
    <div class="mobile-menu__container container">
        <div class="menu-nav">
            <a href="#" class="menu-nav__link">
                О компании
            </a>
            <a href="#" class="menu-nav__link">
                Услуги
            </a>
            <a href="#" class="menu-nav__link">
                Кейсы
            </a>
            <a href="#" class="menu-nav__link">
                Блог
            </a>
        </div>
        <div class="mobile-menu__contacts">
            <a href="tel:+73912046064" class="button button_secondary button_small header-contacts__phone">
                +7 (391) 204-60-64
            </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="get-service-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-md modal-dialog modal-dialog-centered">
        <div class="modal__content modal-content">
            <button type="button" class="modal__close close" data-dismiss="modal" aria-label="Close">
                <svg>
                    <use xlink:href="assets/front/img/svg-sprite.svg#icon-close" />
                </svg>

            </button>
            <div class="modal-body">
                <form action="#" method="post" data-component="FormSubmit">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h3 class="text-center">Получить предложение</h3>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-end">
                                <label class="d-none" for="modal-get-service-form-name">Ваше имя *</label>
                                <input id="modal-get-service-form-name" name="name" type="text"
                                       placeholder="Ваше имя *" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-end">
                                <label class="d-none" for="modal-get-service-form-telephone">Телефон</label>
                                <input id="modal-get-service-form-telephone" name="telephone" type="tel"
                                       placeholder="Телефон" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="d-none" for="modal-get-service-form-email">Эл. почта *</label>
                            <input id="modal-get-service-form-email" name="email" type="email"
                                   placeholder="Эл. почта *" class="form-control">
                        </div>
                        <div class="col-12 mb-5">
                            <label class="d-none" for="modal-get-service-form-comment">Комментарий</label>
                            <textarea id="modal-get-service-form-comment" name="comment" placeholder="Комментарий"
                                      class="form-control"></textarea>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="d-flex flex-wrap justify-content-center">
                                <div class="form-alert fade"></div>
                                <button type="submit" class="button button_primary button_wide">
                                    Отправить
                                    <span class="loading"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-agreement">
                                * Нажимая на кнопку, вы даёте согласие на обработку ваших
                                персональных данных и принимаете <a href="#">Пользовательское соглашение.</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
