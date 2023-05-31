=== Blockchain Lite ===
Theme Name: Blockchain Lite
Theme URI: https://www.cssigniter.com/themes/blockchain-lite/
Author URI: https://www.cssigniter.com/
Author: The CSSIgniter Team
Contributors: cssigniterteam
Stable tag: 1.4.1
Requires at least: 6.1
Tested up to: 6.1.1
Requires PHP: 5.6
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Blockchain lite is a modern and clean business theme for WordPress, ideal for businesses in the financial sector, consultancies, investing firms, businesses dealing with cryptocurrencies, blockchain companies and more. It supports WooCommerce for online store creation and is regularly updated to ensure continuing compatibility. Its responsive design will give your visitors the perfect mobile browsing experience on phones, tablets & retina enabled displays. It is fast and lightweight, coded with best SEO practises in mind, supports RTL languages and is translation ready. It offers a flexible top bar and header, multiple column layouts for the blog with a masonry effect, unlimited custom color schemes, custom typography, a flexible footer, custom logos and more. It supports the WordPress block editor and is also compatible with the most popular page builders like Elementor, Divi, Brizy and Beaver Builder.

Theme page: https://www.cssigniter.com/themes/blockchain-lite/
Demo: https://www.cssigniter.com/preview/blockchain-lite/

Blockchain Lite WordPress Theme, Copyright 2018 CSSIgniter LLC
Blockchain Lite is distributed under the GNU General Public License, version 2

== Installation ==

1. In your dashboard, go to *Appearance > Themes* and click the *Add New* button.
2. Click *Upload Theme* and then click *Browse... / Choose File...*.
3. Select the theme's .zip file. Then click *Install Now*.
3. Click Activate to use your new theme right away.

== Documentation ==

Please visit https://www.cssigniter.com/docs/blockchain-lite/

== Frequently Asked Questions ==

= I have a problem. Where can I get support? =
We are providing support for this theme, via the WordPress Theme forums at https://wordpress.org/support/theme/blockchain-lite

== License Information ==

Blockchain Lite WordPress Theme, Copyright 2018 CSSIgniter LLC
Blockchain Lite is distributed under the terms of the GNU GPL v2

All theme files (unless otherwise stated) are distributed under the GNU General Public License v2 (GPLv2)

The following assets / components (GPL or GPL compatible) are used:

* Bootstrap - http://getbootstrap.com/
	Copyright (c) 2011-2018 Twitter, Inc.
	Copyright (c) 2011-2018 The Bootstrap Authors
	Released under the MIT license - http://opensource.org/licenses/MIT
* normalize.css v8.0.1 - https://github.com/necolas/normalize.css
	Copyright Nicolas Gallagher, Jonathan Neal
	Released under the MIT license - http://opensource.org/licenses/MIT
* Font Awesome 5.15.4 - http://fontawesome.io
	Copyright Dave Gandy
	Font files licensed under SIL OFL 1.1 - http://scripts.sil.org/OFL
	CSS files licensed under the MIT license - http://opensource.org/licenses/MIT
* Alpha Color Picker - https://github.com/BraadMartin/components/tree/master/alpha-color-picker
	Copyright Braad Martin
	Released under the GPL license - http://www.gnu.org/licenses/gpl.html
* Alpha Color Picker Customizer Control - https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
	Copyright Braad Martin
	Released under the GPL license - http://www.gnu.org/licenses/gpl.html
* Magnific Popup v1.0.0 - http://dimsemenov.com/plugins/magnific-popup/
	Copyright 2014 Dmitry Semenov
	Released under the MIT license - http://opensource.org/licenses/MIT
* Isotope 3.0.2 - https://isotope.metafizzy.co/
	Copyright 2016 Metafizzy
	Released under the GPLv3 license - https://www.gnu.org/licenses/gpl-3.0.html

The following photograph appears in the theme's screenshot:
* https://www.pexels.com/photo/astronomy-atmosphere-earth-exploration-220201/
	Released under the CC0 license - https://www.pexels.com/photo-license/

== Changelog ==

= 1.4.1 =
* FIXED: Future-proof support for One Click Demo Import, by replacing older 'pt-ocdi/*' hook names with the more recent 'ocdi/' ones.
* FIXED: Implicit conversion warning in PHP 8

= 1.4.0 =
* REMOVED: mmenu, replaced with a custom solution
* REMOVED: fitvids, replaced with a custom solution
* REMOVED: Obsolete assets
* ADDED: Square social icons block style.
* UPDATED: FontAwesome to 5.15.4
* UPDATED: Onboarding plugin requirements
* ADDED: GutenBee theme grid support
* FIXED: Refactored assets, Customizer folder, cleaned up functions.php
* FIXED: Some issues with RTL styling
* FIXED: Shop sidebar is not registered if WooCommerce is not enabled
* FIXED: Improved block styles for GutenBee and WC blocks

= 1.3 =
* Removed backward compatibility for wp_body_open().
* Updated onboarding page. Added plugin recommendations as well as instruction for succesful demo content import.
* Removed registration of non-existent script 'mmenu-toggles' jquery.mmenu.toggles.js
* Removed direct links to sample content.
* Added Skip link to main content.
* Added keyboard navigation for the main menu.

= 1.2 =
* Fixed a lot of styling issues
* Fixed a bug which would cause blockchain_lite_hex2rgba() to return rgb() instead of rgba() values, when passed a valid opacity number.
* Added call to wp_body_open() (since WP v5.2) with backward compatibility for earlier versions.
* Removed Google+ Social Icon
* Added Telegram Social Icon
* Fixed formatting, widgets' methods visibility, etc.
* Scripts/styles version numbers now follow the theme's version unless WP_DEBUG or SCRIPT_DEBUG are enabled, for easier cache busting.
* Added helpful main menu fallback.
* Added WooCommerce Customizer options for columns and product number
* Product taxonomy listings are now fullwidth when there are no widgets.
* Trigger a change event when a color is selected with Alpha Color Picker.
* Added Customizer Default Colors
* Added Lightbox for widgets
* Guard against overflowing long words in item titles
* Post & Page navigation now correctly highlight current page
* Updated logo to be a <p> tag
* Fixed an issue where accent color would be applied as the default border color in input/select elements

= 1.1.1 =
* Minor WooCommerce related styling fixes.

= 1.1 =
* Fixed CSS selector typo.
* Added styles for Gutenberg blocks.
* "Hide featured image" checkbox that appeared in posts/pages/custom post types (where applicable), now appears as its own metabox, to maintain compatibility with Gutenberg.
* Onboarding admin notice wouldn't persist its state when dismissed from within the block editor.

= 1.0.3 =
* Removed redirect to onboarding page on theme activation.

= 1.0.2 =
* Sanitised nonces.
* Escaped a gettext call.
* Removed unused blockchain_lite_dropdown_posts()
* Changed screenshot.

= 1.0.1 =
* Added WooCommerce square gallery image size, introduced in v3.3.2
* Removed legacy WooCommerce image size init code.

= 1.0 =
* Initial release
