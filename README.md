# basetheme-helper-plugin

Base functionality to use across sites. Moves some functionality from Basetheme into plugin for use with other themes.

### class.acf.php

-   Creates ACF-powered Site Settings page (general site options)
-   Creates side-wide Head and Footer custom code sections. Allows admin to insert custom JS or CSS without dev.
-   Creates page-specific Head and Footer custom code sections.
-   Outputs custom code to wp_head and wp_footer.

### class.activated.php

-   Runs when this plugin is activated.
-   Deletes Hello Dolly plugin.
-   Deletes Sample Page.
-   Creates Home and Blog pages.
-   Updates WP reading settings for Home and Blog.
-   Blocks search engines

### class.busted.php

-   Adds 'modified' string to enqueued scripts or styles to help bust cache.

### class.admin.php

-   Creates "Search engines are currently blocked." notice

### class.cleanup.php

-   Removes version and other unncessary info from wp_head

### class.plugins.php

-   Prompts to install various plugins using tgm-plugin-activation class
-   Not all needed on every site, but includes common plugins like ACF, Gravity Forms, Wordfence, etc.

### misc

-   bt_log function for misc theme or plugin logging to wp-content/debug.log.
-   See basetheme-helper-plugin.php for usage notes.
