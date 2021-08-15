=== Affiliate Links Manager with Link Cloaking, Link Redirection, and Amazon Affiliate Support – Simple URLs ===
Contributors: lassoanalytics, mollusk, phucdolasso
Plugin link: https://getlasso.co/?utm_source=SimpleURLs&utm_campaign=WP
Tags: affiliate, affiliate links, link cloaking, link branding, link tracking
Requires at least: 5.1
Requires PHP: 7.2
Tested up to: 5.8
Stable tag: trunk

A link management system that allows you create, manage, and track outbound links from your site. Designed for all affiliate links, including Amazon.

== Description ==

Simple URLs is a complete link management system that allows you create, manage, and track outbound links from your site by using custom post types and 301 redirects. Designed for all affiliate links, including ones from Amazon Associates.

Learn about Affiliate Marketing on our Blog: [https://getlasso.co/blog/](https://getlasso.co/blog/?utm_source=SimpleURLs&utm_campaign=WP)

**Ready To Go Pro?**

[Lasso: The All-In-One Affiliate Marketing Plugin for WordPress](https://getlasso.co/?utm_source=SimpleURLs&utm_campaign=WP)

Lasso will help you create beautiful product displays, find new affiliate opportunities, and easily manage all of your important links. No code required.

[youtube https://www.youtube.com/watch?v=wSEeldeKu54]

### SIMPLE AFFILITE LINK MANAGEMENT ###

No complex setups. It’s just another post type in your admin and another button on your Visual editor.
When you are writing blog posts, you can search for the affiliate link you created earlier by name.
You can add affiliate links to Simple URLs while you are writing blog posts.

### SUPERIOR LINK TRACKING ###

You can group your affiliate links into hierarchical categories. eg. placing all Amazon links within an “Amazon” category, or all software links in a “Software” category.
Managing your links in Simple URLs means there is only one place to change the destination URL if required rather than having to go back and replace the link in potentially hundreds of articles.

### NO LINK CONFLICTS ###

Uses proper custom post types to avoid link conflicts that can occur with other solutions.
Keeps it’s database footprint small to ensure you don’t over bloat your database with useless information.

### SAFE REDIRECTS & SMART UNCLOAKING ###

You can choose from 301 (default), 302 or 307 redirects, all of which are safe link redirects.
Link redirects protect your affiliate links from being scraped and replaced by malware in your visitor’s browser.
There is also a smart uncloaking feature so if the affiliate program you are using (such as Amazon Associates) does not like your links behind a redirect, you can still use Simple URLs. Your links can be conditionally uncloaked on the front end.

### CLICK TRACKING ###

Adds click tracking to your links to track every click. Comes with built-in reports so you can explore, over-time, how much your affiliate links have been clicked and what is popular on your site.

**More Features:**

* Built-in affiliate link shorter and link cloaking (creates simple URLs like: http://yoursite.com/your-affiliate-link)
* Commission protecting affiliate link redirection options (301, 302 & 307)
* Click stats tracking & reports
* Hierarchical link categorization to easily segment links
* Affiliate link picker tool which works just like the WordPress link tool
* Insert standard links, and shortcodes
* Makes it easy to insert affiliate links in posts and pages
* Simple URLs works with any WordPress editor
* Easily create new affiliate links inside your posts without leaving the post edit screen
* Customizable link URL prefixes 
* Choose to show category slugs in link URLs
* No Follow option (global or per link)
* Open in new tab (global or per link)
* Full importing and exporting support via standard WordPress tools
* Full backup compatibility via standard WordPress backup solutions
* Uses WordPress approved storage techniques – doesn’t bloat your database
* Detects outdated affiliate links in your content and fixes them automatically
* Simple URLs let you easily create, shorten and manage any URL to help you cross-promote your brands & products. With a sleek, modern-looking Interface, you can shorten any URL and track any affiliate link to run successful campaigns.
* Easy-to-use & Simple Link cloaking for affiliate marketing
* Create simple URLs instantly
* Safe Redirection URLs and link cloaking capabilities
* Enhanced link tracking to Analyze your marketing campaigns 
* Optimized queries to reduce load time so your pages and links load fast
* Level up your affiliate links
* UTM Builder to evaluate marketing campaigns
* Instant Gutenberg Redirect to manage links from Gutenberg Editor
* Set Link Expiration date & control where users will be redirected

== Usage ==

Simple URLs gives bloggers the tools they need to monetize their WordPress website with affiliate marketing.

And, by avoiding page based redirects, which is the current trend in masking affiliate links, we avoid any issues with permalink conflicts, and therefore avoid any performance issues.

**We’ve made managing your affiliate links simple:**

1. Upload the entire `simple-urls` folder to the `/wp-content/plugins/` directory
1. DO NOT change the name of the `simple-urls` folder
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Navigate to `Settings > Permalinks` and save them. Yes, just click save. Trust me.
1. Navigate to the `Simple URLs` menu
1. Create a new URL, or manage existing URLs.
1. Publish and use the URLs however you want!

== Frequently Asked Questions ==

= What is Simple URLs? =

Simple URLs is a custom link cloaking, URL redirection tool, and link tracking management plugin for WordPress. It allows you to create link redirects from your website's domain. Simple URLs gives you complete control over how your links look and where they redirect. It also allows you to group, organize, and automate your link strategy completely.

= Can I use Simple URLs with any WordPress theme? =

Absolutely! Simple URLs operates mainly in the WordPress admin, but the front end features should be totally compatible with any WordPress theme.

= Can I use Simple URLs on non-WordPress sites? =

Simple URLs is a WordPress-only plugin. As such it can only be installed on WordPress.org based websites or WordPress.com Business domains. You can install Simple URLs on any new or existing WordPress website without interrupting your existing content. The shortened links you create with Simple URLs on your WordPress website can be shared anywhere, such as forums, social media, email campaigns, PDF and Word Documents, QR Codes… basically anywhere you can share a link.

= Can I track affiliate links in Google Analytics? =

Yes, you can either use the free Google Analytics by Yoast plugin for this or connecting your site to Google Analytics directly. To use the GA plugin by Yoast, You’ll have to enable “Track outbound click and downloads” on its settings page and set the slug you’re using for your affiliate links in the advanced “Set path for internal links to track as outbound links” setting as well.

= Can I migrate existing links into Simple URLs? =

Yes, as long as you can export your links (either via an .htaccess file, an export script, or the database), you can use the Simple URLs Importer to easily import your links. You can read more about exporting your links here.

= When I try to access my new URL, I'm getting a 404 (not found) error =

Navigate to `Settings > Permalinks` and save them. No need to change anything, just click the save button.

= Can I change the URL structure to use something other than /go/ ??? =

Yes, by using the filter `simple_urls_slug`.

Usage:
```
add_filter( 'simple_urls_slug', function(){
    return 'redirect-me';
});
```

= Where can I find more information about growing an affiliate business? =

Head to our site at [getlasso.co](https://getlasso.co/?utm_source=SimpleURLs&utm_campaign=WP) to read the latest updates about successfully monetizing a WordPress website with affiliate links.

== Screenshots ==

1. The URL management screen
2. The URL create/edit screen
