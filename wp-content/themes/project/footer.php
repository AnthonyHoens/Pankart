        <footer class="footer">
            <nav role="navigation" class="footer__nav nav">
                <h2 class="nav__title nav__title_1" aria-level="2" role="heading">
                    Navigation
                </h2>
                <ul class="nav__container">
                    <?php foreach (dw_menu('main') as $link): ?>
                        <li class="nav__item">
                            <a href="<?= $link->url ?>" class="nav__link <?= $link->active ?> <?= $link->classes ?>">
                                <?= $link->label ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <nav role="navigation" class="footer__nav nav">
                <h2 class="nav__title nav__title_2" aria-level="2" role="heading">
                    Réseaux sociaux
                </h2>
                <ul class="nav__container">
                    <?php foreach (dw_menu('social') as $link): ?>
                        <li class="nav__item">
                            <a href="<?= $link->url ?>" target="_blank" class="nav__link <?= $link->classes ?>">
                                <?= $link->label ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <nav role="navigation" class="footer__nav nav">
                <h2 class="nav__title nav__title_3" aria-level="2" role="heading">
                    Streaming
                </h2>
                <ul class="nav__container">
                    <?php foreach (dw_menu('streaming') as $link): ?>
                        <li class="nav__item">
                            <a href="<?= $link->url ?>" target="_blank" class="nav__link <?= $link->classes ?>">
                                <?= $link->label ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <small class="footer__copyright">
                &copy;&nbsp;<?= get_bloginfo('name') ?> 2021
            </small>

        </footer>

        <script src="<?= dw_asset('/js/app.js') ?>"></script>


        <?php wp_footer(); ?>
    </body>
</html>