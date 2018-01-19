# SkyVerge WooCommerce Plugins

Welcome to the `wc-plugins-snippets` repository! This repository stores code snippets related to [SkyVerge WooCommerce plugins](https://www.skyverge.com/shop/) to modify or add onto plugin behavior.

Code snippets are organized by plugin (folder), and each plugin's folder includes one file per snippet or code example. The file name describes the snippet functionality.

Some larger plugins, such as Memberships, may have sub-folders by category / snippet type to make it easier to find relevant snippets.

**Please ensure you know how to [add custom code to your website](https://www.skyverge.com/blog/add-custom-code-to-wordpress/) if you use any of these code snippets**. These are provided publicly as a courtesy, and are **not supported**, so you should be familiar with adding code to your site to use them.

## Issues and Contributions

If you notice a snippet is outdated, we welcome pull requests for updates :smile_cat:

We also welcome new snippets! Please first check to see if a similar snippet exists, then submit a PR adding your snippet to the appropriate plugin folder(s), and ensure the name of the file is descriptive of what the snippet does. Including a brief description at the top snippet file is also helpful.

**PR Guidelines**

 - Please ensure that your PR follows WordPress coding standards and conventions.

 - All snippets should be PHP 5.3-compatible and use best WooCommerce practices. Try to maintain compatibility at least as far back as WooCommerce 2.6.x, or otherwise note requirements in the snippet.

 - Please use "poor man's namespacing" for function names by using this format:

 ```
 function sv_wc_{plugin_name}_my_function() {
    // the function code
 }
 ```

 - Files should include one "snippet" or example per file.

 - If your snippet relates to multiple plugins, put it in both folders so it's easy to find.

## Licensing

All snippets / code in this repository is **GPL licensed** (GNU General Public License v3.0). If you plan to contribute your own snippets, please note that they will adopt this license.
