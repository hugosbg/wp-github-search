<?php

namespace GithubSearch;

class Plugin
{
    private static $_instance;

    protected function __construct()
    {
        Assets::init();
        Shortcode::init();
    }

    public function view($template, array $data = [])
    {
        $file = GITHUB_SEARCH_DIR . '/views/' . $template;
        if (file_exists($file)) {
            foreach ($data as $key => $val) {
                $$key = $val;
            }
            /** @noinspection PhpIncludeInspection */
            include $file;
        }
    }

    public function github()
    {
        return new Github();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {
        //@Todo
    }

    private function __wakeup()
    {
        //@Todo
    }
}