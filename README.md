BackendDesignBundle
================

BackendDesignBundle бандл предоставляющий bootstrap интерфейс для backend-ов

Установка
---------

### 0. Установить бандл с помощью композера

Выполнить комманду

    composer require amaxlab/backend-design-bundle

### 1. Добавить бандлы в AppKernel.php

Бандл зависит от других бандлов которые так же должны быть автозагружены

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

1. `php app/console assets:install --symlink` или `php app/console assets:install` на ОС не поддреживающих символьные ссылки
2. `php app/console assetic:dump && php app/console assetic:dump --env=prod`
3. `php app/console cache:clear --env=prod && php app/console cache:clear`


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
* `body` - основная область содержащая большинство других областей. Изменение этого блока приведет к полному изменению внешнего вида типовой страницы
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

* C помощью блоков `standart_doctype` `standart_charset` `standart_jquery` `standart_favicon` можно переопределить одноименные теги или подключаемые ресурсы


Другие возможности
------------------

## Использование Gravatar.com

Чтобы иметь возможность использовать gravatar необходимо указать в config.yml

    backend_design:
        gravatar: true

По умолчанию использование граватара отключено. Использование граватара сводится к использованию трех возможных функций в шаблоне:

* `{{ gravatar(email, size, rating, default) }}` 
* `{{ gravatar_hash(hash, size, rating, default) }}` 
* `{{ gravatar_exists(email) }}` 

По умолчанию будет испоьзоваться текущий протокол (http или https) данного запроса. Это поведение можно изменить передав в качестве последего параметра во всех функциях true или false (для включение или выключения https соответственно)

Интеграция с другими бандлами
-----------------------------

##KnpPaginatorBundle

Указать в config.yml новый шаблон для пагинации

    knp_paginator:
        template:
            pagination: BackendDesignBundle:Pagination:sliding.html.twig

TODO
----

1. Добавить поддержку sass
2. Дополнить описание областей шаблона
