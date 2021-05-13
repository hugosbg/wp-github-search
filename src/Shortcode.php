<?php

namespace GithubSearch;

class Shortcode
{
    public static function init()
    {
        add_shortcode('githubsearch_list', [__CLASS__, 'list']);
    }

    public static function list()
    {
        $url = esc_url(get_permalink(get_the_ID()));
        $structure = get_option('permalink_structure');
        wp_enqueue_style('github-search');
        wp_enqueue_script('github-search');
        wp_localize_script('github-search', 'GithubSearch', [
            'url' => $url,
            'separator' => empty($structure) ? '&' : '?',
        ]);

        ob_start();
        githubSearch()->view('search.php');

        if (!empty($_GET['user']) && !isset($_GET['profile'])) {
            try {
                $username = sanitize_text_field(wp_unslash($_GET['user']));
                $repositories = githubSearch()->github()->listRepositoriesForUser($username);
                githubSearch()->view('repositories.php', [
                    'repositories' => $repositories,
                    'profile' => add_query_arg(['user' => $username, 'profile' => 'view'], $url),
                ]);
            } catch (\Exception $e) {
                printf('<p>%s</p>',
                    esc_attr__('Serviço temporariamente indisponível', 'github-search')
                );
            }
        }

        if (!empty($_GET['profile']) && !empty($_GET['user'])) {
            try {
                $username = sanitize_text_field(wp_unslash($_GET['user']));
                $profile = githubSearch()->github()->getUser($username);
                githubSearch()->view('profile.php', [
                    'profile' => $profile,
                ]);
            } catch (\Exception $e) {
                printf('<p>%s</p>',
                    esc_attr__('Serviço temporariamente indisponível', 'github-search')
                );
            }
        }

        return ob_get_clean();
    }

}