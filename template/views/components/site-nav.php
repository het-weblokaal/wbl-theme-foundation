<?php

namespace WBL\Theme;

if ( has_nav_menu( 'site-nav' ) ) : ?>

    <nav class="site-nav">

        <h3 class="site-nav__title screen-reader-text">
            <?php get_menu_name_by_location( 'site-nav' ) ?>
        </h3>

        <?php wp_nav_menu( [
            'theme_location' => 'site-nav',
            'container'      => '',
            'menu_id'        => '',
            'menu_class'     => 'site-nav__menu menu',
            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
            'item_spacing'   => 'discard'
        ] ) ?>

    </nav>

<?php else : ?>

    <nav class="site-nav site-nav--no-menu">

        <ul class="site-nav__menu menu">
            <li class="menu__item"><a class="menu__link" href="/"><?= __('Home', 'wbl-theme') ?></a></li>
        </ul>

    </nav>

<?php
endif;
