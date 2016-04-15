<?php
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Admin Pages
	Router::connect('/admin', ['controller' => 'pages', 'action' => 'stats', 'admin' => true]);
	Router::connect('/admin/update', ['controller' => 'update', 'action' => 'index', 'admin' => true]);
	Router::connect('/admin/repair', ['controller' => 'pages', 'action' => 'repair', 'admin' => true]);
	Router::connect('/admin/configuration', ['controller' => 'informations', 'action' => 'index', 'admin' => true]);
	Router::connect('/admin/support', ['controller' => 'pages', 'action' => 'manage_tickets', 'admin' => true]);
	Router::connect('/admin/add_member', ['controller' => 'pages', 'action' => 'add_member', 'admin' => true]);
	Router::connect('/admin/list_member', ['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
	Router::connect('/admin/edit_member/:id', ['controller' => 'pages', 'action' => 'edit_member', 'admin' => true], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/admin/delete_member/:id', ['controller' => 'pages', 'action' => 'delete_member', 'admin' => true], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/admin/shop_history', ['controller' => 'pages', 'action' => 'shop_history', 'admin' => true]);
	Router::connect('/admin/starpass_history', ['controller' => 'pages', 'action' => 'starpass_history', 'admin' => true]);
	Router::connect('/admin/paypal_history', ['controller' => 'pages', 'action' => 'paypal_history', 'admin' => true]);
	Router::connect('/admin/list_donator', ['controller' => 'pages', 'action' => 'list_donator', 'admin' => true]);
	Router::connect('/admin/players', ['controller' => 'players', 'action' => 'index', 'admin' => true]);
	Router::connect('/admin/chat', ['controller' => 'pages', 'action' => 'chat_messages', 'admin' => true]);
	Router::connect('/admin/update', ['controller' => 'pages', 'action' => 'update', 'admin' => true]);
	Router::connect('/admin/install/update', ['controller' => 'pages', 'action' => 'installUpdate', 'admin' => true]);
	Router::connect('/admin/categories/add', ['controller' => 'pages', 'action' => 'add_shop_categories', 'admin' => true]);
	Router::connect('/admin/categories/list', ['controller' => 'pages', 'action' => 'list_shop_categories', 'admin' => true]);
	Router::connect('/admin/categories/edit/:id', ['controller' => 'pages', 'action' => 'edit_shop_categories', 'admin' => true], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/admin/categories/delete/:id', ['controller' => 'pages', 'action' => 'delete_shop_categories', 'admin' => true], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/admin/send_tokens/history', ['controller' => 'pages', 'action' => 'send_tokens_history', 'admin' => true]);
	Router::connect('/admin/send_tokens/delete/:id', ['controller' => 'pages', 'action' => 'send_tokens_delete', 'admin' => true], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/admin/stats', ['controller' => 'pages', 'action' => 'stats', 'admin' => true]);

	//Ticket System
	Router::connect('/support', ['controller' => 'pages', 'action' => 'add_ticket']);
	Router::connect('/tickets', ['controller' => 'pages', 'action' => 'list_tickets']);
	Router::connect('/tickets/:id', ['controller' => 'pages', 'action' => 'view_ticket'], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/delete_support_comment/:id', ['controller' => 'pages', 'action' => 'delete_support_comment'], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/open_ticket/:id', ['controller' => 'pages', 'action' => 'open_ticket'], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/close_ticket/:id', ['controller' => 'pages', 'action' => 'close_ticket'], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/close_my_ticket/:id', ['controller' => 'pages', 'action' => 'close_my_ticket'], ['pass' => ['id'], 'id' => '[0-9]+']);
	Router::connect('/answer_ticket', ['controller' => 'pages', 'action' => 'answer_ticket']);
	Router::connect('/equipe', ['controller' => 'pages', 'action' => 'team']);

	//Other Pages
	Router::connect('/', ['controller' => 'posts', 'action' => 'index']);
	Router::connect('/accueil', ['controller' => 'posts', 'action' => 'index']);
	Router::connect('/cgv', ['controller' => 'cgv', 'action' => 'cgv']);
	Router::connect('/connexion', ['controller' => 'users', 'action' => 'login']);
	Router::connect('/chat', ['controller' => 'chat', 'action' => 'index']);
	Router::connect('/faq', ['controller' => 'faq', 'action' => 'index']);
	Router::connect('/inscription', ['controller' => 'users', 'action' => 'signup']);
	Router::connect('/forgotpassword', ['controller' => 'users', 'action' => 'forgot_password']);
	Router::connect('/reglement', ['controller' => 'pages', 'action' => 'rules']);
	Router::connect('/recharger', ['controller' => 'shops', 'action' => 'reload']);
	Router::connect('/boutique', ['controller' => 'shops', 'action' => 'index']);
	Router::connect('/starpass', ['controller' => 'shops', 'action' => 'starpass']);
	Router::connect('/contact', ['controller' => 'pages', 'action' => 'contact']);
	Router::connect('/send_tokens', ['controller' => 'pages', 'action' => 'send_tokens']);
	Router::connect('/votes', ['controller' => 'votes', 'action' => 'index']);
	Router::connect('/vote', ['controller' => 'votes', 'action' => 'vote']);
	Router::connect('/profil/:username', ['controller' => 'users', 'action' => 'profile'], ['pass' => ['username'], 'username' => '[a-zA-Z0-9\-]+']);
	Router::connect('/promo', ['controller' => 'shops', 'action' => 'promo']);
	Router::connect('/pages/', ['controller' => 'cpages', 'action' => 'index']);
	Router::connect('/pages/:slug', ['controller' => 'cpages', 'action' => 'read'], ['pass' => ['slug'], 'slug' => '[a-z0-9\-]+']);
	Router::connect('/:slug-:id', ['controller' => 'posts', 'action' => 'read'], ['pass' => ['slug', 'id'], 'slug' => '[a-z0-9\-]+', 'id' => '[0-9]+']);

	/* Paypal IPN plugin */
	Router::connect('/paypal_ipn/process', array('plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'process'));
	/* Optional Route, but nice for administration */
	Router::connect('/paypal_ipn/:action/*', array('admin' => 'true', 'plugin' => 'paypal_ipn', 'controller' => 'instant_payment_notifications', 'action' => 'index'));
	/* End Paypal IPN plugin */

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/p/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
