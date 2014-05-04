CI_Template_lib
===============

Simple template library with some core functionalities to simplify development process for CodeIgniter 2.x

How to use
===============
1. Autoload your template config, template library. Url helper is optional to make it work with provided `app/views/template/default.php`
2. Edit your template configuration file `application/config/template.php`
3. Create a `app/controllers/Dashboard.php` and `app/views/dashboard/index.php`
4. Inside your controller's `index()` method, call `$this->template->load();` to autoload previously created view file

Documentation
===============

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
