CodeIgniter 2+ Simple Template Library
===============

Simple template library with some core functionalities to simplify the development process for CodeIgniter 2.x.

How to use
===============
1. Extract all files to your project root directory. Make sure to overwrite all files if prompted.
2. Open `app/config/autoload.php`, add `'template'` to `$autoload['libraries']` and `$autoload['config']`.
2. Edit your template configuration file `application/config/template.php`.
3. Navigate to `yourwebsite.dev/index.php/welcome`.

Template library handles most of the views logic on its own.

With simple `$this->template->load();` call inside the controller's method, it will automatically create `pagetitle`, `pagename`, `scripts`, `stylesheets` variables and subload a corresponding subview file `controller/method.php` if nothing was provided in `load()` function.


Documentation
===============

Load custom view file:<br/>
  `$this->template->load('path/to/view.php');`
  
Load custom view file within a custom template file:<br/>
  `$this->template->load('template/login', 'user/login/form');`

Set custom page title:<br/>
  `$this->template->title('Product page');`

Set custom breadcrumbs:<br/>
  `$this->template->crumb('E-commerce', 'ecommerce/index');`<br/>
  `$this->template->crumb('Products', 'ecommerce/products');`<br/>
  `$this->template->crumb('Product #391');`

Add custom JavaScript file loading:<br/>
  `$this->template->script('plugin/head.js', TRUE)`<br/>
  `$this->template->script('footer.js');`

Add custom CSS file loading:<br/>
  `$this->template->css('print.css', 'print');`
  
Set custom variables:<br/>
  `$this->template->set_item('articles', $articles);` // Now you are able to use `$articles` inside all subviews
