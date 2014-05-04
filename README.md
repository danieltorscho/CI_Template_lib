CI_Template_lib
===============

Simple template library with some core functionalities to simplify development process for CodeIgniter 2.x

How to use
===============
1. Extract all files to your project root project.
2. Open `app/config/autoload.php`, add `'template'` to `$autoload['libraries']` and `$autoload['config']`
2. Edit your template configuration file `application/config/template.php`
3. Navigate to `yourwebsite.dev/index.php/welcome`

Template library handle most of the views logic on it's own. With simple `$this->template->load();` call inside the controller's method, it will automatically creates a `pagetitle`, `pagename`, `scripts`, `stylesheets` and subload a corresponding view file `controller/method.php` if nothing was provided in `load()` function.

Documentation
===============

Load custom view file:
  `$this->template->load('path/to/view.php');`
  
Load custom view file within a custom template file
  `$this->template->load('template/login', 'user/login/form');`

Set custom page title:<br/>
  `$this->template->title('Product page');`

Set custom breadcrumbs:<br/>
  `$this->template->crumb('E-commerce', 'ecommerce/index');`<br/>
  `$this->template->crumb('Products', 'ecommerce/products');`<br/>
  `$this->template->crumb('Product #391');`

Add custom javascript file loading:<br/>
  `$this->template->script('plugin/head.js', TRUE)`<br/>
  `$this->template->script('footer.js');`

Add custom css file loading:<br/>
  `$this->template->css('print.css', 'print');`
  
Set custom variables:<br/>
  `$this->template->set_item('articles', $articles);` // Now you are able to use `$articles` inside all subviews
