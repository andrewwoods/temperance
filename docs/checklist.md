
# Theme Development Checklist

## During Your Theme Development

**Required:**

[ ] Use semantic HTML to develop your theme
[ ] Use [accessible design techniques](https://developer.wordpress.org/themes/functionality/accessibility/)
[ ] Design the "Page Not Found" Error page (404.php)
[ ] Test your theme with [Theme Unit Test](https://codex.wordpress.org/Theme_Unit_Test) plugin.
[ ] Check [required accessibility](https://make.wordpress.org/themes/handbook/review/accessibility/required/) items
[ ] Check all registered menus are being used
[ ] Internationalize - wrap your string with WordPress' I18N functions
[ ] Develop your theme using the [WordPress coding standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/)
[ ] Check that your theme follows [UI Best Practices](https://developer.wordpress.org/themes/advanced-topics/ui-best-practices/)
[ ] Which [Post Formats](https://developer.wordpress.org/themes/functionality/post-formats/) will you support?
[ ] Ensure you are [including your CSS and JS](https://developer.wordpress.org/themes/basics/including-css-javascript/) correctly.
[ ] Update your readme.txt
[ ] Update Version in style.css, readme.txt, README.md, and CHANGELOG.md
[ ] Update the admin footer text in temperance_custom_admin_footer() - delete function if unwanted


**Optional:**


[ ] Set $content_width - see the [Codex Page](https://codex.wordpress.org/Content_Width)


## After you theme development is complete

[ ] Theme description - Describe your theme for WordPress.org users
[ ] Check the License in style.css - Is the GPL what you want?
[ ] Create Favicons for Apple and Windows devices
[ ] Create `screenshot.png` (1200w x 900h)
[ ] Create a theme `CHANGELOG.md` from `docs/CHANGELOG.md`
[ ] Create a theme `README.md` from `docs/README.md`



## Releasing On WordPress.org Theme Repository

[ ] Theme tags - Update your theme tags for the WordPress.org repository
[ ] Create Theme Assets for the WordPress.org
    - [Custom Header](https://developer.wordpress.org/themes/functionality/custom-headers/a)
    - [Custom Logo](https://developer.wordpress.org/themes/functionality/custom-logo/)
[ ] Create a customizer class to manage theme options - see sample in library/classes
[ ] analyze your theme using [VIP theme scanner](https://github.com/Automattic/vip-scanner) If you're publishing it WordPress VIP theme
[ ] Analyze your site with http://cssstats.com


