<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('JSONAPI', 'Lib');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $viewClass = 'TwigView.Twig';
	public $ext = '.twig';
	public $uses = ['Informations', 'User', 'starpassHistory', 'Support', 'donationLadder', 'Button', 'Cpage', 'Widget'];
	public $helpers = ['Html', 'Form', 'PaypalIpn.Paypal', 'Session'];
	public $components = [
		'Session',
		'Auth' => [
			'loginRedirect' => ['controller' => 'posts', 'action' => 'index'],
			'logoutRedirect' => ['controller' => 'posts', 'action' => 'index']
		]
	];

	public function beforeFilter() {
		if(version_compare(PHP_VERSION, '5.4.0') < 0){
    		exit('Vous devez avoir PHP 5.4 minimum pour utiliser ExtazCMS');
		}

		if(is_dir(ROOT.'\install')){
			$dossier = ROOT . '\install';
			$dir_iterator = new RecursiveDirectoryIterator($dossier);
			$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
							// On supprime chaque dossier et chaque fichier	du dossier cible
			foreach($iterator as $fichier){
				$fichier->isDir() ? rmdir($fichier) : unlink($fichier);
			}
			rmdir(ROOT.'\install');
		}

		if((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))){
			$this->layout = 'admin';
		}
		// Variable qui regroupe toutes les infos depuis la bdd 
		$this->config = $this->Informations->find('first')['Informations'];

		// On déclare JSONAPI
		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);

		// On transmet les données
		// ExtazCMS
		$version = file_get_contents(ROOT . "/version.txt");
		$next_version = file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$version/nversion.txt");
		$last_version = file_get_contents("https://extaz-cms.fr/updates/version.txt");
		
		$this->version = $version;
		$this->next_version = $next_version;
		$this->last_version = $last_version;

		$this->set('version', 				$version);
		$this->set('next_version', 			$next_version);
		$this->set('last_version', 			$last_version);
		$this->set('xml', 					simplexml_load_file(ROOT . "/app/Language/fr/fr.xml"));
		$this->set('api', 					$api);
		$this->set('banner_url',         	$this->config['banner_url']);
		$this->set('use_igchat',         	$this->config['use_igchat']);
		$this->set('use_starpass',          $this->config['use_starpass']);
		$this->set('jsonapi_ip',            $this->config['jsonapi_ip']);
		$this->set('jsonapi_port',          $this->config['jsonapi_port']);
		$this->set('jsonapi_username',      $this->config['jsonapi_username']);
		$this->set('jsonapi_password',      $this->config['jsonapi_password']);
		$this->set('jsonapi_salt',          $this->config['jsonapi_salt']);
		$this->set('name_server',           $this->config['name_server']);
		$this->set('server_ip',             $this->config['ip_server']);
		$this->set('server_port',           $this->config['port_server']);
		$this->set('money_server',          $this->config['money_server']);
		$this->set('site_money',            $this->config['site_money']);
		$this->set('tax_percent',           $this->config['tax_percent']);
		$this->set('starpass_idp',          $this->config['starpass_idp']);
		$this->set('starpass_idd',          $this->config['starpass_idd']);
		$this->set('starpass_tokens',       $this->config['starpass_tokens']);
		$this->set('paypal_price',          $this->config['paypal_price']);
		$this->set('paypal_tokens',         $this->config['paypal_tokens']);
		$this->set('paypal_email',          $this->config['paypal_email']);
		$this->set('logo_url',              $this->config['logo_url']);
		$this->set('url_site',              $this->config['url_site']);
		$this->set('use_store',             $this->config['use_store']);
		$this->set('use_paypal',            $this->config['use_paypal']);
		$this->set('use_economy',           $this->config['use_economy']);
		$this->set('use_server_money',      $this->config['use_server_money']);
		$this->set('use_team',              $this->config['use_team']);
		$this->set('use_faq',           	$this->config['use_faq']);
		$this->set('use_contact',           $this->config['use_contact']);
		$this->set('use_rules',             $this->config['use_rules']);
		$this->set('use_donation_ladder',   $this->config['use_donation_ladder']);
		$this->set('use_slider',            $this->config['use_slider']);
		$this->set('use_votes',             $this->config['use_votes']);
		$this->set('use_votes_ladder',      $this->config['use_votes_ladder']);
		$this->set('happy_hour',            $this->config['happy_hour']);
		$this->set('happy_hour_bonus',      $this->config['happy_hour_bonus']);
		$this->set('rules',                 $this->config['rules']);
		$this->set('cgvandcgu',             $this->config['cgvandcgu']);
		$this->set('background',            $this->config['background']);
		$this->set('chat_prefix',           $this->config['chat_prefix']);
		$this->set('chat_nb_messages',      $this->config['chat_nb_messages']);
		$this->set('analytics',             $this->config['analytics']);
		$this->set('maintenance',           $this->config['maintenance']);
		$this->set('votes_url_1',           $this->config['votes_url_1']);
		$this->set('votes_url_2',           $this->config['votes_url_2']);
		$this->set('votes_url_3',           $this->config['votes_url_3']);
		$this->set('votes_url_4',           $this->config['votes_url_4']);
		$this->set('votes_url_5',           $this->config['votes_url_5']);
		$this->set('votes_description',     $this->config['votes_description']);
		$this->set('votes_time_1',          $this->config['votes_time_1']);
		$this->set('votes_time_2',          $this->config['votes_time_2']);
		$this->set('votes_time_3',          $this->config['votes_time_3']);
		$this->set('votes_time_4',          $this->config['votes_time_4']);
		$this->set('votes_time_5',          $this->config['votes_time_5']);
		$this->set('votes_name_1',          $this->config['votes_name_1']);
		$this->set('votes_name_2',          $this->config['votes_name_2']);
		$this->set('votes_name_3',          $this->config['votes_name_3']);
		$this->set('votes_name_4',          $this->config['votes_name_4']);
		$this->set('votes_name_5',          $this->config['votes_name_5']);
		$this->set('votes_reward',          $this->config['votes_reward']);
		$this->set('votes_command',         $this->config['votes_command']);
		$this->set('votes_ladder_limit',    $this->config['votes_ladder_limit']);
		$this->set('customs_buttons_title', $this->config['customs_buttons_title']);
		// Le reste
		$this->set('connected', $this->Auth->user());
		$this->connected = $this->Auth->user();
		$this->set('username', $this->Auth->user('username'));
		$this->username = $this->Auth->user('username');
		$this->set('email', $this->Auth->user('email'));
		$this->avatar = $this->Auth->user('avatar');

		if($this->Auth->user()) {
			$user_informations = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
			$this->set('avatar', $user_informations['User']['avatar']);
			$this->set('tokens', $user_informations['User']['tokens']);
			$this->tokens = $user_informations['User']['tokens'];
			$this->set('role', $user_informations['User']['role']);
			$this->set('ban', $user_informations['User']['ban']);
			$this->set('cgvcgu', $user_informations['User']['cgvcgu']);
			$this->set('reward', $user_informations['User']['reward']);
		}
		else{
			$this->set('role', 0);
		}
		$this->set('tickets', $this->Support->find('count', ['conditions' => ['Support.user_id' => $this->Auth->user('id'), 'Support.resolved' => 0]]));
		$this->set('nb_tickets_admin', $this->Support->find('count', ['conditions' => ['Support.resolved' => '0']]));
		if($this->Auth->user() && $this->config['use_economy'] == 1){
			$this->set('money_in_game', $api->call('players.name.bank.balance', [$this->Auth->user('username')])[0]['success']);
		}
		// Donnation Ladder
		if($this->donationLadder->find('all')){
			$this->set('best_donator', $this->donationLadder->find('first', ['order' => ['donationLadder.tokens DESC']]));
			$this->set('last_donator', $this->donationLadder->find('first', ['order' => ['donationLadder.updated DESC']]));
			$this->set('nb_donator', $this->donationLadder->find('count'));
		}
		else{
			$this->set('nb_donator', $this->donationLadder->find('count'));
		}
		// Boutique
		/*
		* Nombre de tokens gratuit avec un code Starpass
		* starpass_happy_hour_bonus = bonus de l'happy (en %) divisé par 100 fois le nombre de tokens obtenu pour un code Starpass
		*/
		$starpass_happy_hour_bonus = round($this->config['happy_hour_bonus'] / 100 * $this->config['starpass_tokens']);
		$this->starpass_happy_hour_bonus = $starpass_happy_hour_bonus;
		$this->set('starpass_happy_hour_bonus', $starpass_happy_hour_bonus);
		/*
		* Nombre de tokens gratuit avec un paiement via PayPal
		* paypal_happy_hour_bonus = bonus de l'happy (en %) divisé par 100 fois le nombre de tokens obtenu pour un paiement via PayPal
		*/
		$paypal_happy_hour_bonus = round($this->config['happy_hour_bonus'] / 100 * $this->config['paypal_tokens']);
		$this->paypal_happy_hour_bonus = $paypal_happy_hour_bonus;
		$this->set('paypal_happy_hour_bonus', $paypal_happy_hour_bonus);
		/*
		* Nombre total de tokens obtenu avec un code Starpass pendant une happy hour
		* starpass_tokens_during_happy_hour = Nombre de tokens gratuit grâce à l'happy hour + le nombre de tokens normal
		*/
		$starpass_tokens_during_happy_hour = $starpass_happy_hour_bonus + $this->config['starpass_tokens'];
		$this->starpass_tokens_during_happy_hour = $starpass_tokens_during_happy_hour;
		$this->set('starpass_tokens_during_happy_hour', $starpass_tokens_during_happy_hour);
		/*
		* Nombre total de tokens obtenu avec un paiement via PayPal pendant une happy hour
		* paypal_tokens_during_happy_hour = Nombre de tokens gratuit grâce à l'happy hour + le nombre de tokens normal
		*/
		$paypal_tokens_during_happy_hour = $paypal_happy_hour_bonus + $this->config['paypal_tokens'];
		$this->paypal_tokens_during_happy_hour = $paypal_tokens_during_happy_hour;
		$this->set('paypal_tokens_during_happy_hour', $paypal_tokens_during_happy_hour);
		// Widgets pour la sidebar
		$this->set('widgets', $this->Widget->find('all', ['conditions' => ['Widget.visible' => 1], 'order' => ['Widget.order ASC']]));
		// Boutons pour la sidebar
		$this->set('buttons', $this->Button->find('all', ['order' => ['Button.order ASC']]));
		// Pages customs
		$this->set('cpages', $this->Cpage->find('all'));
		$this->set('nb_cpages', $this->Cpage->find('count'));
		// Si JSONAPI est injoignable
		if($api->call('server.bukkit.version')[0]['result'] != 'success'){
			if($this->request->url == 'boutique'){
				$this->render('/Errors/jsonapi');
			}
		}
		else{
			$players = $api->call('players.online')[0]['success'];
			$this->set('count_players', count($players));
		}
		// La page des options à besoin de cette variable
		if($this->request->url == 'admin/configuration'){
			$this->set('config', $this->config);
		}
		// Maintenance du site
		if($this->config['maintenance'] == 1){
			if($this->Auth->user('role') < 1){
				if($this->request->url != 'connexion'){
					$this->render('/Errors/maintenance');
				}
			}
		}
		// Autre
		Configure::write('Config.language', 'fra');
		$this->Auth->allow();
	}


	function afterPaypalNotification($txnId){
		$informations = $this->Informations->find('first');
		$informations = $informations['Informations'];
		// On recup les données paypal
		$transaction = ClassRegistry::init('PaypalIpn.InstantPaymentNotification')->findById($txnId);
		$this->log($transaction['InstantPaymentNotification']['id'], 'paypal');
		$mc_gross = $informations['paypal_price'].'.00';
		// Si la transaction a été effectué
		if($transaction['InstantPaymentNotification']['payment_status'] == 'Completed'){
			// Si c'est bien en EUROS
			if($transaction['InstantPaymentNotification']['mc_currency'] == 'EUR'){
				// Si le prix n'a pas été modifié 
				if($transaction['InstantPaymentNotification']['mc_gross'] == $mc_gross){
					/*
					* Nombre de tokens gratuit avec un paiement via PayPal
					* paypal_happy_hour_bonus = bonus de l'happy (en %) divisé par 100 fois le nombre de tokens obtenu pour un paiement via PayPal
					*/
					$paypal_happy_hour_bonus = $informations['happy_hour_bonus'] / 100 * $informations['paypal_tokens'];
					/*
					* Nombre total de tokens obtenu avec un paiement via PayPal pendant une happy hour
					* paypal_tokens_during_happy_hour = Nombre de tokens gratuit grâce à l'happy hour + le nombre de tokens normal
					*/
					$paypal_tokens_during_happy_hour = $paypal_happy_hour_bonus + $informations['paypal_tokens'];
					// Nombre de tokens sans happy hour
					$paypal_tokens = $informations['paypal_tokens'];
					// On recup les infos de l'utlisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $transaction['InstantPaymentNotification']['custom']]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nv nb de tokens
					if($informations['happy_hour'] == 1){
						$new_user_tokens = $user_tokens + $paypal_tokens_during_happy_hour;
						$this->User->id = $transaction['InstantPaymentNotification']['custom'];
						$this->User->saveField('tokens', $new_user_tokens);
					}
					else{
						$new_user_tokens = $user_tokens + $paypal_tokens;
						$this->User->id = $transaction['InstantPaymentNotification']['custom'];
						$this->User->saveField('tokens', $new_user_tokens);
					}
					// Donation ladder
					if($this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $transaction['InstantPaymentNotification']['custom']]])){
						if($informations['happy_hour'] == 1){
							$donationLadder = $this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $transaction['InstantPaymentNotification']['custom']]]);
							$new_user_tokens = $donationLadder['donationLadder']['tokens'] + $paypal_tokens_during_happy_hour;
							$this->donationLadder->id = $donationLadder['donationLadder']['id'];
							$this->donationLadder->saveField('tokens', $new_user_tokens);
						}
						else{
							$donationLadder = $this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $transaction['InstantPaymentNotification']['custom']]]);
							$new_user_tokens = $donationLadder['donationLadder']['tokens'] + $paypal_tokens;
							$this->donationLadder->id = $donationLadder['donationLadder']['id'];
							$this->donationLadder->saveField('tokens', $new_user_tokens);
						}
					}
					else{
						if($informations['happy_hour'] == 1){
							$this->donationLadder->create;
							$this->donationLadder->saveField('user_id', $transaction['InstantPaymentNotification']['custom']);
							$this->donationLadder->saveField('tokens', $paypal_tokens_during_happy_hour);
						}
						else{
							$this->donationLadder->create;
							$this->donationLadder->saveField('user_id', $transaction['InstantPaymentNotification']['custom']);
							$this->donationLadder->saveField('tokens', $paypal_tokens);
						}
					}
				}
			}

		}
	} 
}
