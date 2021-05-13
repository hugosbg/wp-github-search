<h1><?php echo esc_html($profile->name); ?></h1>

<img src="<?php echo esc_url($profile->avatar_url) ?>" class="github-avatar"/>

<ul>
    <li>
        <strong><?php esc_attr_e('Localização:', 'github-search'); ?></strong>
        <?php echo esc_html($profile->location); ?>
    </li>
</ul>