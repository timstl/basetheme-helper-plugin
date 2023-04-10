# basetheme-helper-plugin

Base functionality to use across sites. Moves some functionality from Basetheme into plugin for use with other themes.

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

### misc

-   bt_log function for misc theme or plugin logging to wp-content/debug.log.
-   See basetheme-helper-plugin.php for usage notes.
