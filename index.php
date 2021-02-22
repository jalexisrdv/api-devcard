<?php

require_once 'utilities/Path.php';
define('ROOT_PATH', Path::getRootPath());
require_once ROOT_PATH . '/controllers/ControllerWidget.php';
require_once ROOT_PATH . '/controllers/ControllerProjectPost.php';
require_once ROOT_PATH . '/controllers/ControllerPersonalProject.php';
require_once ROOT_PATH . '/controllers/ControllerWorkExperience.php';
require_once ROOT_PATH . '/controllers/ControllerProfile.php';
require_once ROOT_PATH . '/controllers/ControllerCategory.php';
require_once ROOT_PATH . '/controllers/ControllerUser.php';
require_once ROOT_PATH . '/utilities/Route.php';

Route::add('/categories', function() { ControllerCategory::create(); }, 'post');
Route::add('/categories', function() { ControllerCategory::read(); }, 'get');
Route::add('/categories/([0-9]*)', function($id) { ControllerCategory::readById($id); }, 'get');
Route::add('/categories', function() { ControllerCategory::update(); }, 'put');
Route::add('/categories/([0-9]*)', function($id) { ControllerCategory::delete($id); }, 'delete');

Route::add('/projects', function() { ControllerPersonalProject::create(); }, 'post');
Route::add('/projects', function() { ControllerPersonalProject::read(); }, 'get');
Route::add('/projects/([0-9]*)', function($id) { ControllerPersonalProject::readById($id); }, 'get');
Route::add('/projects', function() { ControllerPersonalProject::update(); }, 'put');
Route::add('/projects/([0-9]*)', function($id) { ControllerPersonalProject::delete($id); }, 'delete');

Route::add('/profiles', function() { ControllerProfile::create(); }, 'post');
Route::add('/profiles', function() { ControllerProfile::read(); }, 'get');
Route::add('/profiles/([0-9]*)', function($id) { ControllerProfile::readById($id); }, 'get');
Route::add('/profiles', function() { ControllerProfile::update(); }, 'put');
Route::add('/profiles/([0-9]*)', function($id) { ControllerProfile::delete($id); }, 'delete');

Route::add('/posts', function() { ControllerProjectPost::create(); }, 'post');
Route::add('/posts', function() { ControllerProjectPost::read(); }, 'get');
Route::add('/posts/([0-9]*)', function($id) { ControllerProjectPost::readById($id); }, 'get');
Route::add('/posts', function() { ControllerProjectPost::update(); }, 'put');
Route::add('/posts/([0-9]*)', function($id) { ControllerProjectPost::delete($id); }, 'delete');

Route::add('/users', function() { ControllerUser::create(); }, 'post');
Route::add('/users', function() { ControllerUser::read(); }, 'get');
Route::add('/users/([0-9]*)', function($id) { ControllerUser::readById($id); }, 'get');
Route::add('/users', function() { ControllerUser::update(); }, 'put');
Route::add('/users/([0-9]*)', function($id) { ControllerUser::delete($id); }, 'delete');
Route::add('/users/login', function() { ControllerUser::login(); }, 'get');

Route::add('/widgets', function() { ControllerWidget::create(); }, 'post');
Route::add('/widgets', function() { ControllerWidget::read(); }, 'get');
Route::add('/widgets/([0-9]*)', function($id) { ControllerWidget::readById($id); }, 'get');
Route::add('/widgets', function() { ControllerWidget::update(); }, 'put');
Route::add('/widgets/([0-9]*)', function($id) { ControllerWidget::delete($id); }, 'delete');

Route::add('/works', function() { ControllerWorkExperience::create(); }, 'post');
Route::add('/works', function() { ControllerWorkExperience::read(); }, 'get');
Route::add('/works/([0-9]*)', function($id) { ControllerWorkExperience::readById($id); }, 'get');
Route::add('/works', function() { ControllerWorkExperience::update(); }, 'put');
Route::add('/works/([0-9]*)', function($id) { ControllerWorkExperience::delete($id); }, 'delete');

Route::run('/api_devcard');