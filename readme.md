#JKL Pricing Tables

![banner-772x250](https://cloud.githubusercontent.com/assets/6644259/7978546/75be7f0c-0ad1-11e5-9e04-9cf49530950f.png)

* [Plugin Page](http://www.wordpress.org/plugins/jkl-pricing-tables)
* [Author Page](http://www.aaronsnowberger.com/)

This is probably the SIMPLEST Pricing Tables plugin you'll ever use. Just type an ordered list of ordered lists within the shortcode tags.

##Description

I've wanted to add SIMPLE Pricing Tables to my website for a while but many of the plugins I tried out were either Freemium (requiring me to purchase the full version in order to unlock the full functionality) or more complicated than I actually wanted.

THIS plugin is exceptionally simple. 

1. Step 1: Type the shortcode tags `[jkl-pricing-table] ... [/jkl-pricing-table]`
2. Step 2: Add an `<ol>` ordered list for your Pricing Table
3. Step 3: Tweak until it looks right

__Note:__ The plural form of the shortcode tags `[jkl-pricing-tables] ... [/jkl-pricing-tables]` also works now (v1.3.0). I found I was constantly typing THAT instead of the singular form.

Requires WordPress 3.5 and PHP 5.

###Special Features
* Styled like [Zurb Foundation 5 Pricing Tables](http://foundation.zurb.com/docs/components/pricing_tables.html)
* Utilizes CSS3 for interesting transition effects (like scaling)

###How the Plugin works
1. The shortcode expects an ordered list of ordered lists
2. The primary ordered list is the names of your Pricing Options (Basic, Business, etc)
3. The secondary ordered lists are the content within your Pricing Options
4. Using jQuery, the plugin finds each element within the ordered lists and adds specific CSS classes to them based on their order (see below)
5. The SECOND Pricing Option is always set to be "popped out" by default and when another table is not hovered over

###Translations
* English (EN) - default
* Korean (KO) - upcoming

If you want to help translate the plugin into your language, please have a look at the `.pot` file which contains all definitions and may be used with a [gettext] editor.

If you have created your own language pack, or have an update of an existing one, you can send your [gettext .po or .mo file] to me so that I can bundle it in the plugin.

##How To

###How to Use the Plugin
1. Type the shortcode tags
2. Create an ordered list `<ol>` within the tags
3. Type the heading for your first table in the first `<ol>` item and hit return
4. TAB the `<ol>` in to add the remainder of your content for the first table
5. Un-indent the `<ol>` to write the heading of your second table
6. TAB in for the remainder of the content in your second table
7. Rinse, repeat for multiple tables (supports up to 5 in a row)

####Example of Usage
```html
[jkl-pricing-table]
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
[/jkl-pricing-table]
```

###Special CSS Classes and How to Style the Plugin
The plugin uses jQuery to dynamically add the following CSS classes to the ordered list elements. Use these classes in your Custom CSS if you want to change things.

1. `.pricing-table` = Each first level ordered list item (`<ol><li>`)
2. `.price` = The FIRST second level list item (`<ol><li><ol><li>`)
3. `.description` = The SECOND second level list item
4. List items after this have no special styling until the end
5. `.deliverables` = The SECOND-TO-LAST second level list item
6. `.cta-button` (Call To Action button) = The LAST second level list item (it should be an `<a>` link)
7. `.button` = The `<a>` link in the `.cta-button` list item

When applying custom CSS to change the design of your plugin, please reference these 
classes as `.pricing-table .class`

####Example of CSS Classes after jQuery assigns them
```html
[jkl-pricing-table]
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
[/jkl-pricing-table]
```

##Documentation & Support
Full documentation of the Plugin and its uses can (currently) be found at its [WordPress.org Plugin location](https://wordpress.org/plugins/jkl-pricing-tables/faq/)

###Screenshots
1. The default view of the Pricing Tables

![screenshot-1](https://cloud.githubusercontent.com/assets/6644259/7978556/89f27870-0ad1-11e5-83ba-4eeec0593be9.png)

2. Hovering over the first Table

![screenshot-2](https://cloud.githubusercontent.com/assets/6644259/7978562/9553280e-0ad1-11e5-9a63-c300f9989927.png)

3. Example of HOW to use the plugin

![screenshot-3](https://cloud.githubusercontent.com/assets/6644259/7978592/04a61f18-0ad2-11e5-8f84-b45d327817eb.png)

4. Example of 4 Pricing Tables

![screenshot-4](https://cloud.githubusercontent.com/assets/6644259/7978596/114f4abe-0ad2-11e5-8ff9-06212a94925d.png)

###Contact Me
If you have questions about, problems with, or suggestions for improving this plugin, please let me know at the [WordPress.org support forums](http://wordpress.org/support/plugin/jkl-pricing-tables)

Want updates about my other WordPress plugins, themes, or tutorials? Follow me [@jekkilekki](http://twitter.com/jekkilekki)

##Acknowledgements 
###This plugin uses:
* [jQuery](http://jquery.com/) licensed under MIT License or GNU General Public License (GPL) Version 2

##License
This program is free software; you can redistribute it and/or modify it under the terms 
of the GNU General Public License as published by the Free Software Foundation; either 
version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this 
program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth 
Floor, Boston, MA 02110-1301 USA

##Changelog

###1.3.0
* Added ability to select initial pop-out table option with an * after the table title
* JavaScript replaces the * with a `<span>` "Recommended" class and additional subtitle text
* Added JavaScript to catch a $ or / in "/month" and add `<span>` classes to style those better
* JavaScript adds a `<span>` class to the title for better styling
* Updated styles (removed rounded corners, changed some colors)
* General code reorganization and cleanup (Object-oriented style)
* Also addresses a use case where the user might make the shortcode plural (i.e. 
typing `jkl-pricing-tables` with an "s" rather that the singular `jkl-pricing-table`)

###1.1.1
* Fixes pricing-table list items margin CSS code

###1.1
* Makes tables responsive on window resize
* Fixes some CSS code

###1.0
* Initial release
