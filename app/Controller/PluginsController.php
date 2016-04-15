<?php
Class PluginsController extends AppController{

	public function admin_index(){
		if($this->Auth->user('role') > 1){
			
		}
		else{
			throw new NotFoundException();
		}
	}

	// public function admin_enabled($name){
	// 	if($this->Auth->user('role') > 1){
	// 		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
	// 		$api->call('plugins.name.enable', [$name]);
	// 		$this->Session->setFlash($name.' a été activé !', 'toastr_success');
	// 		$this->redirect($this->referer());
	// 	}
	// 	else{
	// 		throw new NotFoundException();
	// 	}
	// }

	// public function admin_disabled($name){
	// 	if($this->Auth->user('role') > 1){
	// 		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
	// 		$api->call('plugins.name.disabled', [$name]);
	// 		$this->Session->setFlash($name.' a été désactivé !', 'toastr_success');
	// 		$this->redirect($this->referer());
	// 	}
	// 	else{
	// 		throw new NotFoundException();
	// 	}
	// }
}