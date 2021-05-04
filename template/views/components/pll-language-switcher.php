<?php
/**
 * Polylang Language Switcher
 * 
 * @link https://polylang.pro/doc/function-reference/#pll_the_languages
 */

namespace WBL\Theme;

// Return if pll is not installed
( ! function_exists('pll_the_languages') ) ?: return;

?> 

<div class="language-switcher <?= $args['extra_classes'] ?>">
    <span class="language-switcher__label"><?= _x( 'Go to:', 'language-switcher', 'wbl-theme' ); ?></span>
    <ul class="language-switcher__list">
        <?php 
        pll_the_languages([
            'show_flags' => 1, 
            'hide_current' => 1,
        ]);
        ?>
    </ul>
</div>
