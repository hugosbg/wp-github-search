<?php
/*
 * Plugin Name: Github Search
 * Plugin URI: https://github.com/hugosbg/wp-github-search
 * Description: Listar repositórios públicos do Github
 * Version: 0.0.1
 * Author: Hugo Gomes
 * Author URI: https://github.com/hugosbg
 * Text Domain: github-search
 */

defined('ABSPATH') || exit;
define('GITHUB_SEARCH_VERSION', '0.0.1');
define('GITHUB_SEARCH_URL', rtrim(plugin_dir_url(__FILE__), '/'));
define('GITHUB_SEARCH_DIR', __DIR__);

require_once __DIR__ . '/autoload.php';

function githubSearch()
{
    return GithubSearch\Plugin::getInstance();
}

$GLOBALS['githubSearch'] = githubSearch();