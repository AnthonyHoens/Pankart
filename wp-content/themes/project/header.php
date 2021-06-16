<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= is_front_page() ? 'PanKart, groupe de musique celtique .' : wp_title('PanKart |') ?></title>

    <link rel="stylesheet" href="<?= dw_asset('/css/theme.css'); ?>">

    <?php wp_head(); ?>
</head>
<body>

<header class="header">
    <h1 aria-level="1" role="heading" class="header__title">
        <a href="/#" class="header__logo">
            <img src="<?= dw_asset('/img/logo.png') ?>" alt>
            <?= get_bloginfo('name') ?>
        </a>
    </h1>

    <button id="burger" class="header__burger">    
        <span></span>
        <span></span>
        <span></span>
    </button>
  
    <nav role="navigation" class="header__nav nav">
        <h2 class="sro nav__title" aria-level="2" role="heading">
            Navigation principale
        </h2>
        <ul class="nav__ul">
            <?php foreach (dw_menu('main') as $link): ?>
                <li class="nav__item">
                    <a href="<?= $link->url ?>" class="nav__link <?= $link->active ?> <?= $link->classes ?>">
                        <?= $link->label ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>