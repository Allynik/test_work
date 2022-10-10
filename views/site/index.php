<?php
use app\widgets\inputmask\Phone;
use yii\bootstrap4\ActiveForm;
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
                <a href="/wysiwyg" class="header-navbar__link">
                    О компании
                </a>
                <a href="/services" class="header-navbar__link">
                    Услуги
                </a>
                <a href="/cases" class="header-navbar__link">
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
                        <form action="/mail.php" method="post" data-component="FormSubmit">
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

        <div class="decor-wrapper" data-component="DecorWrapper" data-scroll-delay="0.05">
            <div class="decor decor_blue-wide decor_frontpage-top-center"></div>
            <div class="decor decor_blue decor_frontpage-top-center-2"></div>
            <div class="decor decor_purple decor_frontpage-top-left"></div>
            <div class="decor decor_blue-dark decor_frontpage-top-right"></div>
            <div class="decor decor_blue-wide decor_frontpage-mid-center"></div>
            <div class="decor decor_blue-dark decor_frontpage-mid-right"></div>
            <div class="decor decor_blue decor_frontpage-mid-left"></div>
            <div class="decor decor_purple decor_frontpage-mid-2-center"></div>
            <div class="decor decor_blue-wide decor_frontpage-bottom-center"></div>
        </div>
        <section class="section main-composition pt-5 pt-md-15 pb-6">
            <div class="main-composition__top pb-6 pb-md-7">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 col-xl-4">
                            <div class="h5 scroll-intro" data-scroll>
                                Мы помогаем бизнесу развиваться, осваивать новые технологии и подходы ↗
                            </div>
                        </div>
                        <div class="d-none d-md-block col-3 col-xl-2 offset-9 offset-xl-6">
                            <button type="button" class="consultation-trigger main-composition__button"
                                    data-component="Modal" data-modal="#consultation-modal" data-scroll>
                                Заказать консультацию
                                <br>
                                <span class="main-composition__button-arr">↓</span>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="main-composition__image">
                                <picture>
                                    <source srcset="assets/front/img/cube.avif" type="image/avif">
                                    <source srcset="assets/front/img/cube.webp" type="image/webp">

                                    <img src="assets/front/img/cube.png" loading="lazy" width="410" height="479"
                                         intrinsicsize="410x479" alt="Кубик">
                                </picture>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr" data-scroll></div>
            <div class="main-composition__bottom pt-4 pt-md-7 mb-n8 mb-md-0">
                <div class="container">
                    <div class="row">
                        <div class="col-11 col-xl-9">
                            <div class="h0 scroll-intro" data-scroll>
                                Продажа и внедрение Битрикс24 по всей России
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-3 d-md-none">
                            <button type="button" class="consultation-trigger main-composition__button-mobile"
                                    data-component="Modal" data-modal="#consultation-modal">
                                Заказать консультацию ↓
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="hr mb-6 mb-md-13 mb-xl-15" data-scroll></div>
        <section class="pt-xl-16 pt-6 pb-4 pb-md-8">
            <div class="container">
                <div class="row mb-xl-6 mb-md-2 mb-3">
                    <div class="col-12 col-md-6">
                        <h2 class="h2">
                            Наши кейсы
                        </h2>
                    </div>
                    <div class="col-6 d-none d-md-block">
                        <div class="d-flex justify-content-end">
                            <a href="#" class="button button_primary">
                                Перейти в раздел
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="case-block mb-xl-5 mb-3" data-scroll>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="case-block__content">
                                        <div class="case-block__title">
                                            Feelz.ru
                                        </div>
                                        <div class="case-block__info">
                                            Интернет-магазин + 3 розн. магазина г. Москва
                                        </div>
                                        <div class="case-block__description">
                                            Комплексная автоматизация (лиды, заказы, склад, триггерный маркетинг) /
                                            77
                                            сотрудников.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="case-block__image-wrapper">
                                        <picture class="case-block__image">
                                            <source srcset="assets/front/img/case-1.avif" type="image/avif">
                                            <source srcset="assets/front/img/case-1.webp" type="image/webp">

                                            <img src="assets/front/img/case-1.png" loading="lazy" width="643" height="400"
                                                 intrinsicsize="643x400" alt="Feelz.ru">
                                        </picture>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="case-block mb-xl-5 mb-3" data-scroll>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="case-block__content">
                                        <div class="case-block__title">
                                            Coffee Smile Family
                                        </div>
                                        <div class="case-block__info">
                                            Сеть франшиз кофеен
                                        </div>
                                        <div class="case-block__description">
                                            Комплексная автоматизация (лиды, заказы, склад, триггерный маркетинг) /
                                            77
                                            сотрудников.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="case-block__image-wrapper">
                                        <picture class="case-block__image">
                                            <source srcset="assets/front/img/case-2.avif" type="image/avif">
                                            <source srcset="assets/front/img/case-2.webp" type="image/webp">

                                            <img src="assets/front/img/case-2.png" loading="lazy" width="643" height="400"
                                                 intrinsicsize="643x400" alt="Coffee Smile Family">
                                        </picture>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="case-block mb-xl-5 mb-3" data-scroll>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="case-block__content">
                                        <div class="case-block__title">
                                            Apple World
                                        </div>
                                        <div class="case-block__info">
                                            Интернет-магазин г. Москва
                                        </div>
                                        <div class="case-block__description">
                                            Комплексная автоматизация (лиды, заказы, склад, триггерный маркетинг) /
                                            77
                                            сотрудников.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="case-block__image-wrapper">
                                        <picture class="case-block__image">
                                            <source srcset="assets/front/img/case-3.avif" type="image/avif">
                                            <source srcset="assets/front/img/case-3.webp" type="image/webp">

                                            <img src="assets/front/img/case-3.png" loading="lazy" width="643" height="400"
                                                 intrinsicsize="643x400" alt="Apple World">
                                        </picture>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mb-xl-6 mb-md-2 mb-3 d-md-none">
                    <div class="pt-2 pt-md-0 col-12 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-end">
                            <a href="#" class="button button_primary">
                                Перейти в раздел
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="d-md-none hr mb-4 mb-md-6 mb-xl-15"></div>
        <section class="section pt-4 pt-xl-10 pb-2">
            <div class="pb-4 pb-md-8 pb-xl-15 services-composition scroll-intro" data-scroll>
                <div class="container">
                    <h2 class="h2 mb-xl-11 mb-8">
                        Услуги
                    </h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="d-flex justify-content-center">
                                <picture class="services-composition__cube-left">
                                    <source srcset="assets/front/img/cube-3.avif" type="image/avif">
                                    <source srcset="assets/front/img/cube-3.webp" type="image/webp">

                                    <img src="assets/front/img/cube-3.png" loading="lazy" width="493" height="576"
                                         intrinsicsize="493x576" alt="Кубик">
                                </picture>

                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="h5 mt-5 mt-md-0 mb-4 mb-md-6">
                                        Создаём современные пространства для бизнеса и доказываем, что автоматизация
                                        процессов — это нужно и эффективно.
                                    </div>
                                    <div class="d-flex d-md-block justify-content-center">
                                        <a href="#" class="button button_primary mb-4">
                                            Перейти в раздел
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10 offset-2 offset-xl-0 d-none d-md-block">
                                    <div class="d-flex justify-content-end">
                                        <picture class="services-composition__cube-right">
                                            <source srcset="assets/front/img/cube-2.avif" type="image/avif">
                                            <source srcset="assets/front/img/cube-2.webp" type="image/webp">

                                            <img src="assets/front/img/cube-2.png" loading="lazy" width="294" height="343"
                                                 intrinsicsize="294x343" alt="Кубик">
                                        </picture>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr" data-scroll></div>
            <div class="pt-xl-15 pt-7 pt-md-12">
                <div class="container">
                    <div class="row">
                        <div class="mb-xl-22 mb-4 mb-md-15 col-md-6 col-12">
                            <div class="service" data-scroll>
                                <div class="service__icon service-icon-intro" data-component="ServiceIconIntro"
                                     data-scroll>
                                    <!-- "source/partials/svg/service-1.svg" -->
                                    <svg width="113" height="92" viewBox="0 0 113 92" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="21" cy="71" r="21" fill="url(#svgo-service-1-1a)" />
                                        <path d="M21 92h92L21 0v92z" fill="url(#svgo-service-1-2b)" />
                                        <circle cx="61" cy="52" r="40" transform="rotate(-90 61 52)"
                                                fill="url(#svgo-service-1-3c)" />
                                        <circle cx="95" cy="33" transform="rotate(180 95 33)"
                                                fill="url(#svgo-service-1-4d)" r="11" />
                                        <path d="M21 50v42l42-42H21z" fill="url(#svgo-service-1-5e)" />
                                        <defs>
                                            <linearGradient id="svgo-service-1-1a" x1="0" y1="71" x2="42" y2="71"
                                                            gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-1-2b" x1="21" y1="46.001" x2="113"
                                                            y2="46.001" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-1-3c" x1="21" y1="52.001" x2="101"
                                                            y2="52.001" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-1-4d" x1="84" y1="33" x2="106" y2="33"
                                                            gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-1-5e" x1="42" y1="50" x2="42" y2="92"
                                                            gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".602" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <!-- /"source/partials/svg/service-1.svg" -->
                                </div>
                                <div class="service__content">
                                    <a href="assets/front/service/index.html" class="service__title">
                                        Аудит бизнес-процессов
                                        <br> и работы отдела продаж
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-xl-22 mb-4 mb-md-15 col-md-6 col-12">
                            <div class="service" data-scroll>
                                <div class="service__icon service-icon-intro" data-component="ServiceIconIntro"
                                     data-scroll>
                                    <!-- "source/partials/svg/service-2.svg" -->
                                    <svg width="97" height="92" viewBox="0 0 97 92" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <ellipse cx="56.365" cy="51.257" rx="40.743" ry="40.635"
                                                 transform="rotate(-90 56.3649 51.2571)"
                                                 fill="url(#svgo-service-2-6a)" />
                                        <path d="M97 92V49.943L55.054 92H97z" fill="url(#svgo-service-2-7b)" />
                                        <ellipse cx="13.108" cy="78.857" rx="13.108" ry="13.143"
                                                 transform="rotate(180 13.1082 78.8571)"
                                                 fill="url(#svgo-service-2-8c)" />
                                        <ellipse cx="83.892" cy="49.943" rx="13.143" ry="13.108"
                                                 transform="rotate(90 83.8918 49.9429)"
                                                 fill="url(#svgo-service-2-9d)" />
                                        <ellipse cx="34.081" cy="34.171" rx="34.081" ry="34.171"
                                                 transform="rotate(180 34.0811 34.1713)"
                                                 fill="url(#svgo-service-2-10e)" />
                                        <ellipse cx="34.081" cy="34.172" rx="10.514" ry="10.486"
                                                 transform="rotate(90 34.081 34.1715)"
                                                 fill="url(#svgo-service-2-11f)" />
                                        <defs>
                                            <linearGradient id="svgo-service-2-6a" x1="15.622" y1="51.258"
                                                            x2="97.108" y2="51.258" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-2-7b" x1="76.027" y1="92" x2="76.027"
                                                            y2="49.943" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#30A1EF" />
                                                <stop offset=".536" stop-color="#42E1E7" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-2-8c" x1="0" y1="78.857" x2="26.216"
                                                            y2="78.857" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#41EEF4" />
                                                <stop offset=".833" stop-color="#4AD2FF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-2-9d" x1="70.749" y1="49.943"
                                                            x2="97.035" y2="49.943" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-2-10e" x1="0" y1="34.172" x2="68.162"
                                                            y2="34.172" gradientUnits="userSpaceOnUse">
                                                <stop offset=".229" stop-color="#42E1E7" />
                                                <stop offset="1" stop-color="#30A1EF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-2-11f" x1="23.567" y1="34.172"
                                                            x2="44.595" y2="34.172" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <!-- /"source/partials/svg/service-2.svg" -->
                                </div>
                                <div class="service__content">
                                    <a href="#" class="service__title">
                                        Быстрый переход
                                        <br> на Битрикс24
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-xl-22 mb-4 mb-md-15 col-md-6 col-12">
                            <div class="service" data-scroll>
                                <div class="service__icon service-icon-intro" data-component="ServiceIconIntro"
                                     data-scroll>
                                    <!-- "source/partials/svg/service-3.svg" -->
                                    <svg width="101" height="92" viewBox="0 0 101 92" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <ellipse rx="39.643" ry="39.429"
                                                 transform="matrix(1 0 0 -1 61.3571 39.4284)"
                                                 fill="url(#svgo-service-3-12a)" />
                                        <ellipse rx="39.429" ry="39.643"
                                                 transform="matrix(-4.3949e-08 1 1 4.34751e-08 39.6429 52.5715)"
                                                 fill="url(#svgo-service-3-13b)" />
                                        <ellipse rx="10.514" ry="10.571"
                                                 transform="matrix(-4.3949e-08 -1 -1 4.34751e-08 13.2143 13.1428)"
                                                 fill="url(#svgo-service-3-14c)" />
                                        <path d="M101 0v39.429L61.357 0H101z" fill="url(#svgo-service-3-15d)" />
                                        <path d="M0 92V52.571L39.643 92H0z" fill="url(#svgo-service-3-16e)" />
                                        <ellipse rx="18.5" ry="18.4"
                                                 transform="matrix(-1 -8.69502e-08 -8.78979e-08 1 82.5 40.3995)"
                                                 fill="url(#svgo-service-3-17f)" />
                                        <ellipse rx="15.771" ry="15.857"
                                                 transform="matrix(-4.3949e-08 -1 -1 4.34751e-08 39.6429 52.5715)"
                                                 fill="url(#svgo-service-3-18g)" />
                                        <defs>
                                            <linearGradient id="svgo-service-3-12a" x1="0" y1="39.429" x2="79.286"
                                                            y2="39.429" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-13b" x1="0" y1="39.644" x2="78.857"
                                                            y2="39.644" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-14c" x1="10.514" y1="0" x2="15.616"
                                                            y2="19.642" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#41BEE7" />
                                                <stop offset=".388" stop-color="#05BDE7" />
                                                <stop offset=".736" stop-color="#42E1E7" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-15d" x1="81.179" y1="0" x2="81.179"
                                                            y2="39.429" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".602" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-16e" x1="19.821" y1="92" x2="19.821"
                                                            y2="52.571" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".602" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-17f" x1="0" y1="18.4" x2="37"
                                                            y2="18.4" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#41EEF4" />
                                                <stop offset=".833" stop-color="#4AD2FF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-3-18g" x1="0" y1="15.857" x2="31.543"
                                                            y2="15.857" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <!-- /"source/partials/svg/service-3.svg" -->
                                </div>
                                <div class="service__content">
                                    <a href="#" class="service__title">
                                        Доработка или оптимизация
                                        <br> Битрикс24
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-xl-22 mb-4 mb-md-15 col-md-6 col-12">
                            <div class="service" data-scroll>
                                <div class="service__icon service-icon-intro" data-component="ServiceIconIntro"
                                     data-scroll>
                                    <!-- "source/partials/svg/service-4.svg" -->
                                    <svg width="102" height="92" viewBox="0 0 102 92" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 92h92L0 0v92z" fill="url(#svgo-service-4-19a)" />
                                        <circle cx="62.386" cy="29.5" transform="rotate(-90 62.3857 29.5)"
                                                fill="url(#svgo-service-4-20b)" r="29.5" />
                                        <circle cx="91.886" cy="64" r="10" transform="rotate(-90 91.8857 64)"
                                                fill="url(#svgo-service-4-21c)" />
                                        <rect x="9.886" y="81" width="32" height="32"
                                              transform="rotate(-90 9.88574 81)" fill="url(#svgo-service-4-22d)" />
                                        <rect x="27.886" y="63" width="26" height="26"
                                              transform="rotate(-90 27.8857 63)" fill="url(#svgo-service-4-23e)" />
                                        <defs>
                                            <linearGradient id="svgo-service-4-19a" x1="0" y1="46.001" x2="92"
                                                            y2="46.001" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#6956B2" />
                                                <stop offset="1" stop-color="#30A1EF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-4-20b" x1="32.886" y1="29.5"
                                                            x2="91.886" y2="29.5" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#42E1E7" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-4-21c" x1="81.886" y1="64" x2="101.886"
                                                            y2="64" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".516" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-4-22d" x1="9.886" y1="97" x2="41.886"
                                                            y2="97" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset="1" stop-color="#30A1EF" />
                                            </linearGradient>
                                            <linearGradient id="svgo-service-4-23e" x1="27.886" y1="76" x2="53.886"
                                                            y2="76" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#42E1E7" />
                                                <stop offset=".602" stop-color="#30A1EF" />
                                                <stop offset="1" stop-color="#6956B2" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <!-- /"source/partials/svg/service-4.svg" -->
                                </div>
                                <div class="service__content">
                                    <a href="#" class="service__title">
                                        Разработка ТЗ на внедрение
                                        <br> Битрикс24 / Обследование
                                        <br> бизнеса
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="d-xl-none mt-md-n8 hr mb-4 mb-md-6 mb-xl-15"></div>
        <section class="section pt-1 pt-md-8 pb-7 pb-md-16">
            <div class="container">
                <div class="row mb-xl-6 mb-4 mb-md-0">
                    <div class="col-md-6 col-12">
                        <h2 class="h2">
                            Новое в блоге
                        </h2>
                    </div>
                    <div class="col-6 d-none d-md-block">
                        <div class="d-flex justify-content-end">
                            <a href="blog" class="button button_primary">
                                Перейти в раздел
                            </a>
                        </div>
                    </div>
                </div>
                <?php if(empty($blog)):?>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h2 class="h3">
                            Ничего нового нет, но скоро будет . . .
                        </h2>
                    </div>
                </div>
                <?php endif;?>
                <div class="row">
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
                <div class="row">
                    <div class="col-12 col-md-6 d-md-none">
                        <div class="d-flex justify-content-center justify-content-md-end">
                            <a href="#" class="button button_primary">
                                Перейти в раздел
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="hr mb-4 mb-md-10" data-scroll></div>

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
                                <a href="assets/front/wysiwyg/index.html" class="footer-nav__link">
                                    О компании <span class="footer-nav__link-arr">←</span>
                                </a>
                                <a href="assets/front/services/index.html" class="footer-nav__link">
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
                    <?php $form = ActiveForm::begin([
                            'options' => [
                                    'class' => 'ask-question',
                                    'data-component' => 'FormSubmit'
                            ]
                    ]) ?>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">

                                <label class="d-none" for="modal-popup-form-name">Ваше имя *</label>
                                <?= $form->field($model,'first_name')->textInput(['id'=>'modal-popup-form-name','placeholder'=>'Ваше имя *','class'=>'form-control'])->label(false);?>

                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="d-none" for="modal-popup-form-company">Компания</label>
                            <?= $form->field($model,'company')->textInput(['id'=>'modal-popup-form-company','placeholder'=>'Компания','class'=>'form-control'])->label(false);?>
                        </div>
                        <div class="col-12 col-md-6 mb-3">

                                <label class="d-none" for="modal-popup-form-telephone">Телефон *</label>
                                <?= $form->field($model,'phone')->textInput(['id'=>'modal-popup-form-phone','placeholder'=>'Телефон *','class'=>'form-control'])->label(false);?>

                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="d-none" for="modal-popup-form-email">Эл. почта</label>
                            <?= $form->field($model,'email')->textInput(['id'=>'modal-popup-form-email','placeholder'=>'Эл. почта','class'=>'form-control'])->label(false);?>
                        </div>
                        <div class="col-12 mb-5">
                            <label class="d-none" for="modal-popup-form-comment">Комментарий</label>
                            <?= $form->field($model,'comment')->textarea(['id'=>'modal-popup-form-comment','placeholder'=>'Комментарий','class'=>'form-control'])->label(false);?>
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
                    <?php ActiveForm::end();?>
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
            <a href="assets/front/wysiwyg/index.html" class="menu-nav__link">
                О компании
            </a>
            <a href="assets/front/services/index.html" class="menu-nav__link">
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

<!--<script src="assets/front/js/vendor.min.js?27497a4050920177228b"></script>-->
<!--<script src="assets/front/js/app.min.js?27497a4050920177228b"></script>-->

