<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController{

    public $uses = ['User', 'Informations', 'donationLadder', 'Support', 'supportComments', 'Shop', 'Vote', 'Code', 'shopHistory', 'starpassHistory', 'paypalHistory', 'sendTokensHistory'];

	public function beforeFilter(){
	    parent::beforeFilter();
        $this->Auth->allow();
	}

    public function index(){
        return $this->redirect($this->referer());
    }

	public function login(){
        if(!$this->Auth->user()){
            if($this->request->is('post')){
                if($this->Auth->login()){
                    //If the user does not have an IP, we add it!
                    if(empty($this->Auth->user('ip'))) {
                        $id = $this->Auth->user('id');
                        $this->User->id = $id;
                        $this->User->saveField('ip', $_SERVER["REMOTE_ADDR"]);
                    }
                    $this->Session->setFlash('Vous êtes maintenant connecté '.$this->Auth->user('username').'', 'success');
                    return $this->redirect($this->Auth->redirect(['controller' => 'posts', 'action' => 'index']));
                }
                else{
                    $this->Session->setFlash('Pseudo ou mot de passe invalide, vous pouvez réessayer', 'error');
                }
               				
            }
        }
        else{
            $this->Session->setFlash('Vous êtes déjà connecté', 'error');
            return $this->redirect($this->Auth->redirect(['controller' => 'posts', 'action' => 'index']));
        }
	}

	
	public function logout(){
	    $this->Auth->logout();
        return $this->redirect($this->Auth->redirect(['controller' => 'posts', 'action' => 'index']));
	}

    public function signup(){
        if($this->Auth->user()){
            $this->redirect($this->Auth->redirect(['controller' => 'posts', 'action' => 'index']));
        }else{
            if($this->request->is('post')){
                $this->User->set($this->request->data);
                $password = $this->request->data['User']['password'];
                $password_confirmation = $this->request->data['User']['password_confirmation'];
                $nb_account = $this->User->find('count');
                if($password == $password_confirmation){
					if($this->User->validates()){
						$this->User->create();
						if($this->User->save($this->request->data)){
							$avatar = 'https://cravatar.eu/helmavatar/'.$this->request->data['User']['username'];
							$this->User->saveField('avatar', $avatar);
							$this->User->saveField('ip', $_SERVER['REMOTE_ADDR']);
							$this->User->saveField('tokens', '0');
							$this->User->saveField('allow_email', '1');
							if($nb_account == 0){
								$this->User->saveField('role', '2');
							} else {
								$this->User->saveField('role', '0');
							}
							$this->Session->setFlash('Inscription réussie vous pouvez maintenant vous connecter', 'success');
								return $this->redirect(array('action' => 'login'));
						} else {
							$this->Session->setFlash('Un problème est survenu !', 'error');
						}
					} else {
						$this->Session->setFlash('Un problème est survenu !', 'error');
					}
                }else{
                    $this->Session->setFlash('Les mots de passe ne correspondent pas', 'error');
				}
            }
        }
    }

    public function profile($username = null){
        if($this->User->find('first', ['conditions' => ['User.username' => $username]])){
            $data = $this->User->find('first', ['conditions' => ['User.username' => $username]]);
            $ladder_vote = $this->User->find('all', ['conditions' => ['User.role = 0'], 'order' => ['User.votes DESC']]);
            $nb_votes = $this->Vote->find('first', ['conditions' => ['User.id' => $data['User']['id']]]);
            $tokens_buy = $this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $data['User']['id']]]);
            $this->set('data', $data);
            $this->set('ladder_vote', $ladder_vote);
            $this->set('nb_votes', $data['User']['votes']);
            if(empty($tokens_buy)){
                $this->set('tokens_buy', 0);
            }
            else{
                $this->set('tokens_buy', $tokens_buy['donationLadder']['tokens']);
            }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function account(){
        if($this->Auth->user()){
            $id = $this->Auth->user('id');
            $username = $this->Auth->user('username');
            $this->set('data', $this->User->find('first', ['conditions' => ['User.id' => $id]]));
            $this->set('shop_history', $this->shopHistory->find('all', ['conditions' => ['shopHistory.user_id' => $id], 'order' => ['shopHistory.created DESC']]));
            $this->set('starpass_history', $this->starpassHistory->find('all', ['conditions' => ['starpassHistory.user_id' => $id], 'order' => ['starpassHistory.created DESC']]));
            if($this->config['use_paypal'] == 1){
                $this->set('paypal_history', $this->paypalHistory->find('all', ['conditions' => ['paypalHistory.custom' => $id], 'order' => ['paypalHistory.created DESC']]));
            }
            $this->set('send_tokens_history', $this->sendTokensHistory->find('all', ['conditions' => ['sendTokensHistory.shipper' => $username], 'order' => ['sendTokensHistory.created DESC']]));
            $this->set('codes_history', $this->Code->find('all', ['conditions' => ['Code.user_id' => $id], 'order' => ['Code.created DESC']]));
            $this->set('count_shop_history', $this->shopHistory->find('count', ['conditions' => ['shopHistory.user_id' => $id]]));
            $this->set('count_starpass_history', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.user_id' => $id]]));
            $this->set('count_paypal_history', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.custom' => $id]]));
            $this->set('count_send_tokens_history', $this->sendTokensHistory->find('count', ['conditions' => ['sendTokensHistory.shipper' => $username]]));
            $this->set('count_codes_history', $this->Code->find('count', ['conditions' => ['Code.user_id' => $id]]));
            // Liste des utilisateurs pour l'autocomplete
            $this->set('users', $this->User->find('all'));
        }
        else{
            $this->redirect(['controller' => 'posts', 'action' => 'index']);
        }
    }

    public function update_account(){
        if($this->Auth->user()){
            $password = $this->request->data['User']['password'];
            $password_confirmation = $this->request->data['User']['password_confirmation'];
            if(!empty($password) && !empty($password_confirmation)){
            	if($password == $password_confirmation){
	                if(strlen($password) >= 6){
	                    $id = $this->Auth->user('id');
	                    $this->User->id = $id;
	                    $this->User->saveField('password', $password);
	                    $this->Session->setFlash('Mot de passe modifié avec succès !', 'success');
	                    $this->redirect(array('controller' => 'users', 'action' => 'account'));
	                }
	                else{
	                    $this->Session->setFlash('Le mot de passe doit contenir 6 caractères minimum', 'error');
	                    $this->redirect(array('controller' => 'users', 'action' => 'account'));
	                }
	            }
	            else{
	                $this->Session->setFlash('Les mots de passe ne correspondent pas', 'error');
	                $this->redirect(array('controller' => 'users', 'action' => 'account'));
	            }
            }
            else{
            	$id = $this->Auth->user('id');
                $this->User->id = $id;

                $this->Session->setFlash('Informations modifié avec succès !', 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'account'));
            }         
        }
        else{
            $this->redirect(['controller' => 'posts', 'action' => 'index']);
        }
    }

    public function forgot_password(){
        if($this->Auth->user()){
            $this->redirect(['controller' => 'posts', 'action' => 'index']);
        }
        else{
            if($this->request->is('post')){
                $email = $this->request->data['User']['email'];
                if($this->User->findByEmail($email)){
                    $newPassword = strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
                    $data = $this->User->find('first', array('conditions' => array('User.email' => $email)));
                    $this->User->id = $data['User']['id'];
                    $this->User->saveField('password', $newPassword);
                    $name_server = $this->config['name_server'];
                    $name_server = strtolower(preg_replace('/\s/', '', $name_server));
                    $Email = new CakeEmail();
                    $Email->from(array('admin@'.$name_server.'.com' => $name_server));
                    $Email->to($email);
                    $Email->subject('Mot de passe oublié');
                    $Email->send('Voici votre nouveau mot de passe : '.$newPassword);
                    $this->Session->setFlash('Email envoyé !', 'success');
                }
                else{
                    $this->Session->setFlash('Cette adresse email n\'existe pas dans notre base de données', 'error');
                }
            }
        }
    }

    public function admin_delete($id = null){
        if($this->Auth->user('role') > 1){
            $this->User->id = $id;
            if($this->User->exists()){
                if($this->User->delete($id)){
                    // Lorsque l'on supprime un compte on supprime également
                    // Son existance au niveau des donateurs, et des tickets supports
                    $this->donationLadder->deleteAll(['donationLadder.user_id' => $id]);
                    $this->Support->deleteAll(['Support.user_id' => $id]);
                    $this->supportComments->deleteAll(['supportComments.user_id' => $id]);
                    $this->Session->setFlash('Utilisateur supprimé !', 'toastr_success');
                    return $this->redirect(['controller' => 'users', 'action' => 'all']);
                }
                else{
                    $this->Session->setFlash('Un problème est survenu', 'toastr_error');
                    return $this->redirect($this->referer());
                }
            }
            else{
                $this->Session->setFlash('Cet utilisateur n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
            }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_edit($id = null){
        if($this->Auth->user('role') > 1){
            $this->User->id = $id;
            if($this->User->exists()){
                $this->set('items', $this->Shop->find('all'));
                $this->set('data', $this->User->find('first', ['conditions' => ['User.id' => $id]]));


                if($this->request->is('post')){
                    $this->User->id = $id;
                    if($this->User->save($this->request->data, ['validate' => false])){
                        $this->Session->setFlash('Utilisateur modifié !', 'toastr_success');
                        return $this->redirect(['controller' => 'users', 'action' => 'edit', $id]);
                    }
                    else{
                        $this->Session->setFlash('Un problème est survenu', 'toastr_error');
                        return $this->redirect(['controller' => 'users', 'action' => 'edit', $id]);
                    }
                }
            }
            else{
                $this->Session->setFlash('Cet utilisateur n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
            }
        }
    }

    public function admin_ban($id = null){
        if($this->Auth->user('role') > 1){
            $this->User->id = $id;
            if($this->User->exists()){
                $this->User->saveField('ban', 1);
                $this->Session->setFlash('Utilisateur banni !', 'toastr_success');
                return $this->redirect(['controller' => 'users', 'action' => 'all']);
                }
            else{
                $this->Session->setFlash('Cet utilisateur n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
                }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_unban($id = null){
        if($this->Auth->user('role') > 1){
            $this->User->id = $id;
            if($this->User->exists()){
                $this->User->saveField('ban', 0);
                $this->Session->setFlash('Utilisateur pardonné !', 'toastr_success');
                return $this->redirect(['controller' => 'users', 'action' => 'all']);
            }
            else{
                $this->Session->setFlash('Cet utilisateur n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
            }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_all(){
        if($this->Auth->user('role') > 1){
            $this->set('data', $this->User->find('all', ['order' => ['User.tokens' => 'DESC']]));
        }
        else{
            throw new NotFoundException();
        }
    }
}