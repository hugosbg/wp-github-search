<?php

namespace GithubSearch;

class Assets
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'styles']);
    }

    public static function scripts()
    {
        wp_register_script('github-search', GITHUB_SEARCH_URL . '/assets/js/front.js', [
            'jquery',
            'jquery-ui-autocomplete'
        ], GITHUB_SEARCH_VERSION, true);
    }

    public static function styles()
    {
        wp_register_style('jquery-ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', [], GITHUB_SEARCH_VERSION);
        wp_register_style('jquery-ui-base', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css', [], GITHUB_SEARCH_VERSION);
        wp_register_style('github-search', GITHUB_SEARCH_URL . '/assets/css/front.css', [
            'jquery-ui',
            'jquery-ui-base',
        ], GITHUB_SEARCH_VERSION);
    }
}