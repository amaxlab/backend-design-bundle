BackendDesignBundle
================

BackendDesignBundle бандл предоставляющий bootstrap интерфейс для backend-ов

Установка
---------

### 0. Установить бандл с помощью композера
 
Добавить в composer.json пути к репозитариям

    "repositories": [{
        "type": "vcs",
        "url": "https://github.com/amaxlab/backend-design-bundle.git"
    }]
    
Выполнить 

    composer require amaxlab/backend-design-bundle

### 1. Добавить бандлы в AppKernel.php

    $bundles = array(
        ...
        new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
        new AmaxLab\Bundle\BackendDesignBundle\BackendDesignBundle(),
    );

### 2. Унаследовать шаблоны
В шаблонах которые должны использовать стандартный фирменный стиль:

    {% extends "BackendDesignBundle::base.html.twig" %}

### 3. Выполнить комманды

1. `php app/console cache:clear --env=prod`
2. `php app/console assets:install --symlink`
3. `php app/console assetic:dump`
4. `php app/console assetic:dump --env=prod`


Области шаблона
---------------

* `standart_doctype`
* `head_start`
* `standart_charset`
* `meta`
* `before_title`
* `title`
* `after_title`
* `standart_stylesheets`
* `stylesheets`
* `standart_jquery`
* `stnadart_ie9_javascript`
* `standart_favicon`
* `head_end`

* `body_start`
* `body`
* `before_main_header`
* `main_header`
* `navbar_logo`
* `navbar_logo_link`
* `navbar_logo_img`
* `navbar_brend`
* `navbar_brend_link`
* `navbar_brend_title`
* `main_menu`
* `page_title_standart`
* `page_title`
* `after_main_header`
* `affix_menu`
* `before_content`
* `content`
* `after_content`
* `standart_javascripts`
* `javascripts`
* `body_end`

* `header_nav_tabs` Основные табы навигации сверху. Внутрь помещается ul с классом `class="nav nav-tabs"`
* `aside_navbar_nav` Боковая панель навигации. Внутрь помещается ul с классом `class="nav navbar-nav"`
* `header_button_bar_btn_toolbar_inner` Верхние управляющие кнопки. Помещаются несколько групп кнопок (`class="btn-group"`)
* `footer_button_bar_btn_toolbar_inner` Нижние управляющие кнопки. Помещаются несколько групп кнопок (`class="btn-group"`)
* `content` Основное содержимое.
* `modal_content` Содержимое модального окна

* C помощью блоков `standart_doctype` `standart_charset` `standart_jquery` `standart_favicon` можно переопределить одноименные теги или подключаемые ресурсы


Интеграция с другими бандлами
-----------------------------

##KnpPaginatorBundle

Указать в config.yml новый шаблон для пагинации

    knp_paginator:
        template:
            pagination: BackendDesignBundle:Pagination:sliding.html.twig


TODO
----

1. Добавить поддержку less/sass
2. Дополнить описание областей шаблона
3. Убрать из бутстрапа все внесенные туда вручную правки
