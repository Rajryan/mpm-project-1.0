# mpm_project
This is a micro-framework built with php

# Documentation

1. How to Use
- clone the repository
  `$ git clone https://github.com/Rajryan/mpm_project.git   <verbose_name>`

- navigate to directory named <verbose_name>
  `$ cd <verbose_name>`

- delete .git folder in this repository.
  `$ rm -r .git`

- now start your project you can initialise git to track your project.
 `$ git init`

- Run `php manage migrate`
  This will create default User Table with these field :
  * username \- a varchar field
  * password \- varchar(255) field
  * email \- varchar field
  * mobile number \- bigint field 
  * is_staff \- BIT FIELD 0 OR 1
  * joined_on \- Datetime Field with default current_timestamp.

- Note : MYSQL SERVICE NEEDED RUN FIRST `$ mysqld`.

- Run `$ php manage serve`
    this will serve your project on  `http://localhost:8080/`

- You will see a Home page with builtin Authentication System.

- To Create an app Run `$ php manage createapp   <app_name>`
  * this will create a directory in Current Directory named `<app_name>`
  * In this `<app_name>` following directories   or files will be automatically Created :
    + `forms.php` (create your  customise form structure )
    + `views.php` (Create Your Logics Here for the app)
    + `urls.php` (Create Url Patterns here)
    + `migrations/` (write your Database          Tables and Structural Changes
      to apply change to database Run 
      `$ php manage makemigrations <app_name>`
      )
    
    + `migrations/initial.php` (pre-written file of migration you can write another migrations file named according to your choice)
  
 * for templates , create `templates/` folder and create `templates/*.php` files 

 * connect your app to main project
   + in config/urls.php file look up for        `$urlpatterns` array and  add your app's url patterns  like  this :
    ```
     $urlpatterns = [
        ............
        ...includes('<app_name>/urls'), 
       //(...) are must to add before includes()
        ..........
      ];
    ```
   +  in `config/settings.php` 
    ```
      APPS = [
       .... Builtinapps ....
      '<app_name>',
      ],
    ```



2. How to Write Logics.
 in <app_name>/views.php.
 _______________________________________
| <app_name>/views.php                |
|_____________________________________|
| <?php if(!defined('SECURE'))        |
|   exit("<h1>Access Denied<h1>");        |
|                                     |
|function view_name($server, array $args) {                              |  |
| $data = array('a'=>'b'); //Data |passed to  template                                     
| /* Write  Your Logic Here */        |
|   return render($server,'templates_path',   |$data);  //to render template        |
|            ( or )                          |
|   return "Hello"; //render string          |
|}                                           |
 _____________________________________________
 NOTE : $args and $data are optional associative array
  • $args  contains group_name and value pairs
    Capture from Urls  Patterns
   - EG : 
    "http://localhost:8080/<?P<name>\w+>/" is matched against "http://localhost:8080/raaz/"  
    $args will be array("name"=>"raaz");
   
   • $data contains values that you want to pass to template
    - EG :
    $data = array("name"=>"Raaz","Username"=>"xyz");
    in corresponding template specified in render() function we can access these values - like 
    
    <?php # templates/abc.php
          ----
          echo $name;
          echo $Username;
          ----- ?>
  
  
3) HOW to Write $urlpatterns in  <app_name>/urls.php

 ___________________________________________
| <app_name>/urls.php                        |
|____________________________________________|
| <?php if(!defined('SECURE'))               |
|   exit("<h1>Access Denied");               |
|                                            |
|$urlpatterns = [                            | |     array(                                 |
|      'path'=>"/path/to/",                  |
|      "view"=>"name_of_logic_function",     |
|      'name'=>"reverse_for_url"             |
|     ),                                     |
| ];                                         |
 ____________________________________________
    
    
 4) HOW to Write forms in <app_name>/forms.php
 
  __________________________________________
 | <app_name>/forms.php                     |
 |__________________________________________|
 |<?php if(!defined('SECURE'))              | |exit("<h1>Access Denied");                |
 | require_once "mpm/forms.php";            |
 |                                          |
 |class MyForm extends forms\Form {         |
 | public $prop1,$prop2;                    |
 | public function __construct() {          |
 |   $this->prop1 = new                     | |forms\InputField("Label");                |
 |   $this->prop2 = new                     | |forms\PasswordField("Label");             |
 | }                                        |
 |}                                         |
 |__________________________________________|
 // Now Create  A Instanse 
 $form = new MyForm();
 
 // to render in template
// Make instanse `$form`  accessible in template
 <?php echo $form->render_form(); ?>
