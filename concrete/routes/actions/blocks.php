<?php

defined('C5_EXECUTE') or die("Access Denied.");
/**
 * @var $router \Concrete\Core\Routing\Router
 */
$router->all('/render/', 'Block::render');
$router->all('/action/add/{cID}/{arHandle}/{btID}/{action}', 'Block\Action::add');
$router->all('/action/edit/{cID}/{arHandle}/{bID}/{action}', 'Block\Action::edit');
$router->all('/action/add_composer/{ptComposerFormLayoutSetControlID}/{action}', 'Block\Action::add_composer');
$router->all('/action/edit_composer/{cID}/{arHandle}/{ptComposerFormLayoutSetControlID}/{action}', 'Block\Action::edit_composer');

