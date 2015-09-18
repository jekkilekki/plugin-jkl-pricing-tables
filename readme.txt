=== JKL Pricing Tables ===
Contributors:           jekkilekki
Plugin Name:            JKL Pricing Tables
Plugin URI:             https://github.com/jekkilekki/plugin-jkl-pricing-tables
Author:                 Aaron Snowberger
Author URI:             http://www.aaronsnowberger.com/
Donate link:            https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=567MWDR76KHLU
Tags:                   content, shortcode, pricing, tables, jquery
Requires at least:      3.0
Tested up to:           4.2.2
Stable tag:             1.1.1
Version:                1.1.1
License:                GPLv2 or later
License URI:            http://www.gnu.org/licenses/gpl-2.0.html

This is probably the SIMPLEST Pricing Tables plugin you'll ever use. Just type an
ordered list of ordered lists within the shortcode tags.

== Description ==

I've wanted to add SIMPLE Pricing Tables to my website for a while but many of the 
plugins I tried out were either Freemium (requiring me to purchase the full version
in order to unlock the full functionality) or more complicated than I actually wanted.

THIS plugin is exceptionally simple.
 
1. Step 1: Type the shortcode tags `[jkl-pricing-table] ... [/jkl-pricing-table]`
1. Step 2: Add an `<ol>` ordered list for your Pricing Table
1. Step 3: Tweak until it looks right

Requires WordPress 3.5 and PHP 5.

= Special Features = 
* Styled like [Zurb Foundation 5 Pricing Tables](http://foundation.zurb.com/docs/components/pricing_tables.html)
* Utilizes CSS3 for interesting transition effects (like scaling)

= How the Plugin works =
1. The shortcode expects an ordered list of ordered lists
1. The primary ordered list is the names of your Pricing Options (Basic, Business, etc)
1. The secondary ordered lists are the content within your Pricing Options
1. Using jQuery, the plugin finds each element within the ordered lists and adds 
specific CSS classes to them based on their order (see below)
1. The SECOND Pricing Option is always set to be "popped out" by default and when 
another table is not hovered over

= Translations = 
* English (EN) - default
* Korean (KO) - upcoming

If you want to help translate the plugin into your language, please have a look 
at the `.pot` file which contains all definitions and may be used with a [gettext] 
editor.

If you have created your own language pack, or have an update of an existing one, 
you can send your [gettext .po or .mo file] to me so that I can bundle it in the
plugin.

= Contact Me = 
If you have questions about, problems with, or suggestions for improving this 
plugin, please let me know at the [WordPress.org support forums](http://wordpress.org/support/plugin/jkl-pricing-tables)

Want updates about my other WordPress plugins, themes, or tutorials? Follow me [@jekkilekki](http://twitter.com/jekkilekki)

= Acknowledgements = 
This plugin uses:

* [jQuery](http://jquery.com/) licensed under MIT License or GNU General Public License (GPL) Version 2

= License = 
This program is free software; you can redistribute it and/or modify it under the terms 
of the GNU General Public License as published by the Free Software Foundation; either 
version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this 
program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth 
Floor, Boston, MA 02110-1301 USA


== How To ==

= How To Use the Plugin = 
1. Type the shortcode tags
1. Create an ordered list `<ol>` within the tags
1. Type the heading for your first table in the first `<ol>` item and hit return
1. TAB the `<ol>` in to add the remainder of your content for the first table
1. Un-indent the `<ol>` to write the heading of your second table
1. TAB in for the remainder of the content in your second table
1. Rinse, repeat for multiple tables (supports up to 5 in a row)

= Example of Usage =
`[jkl-pricing-table]
<ol>
  <li>Basic
    <ol>
      <li>$150</li>
      <li>Logo only</li>
      <li>Content 1</li>
      <li>Content 2</li>
      <li>Deliverables</li>
      <li><a href='#'>Select Now</a></li>
    </ol>
  </li>
  <li>Business
    <ol>
      <li>$250</li>
      <li>Logo + Business Cards</li>
      <li>Content 1</li>
      <li>Content 2</li>
      <li>Deliverables</li>
      <li><a href='#'>Select Now</a></li>
    </ol>
  </li>
</ol>
[/jkl-pricing-table]`

= Special CSS Classes and How to Style the Plugin = 
The plugin uses jQuery to dynamically add the following CSS classes to the ordered 
list elements. Use these classes in your Custom CSS if you want to change things.

1. `.pricing-table` = Each first level ordered list item (`<ol><li>`)
1. `.price` = The FIRST second level list item (`<ol><li><ol><li>`)
1. `.description` = The SECOND second level list item
1. List items after this have no special styling until the end
1. `.deliverables` = The SECOND-TO-LAST second level list item
1. `.cta-button` (Call To Action button) = The LAST second level list item (it should be an `<a>` link)
1. `.button` = The `<a>` link in the `.cta-button` list item

When applying custom CSS to change the design of your plugin, please reference these 
classes as `.pricing-table .class`

= Example of CSS Classes after jQuery assigns them =
`[jkl-pricing-table]
<ol>
  <li class="pricing-table">Basic
    <ol>
      <li class="price">$150</li>
      <li class="description">Logo only</li>
      <li>Content 1</li>
      <li>Content 2</li>
      <li class="deliverables">Deliverables</li>
      <li class="cta-button"><a class="button" href='#'>Select Now</a></li>
    </ol>
  </li>
  <li class="pricing-table">Business
    <ol>
      <li class="price">$250</li>
      <li class="description">Logo + Business Cards</li>
      <li>Content 1</li>
      <li>Content 2</li>
      <li class="deliverables">Deliverables</li>
      <li class="cta-button"><a class="button" href='#'>Select Now</a></li>
    </ol>
  </li>
</ol>
[/jkl-pricing-table]`


== Installation ==

= Automatic installation =
1. Log into your WordPress admin
1. Go to `Plugins -> Add New`
1. Search for `JKL Pricing Tables`
1. Click `Install Now`
1. Activate the Plugin

= Manual installation =
1. Download the Plugin
1. Extract the contents of the .ZIP file
1. Upload the contents of the `jkl-pricing-tables` directory to your `/wp-content/plugins` 
folder of your WordPress installation
1. Activate the Plugin from the `Plugins` page

= Documentation = 
Full documentation of the Plugin and its uses can (later) be found at its [GitHub page](https://github.com/jekkilekki/plugin-jkl-pricing-tables) 


== Frequently Asked Questions ==

= Tips =
As a general rule, it is always best to keep your WordPress installation and all 
Themes and Plugins fully updated in order to avoid problems with this or any other 
Themes or Plugins. I regularly update my site and test my Plugins and Themes with
the latest version of WordPress.

= How can I change the style of the plugin to match my website? =
Each element contains its own unique CSS identifier under `.pricing-tables`, allowing 
you to hook into those in your own Custom CSS stylesheet.

= How can I add more tables? =
Simply add another `<ol>` item.

= Why aren't the table items the same size? =
Try to keep the content of each of your `<li>` elements to approximately the same
length in order to keep the size of the pricing tables consistent. i.e. if one of
your `<li>` elements is 2 lines long, try to make EVERY table at the same `<li>` 
element also be 2 lines long. (See some examples at my documentation site - upcoming).


== Screenshots ==

1. The default view of the Pricing Tables
2. Hovering over the first Table


== Changelog ==

= 1.1.1 =
* Fixes pricing-table list items margin CSS code

= 1.1 =
* Makes tables responsive on window resize
* Fixes some CSS code

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.1.1 =
* Fixes pricing-table list items margin CSS code

= 1.1 =
* Makes tables responsive on window resize
* Fixes some CSS code

= 1.0 =
* Initial release