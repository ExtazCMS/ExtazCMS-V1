<?php
Class AvatarsController extends AppController{

	public $uses = ['User', 'Informations'];

	public function add(){
		if($this->Auth->user()){
			// On verifie que l'extension est valide
			$file = $_FILES['file'];
			$extensions = ['jpg', 'jpeg', 'png'];
			$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			if(in_array($extension, $extensions)){
				$user_id = $this->Auth->user('id');
				// On enregistre le fichier
				move_uploaded_file($file['tmp_name'], IMAGES . 'avatars' . DS . $user_id . '.jpg');
				// On sauvegarde
				$avatar = 'avatars/'.$user_id.'.jpg';
				$this->User->id = $user_id;
				$this->User->saveField('avatar', $avatar);
				// Redirection
				$this->Session->setFlash('Votre avatar a été ajouté !', 'success');
				return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'avatar']]);
			}
			else{
				$this->Session->setFlash('Type de fichier invalide', 'error');
				return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'avatar']]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function delete(){
		if($this->Auth->user()){
			$dir = new Folder('../webroot/img/avatars/');
			if($dir->path != null){
				$user_id = $this->Auth->user('id');
				// On supprime le fichier
				$files = $dir->find($user_id.'.jpg');
				foreach($files as $file){
				    $file = new File($dir->pwd() . DS . $file);
				    $file->delete();
				    $file->close();
				}
				// On sauvegarde
				$avatar = 'https://cravatar.eu/helmavatar/'.$this->username;
				$this->User->id = $user_id;
				$this->User->saveField('avatar', $avatar);
				// Redirection
				$this->Session->setFlash('Votre avatar a été supprimé !', 'success');
				return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'avatar']]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_reset($user_id){
		if($this->Auth->user('role') > 1){
			$dir = new Folder('../webroot/img/avatars/');
			if($dir->path != null){
				// On supprime le fichier
				$files = $dir->find($user_id.'.jpg');
				foreach($files as $file){
				    $file = new File($dir->pwd() . DS . $file);
				    $file->delete();
				    $file->close();
				}
				// On sauvegarde
				$user = $this->User->find('first', ['conditions' => ['User.id' => $user_id]]);
				$username = $user['User']['username'];
				$avatar = 'https://cravatar.eu/helmavatar/'.$username;
				$this->User->id = $user_id;
				$this->User->saveField('avatar', $avatar);
				// Redirection
				$this->Session->setFlash('L\'avatar de '.$username.' a été réinitialisé', 'toastr_success');
				return $this->redirect(['controller' => 'users', 'action' => 'edit', $user_id]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}
}