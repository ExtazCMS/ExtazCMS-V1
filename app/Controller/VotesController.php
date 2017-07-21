<?php
Class VotesController extends AppController{

	public $uses = ['Vote', 'User', 'Informations'];

	public function index(){
		if($this->Auth->user()){

            if($this->Auth->user('ban') == 1){
                $this->Session->setFlash('Les joueurs bannis n\'ont pas accès au système de vote', 'error');
                return $this->redirect(['controller' => 'posts', 'action' => 'index']);
            }

			$nb_votes = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
			$nb_votes = $nb_votes['User']['votes'];
			$this->set('nb_votes', $nb_votes);
			if($this->config['use_votes_ladder'] == 1){
				$data = $this->User->find('all', ['order' => ['User.votes DESC'], 'limit' => 30]);
				$this->set('data', $data);
			}
		$time = time();
		$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
		
		
		@$next_vote1 = $vote['Vote']['next_vote_1'];
		
		$time_to_vote_in_seconds_1 = $next_vote1 - $time;
		$time_to_vote_in_seconds_1 = round($time_to_vote_in_seconds_1);
		
		$time_to_vote_in_minutes_1 = $next_vote1 - $time;
		$time_to_vote_in_minutes_1 = $time_to_vote_in_minutes_1 / 60;
		$time_to_vote_in_minutes_1 = round($time_to_vote_in_minutes_1);
		
		$time_to_vote_in_hours_1 = $next_vote1 - $time;
		$time_to_vote_in_hours_1 = $time_to_vote_in_hours_1 / 60;
		$time_to_vote_in_hours_1 = $time_to_vote_in_hours_1 / 60;
		$time_to_vote_in_hours_1 = round($time_to_vote_in_hours_1);
		
		$this->set('time_to_vote_in_seconds_1', $time_to_vote_in_seconds_1);
		$this->set('time_to_vote_in_minutes_1', $time_to_vote_in_minutes_1);
		$this->set('time_to_vote_in_hours_1', $time_to_vote_in_hours_1);
		
		
		@$next_vote2 = $vote['Vote']['next_vote_2'];
		
		$time_to_vote_in_seconds_2 = $next_vote2 - $time;
		$time_to_vote_in_seconds_2 = round($time_to_vote_in_seconds_2);
		
		$time_to_vote_in_minutes_2 = $next_vote2 - $time;
		$time_to_vote_in_minutes_2 = $time_to_vote_in_minutes_2 / 60;
		$time_to_vote_in_minutes_2 = round($time_to_vote_in_minutes_2);
		
		$time_to_vote_in_hours_2 = $next_vote2 - $time;
		$time_to_vote_in_hours_2 = $time_to_vote_in_hours_2 / 60;
		$time_to_vote_in_hours_2 = $time_to_vote_in_hours_2 / 60;
		$time_to_vote_in_hours_2 = round($time_to_vote_in_hours_2);
		
		$this->set('time_to_vote_in_seconds_2', $time_to_vote_in_seconds_2);
		$this->set('time_to_vote_in_minutes_2', $time_to_vote_in_minutes_2);
		$this->set('time_to_vote_in_hours_2', $time_to_vote_in_hours_2);
		
		
		@$next_vote3 = $vote['Vote']['next_vote_3'];
		
		$time_to_vote_in_seconds_3 = $next_vote3 - $time;
		$time_to_vote_in_seconds_3 = round($time_to_vote_in_seconds_3);
		
		$time_to_vote_in_minutes_3 = $next_vote3 - $time;
		$time_to_vote_in_minutes_3 = $time_to_vote_in_minutes_3 / 60;
		$time_to_vote_in_minutes_3 = round($time_to_vote_in_minutes_3);
		
		$time_to_vote_in_hours_3 = $next_vote3 - $time;
		$time_to_vote_in_hours_3 = $time_to_vote_in_hours_3 / 60;
		$time_to_vote_in_hours_3 = $time_to_vote_in_hours_3 / 60;
		$time_to_vote_in_hours_3 = round($time_to_vote_in_hours_3);
		
		$this->set('time_to_vote_in_seconds_3', $time_to_vote_in_seconds_3);
		$this->set('time_to_vote_in_minutes_3', $time_to_vote_in_minutes_3);
		$this->set('time_to_vote_in_hours_3', $time_to_vote_in_hours_3);
		
		
		@$next_vote4 = $vote['Vote']['next_vote_4'];
		
		$time_to_vote_in_seconds_4 = $next_vote4 - $time;
		$time_to_vote_in_seconds_4 = round($time_to_vote_in_seconds_4);
		
		$time_to_vote_in_minutes_4 = $next_vote4 - $time;
		$time_to_vote_in_minutes_4 = $time_to_vote_in_minutes_4 / 60;
		$time_to_vote_in_minutes_4 = round($time_to_vote_in_minutes_4);
		
		$time_to_vote_in_hours_4 = $next_vote1 - $time;
		$time_to_vote_in_hours_4 = $time_to_vote_in_hours_4 / 60;
		$time_to_vote_in_hours_4 = $time_to_vote_in_hours_4 / 60;
		$time_to_vote_in_hours_4 = round($time_to_vote_in_hours_4);
		
		$this->set('time_to_vote_in_seconds_4', $time_to_vote_in_seconds_4);
		$this->set('time_to_vote_in_minutes_4', $time_to_vote_in_minutes_4);
		$this->set('time_to_vote_in_hours_4', $time_to_vote_in_hours_4);
		
		
		@$next_vote5 = $vote['Vote']['next_vote_5'];
		
		$time_to_vote_in_seconds_5 = $next_vote5 - $time;
		$time_to_vote_in_seconds_5 = round($time_to_vote_in_seconds_5);
		
		$time_to_vote_in_minutes_5 = $next_vote5 - $time;
		$time_to_vote_in_minutes_5 = $time_to_vote_in_minutes_5 / 60;
		$time_to_vote_in_minutes_5 = round($time_to_vote_in_minutes_5);
		
		$time_to_vote_in_hours_5 = $next_vote5 - $time;
		$time_to_vote_in_hours_5 = $time_to_vote_in_hours_5 / 60;
		$time_to_vote_in_hours_5 = $time_to_vote_in_hours_5 / 60;
		$time_to_vote_in_hours_5 = round($time_to_vote_in_hours_5);
		
		$this->set('time_to_vote_in_seconds_5', $time_to_vote_in_seconds_5);
		$this->set('time_to_vote_in_minutes_5', $time_to_vote_in_minutes_5);
		$this->set('time_to_vote_in_hours_5', $time_to_vote_in_hours_5);
		
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function vote1() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {

			// On met time dans une variable
			$time = time();

			// On récupère les infos depuis la base de données
			$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
			@$next_vote = $vote['Vote']['next_vote_1'];
			$nb_votes = $this->Vote->find('count', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')]]);

			// Temps avant de revoter en secondes
			$time_to_vote_in_seconds = $this->config['votes_time_1'] * 60;
			$time_to_vote_in_seconds = $time + $time_to_vote_in_seconds;

			// Temps avant de revoter en minutes
			$time_to_vote_in_minutes = $next_vote - $time;
			$time_to_vote_in_minutes = $time_to_vote_in_minutes / 60;
			$time_to_vote_in_minutes = round($time_to_vote_in_minutes);

			// Si on n'a jamais voté ou si le temps nécessaire avant un nouveau vote s'est écoulé
			if($nb_votes == 0 OR $time >= $next_vote){
			
				//On récupère les valeur des autre votes
			
				$vote_2 = $vote['Vote']['next_vote_2'];
				$vote_3 = $vote['Vote']['next_vote_3'];
				$vote_4 = $vote['Vote']['next_vote_4'];
				$vote_5 = $vote['Vote']['next_vote_5'];
			
				// On enregistre le nouveau vote
				$this->Vote->create;
				$this->Vote->saveField('user_id', $this->Auth->user('id'));
				$this->Vote->saveField('ip', $_SERVER['REMOTE_ADDR']);
				$this->Vote->saveField('next_vote_1', $time_to_vote_in_seconds);
				$this->Vote->saveField('next_vote_2', $vote_2);
				$this->Vote->saveField('next_vote_3', $vote_3);
				$this->Vote->saveField('next_vote_4', $vote_4);
				$this->Vote->saveField('next_vote_5', $vote_5);

				// On l'ajoute dans la table users
				$this->User->id = $this->Auth->user('id');
				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				$user_vote = $user['User']['votes'] + 1;
				$this->User->saveField('votes', $user_vote);

				// S'il y a une récompense à octroyer
				if($this->config['votes_reward'] != 0){
					// On récupère les infos de l'utilisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nouveau nb de tokens
					$new_user_tokens = $user_tokens + $this->config['votes_reward'];
					// On sauvegarde
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					$this->Vote->saveField('reward', $this->config['votes_reward']);
				}
				
				//On récupère le nombre de récompense déjà acquise
				$new_reward_count = $user['User']['reward'] + 1;
				//On enregistre le nouveau nombre de récompense disponible
				$this->User->saveField('reward', $new_reward_count);

				// On redirige vers la page de vote
				$this->Session->setFlash("Merci d'avoir voté !", 'success');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

			// Sinon on a déjà voté
			else{
				$this->Session->setFlash('Vous avez déjà voté, vous devez encore attendre '.$time_to_vote_in_minutes.' minutes', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		}
		else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function vote2() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {

			// On met time dans une variable
			$time = time();

			// On récupère les infos depuis la base de données
			$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
			@$next_vote = $vote['Vote']['next_vote_2'];
			$nb_votes = $this->Vote->find('count', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')]]);

			// Temps avant de revoter en secondes
			$time_to_vote_in_seconds = $this->config['votes_time_2'] * 60;
			$time_to_vote_in_seconds = $time + $time_to_vote_in_seconds;

			// Temps avant de revoter en minutes
			$time_to_vote_in_minutes = $next_vote - $time;
			$time_to_vote_in_minutes = $time_to_vote_in_minutes / 60;
			$time_to_vote_in_minutes = round($time_to_vote_in_minutes);

			// Si on n'a jamais voté ou si le temps nécessaire avant un nouveau vote s'est écoulé
			if($nb_votes == 0 OR $time >= $next_vote){
			
			//On récupère les valeur des autre votes
			
			$vote_1 = $vote['Vote']['next_vote_1'];
			$vote_3 = $vote['Vote']['next_vote_3'];
			$vote_4 = $vote['Vote']['next_vote_4'];
			$vote_5 = $vote['Vote']['next_vote_5'];
			
					// On enregistre le nouveau vote
					$this->Vote->create;
					$this->Vote->saveField('user_id', $this->Auth->user('id'));
					$this->Vote->saveField('ip', $_SERVER['REMOTE_ADDR']);
					$this->Vote->saveField('next_vote_2', $time_to_vote_in_seconds);
					$this->Vote->saveField('next_vote_1', $vote_1);
					$this->Vote->saveField('next_vote_3', $vote_3);
					$this->Vote->saveField('next_vote_4', $vote_4);
					$this->Vote->saveField('next_vote_5', $vote_5);

				// On l'ajoute dans la table users
				$this->User->id = $this->Auth->user('id');
				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				$user_vote = $user['User']['votes'] + 1;
				$this->User->saveField('votes', $user_vote);

				// S'il y a une récompense à octroyer
				if($this->config['votes_reward'] != 0){
					// On récupère les infos de l'utilisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nouveau nb de tokens
					$new_user_tokens = $user_tokens + $this->config['votes_reward'];
					// On sauvegarde
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					$this->Vote->saveField('reward', $this->config['votes_reward']);
				}
				
				//On récupère le nombre de récompense déjà acquise
				$new_reward_count = $user['User']['reward'] + 1;
				//On enregistre le nouveau nombre de récompense disponible
				$this->User->saveField('reward', $new_reward_count);

				// On redirige vers la page de vote
				$this->Session->setFlash("Merci d'avoir voté !", 'success');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

			// Sinon on a déjà voté
			else{
				$this->Session->setFlash('Vous avez déjà voté, vous devez encore attendre '.$time_to_vote_in_minutes.' minutes', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		}
		else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function vote3() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {

			// On met time dans une variable
			$time = time();

			// On récupère les infos depuis la base de données
			$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
			@$next_vote = $vote['Vote']['next_vote_3'];
			$nb_votes = $this->Vote->find('count', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')]]);

			// Temps avant de revoter en secondes
			$time_to_vote_in_seconds = $this->config['votes_time_3'] * 60;
			$time_to_vote_in_seconds = $time + $time_to_vote_in_seconds;

			// Temps avant de revoter en minutes
			$time_to_vote_in_minutes = $next_vote - $time;
			$time_to_vote_in_minutes = $time_to_vote_in_minutes / 60;
			$time_to_vote_in_minutes = round($time_to_vote_in_minutes);

			// Si on n'a jamais voté ou si le temps nécessaire avant un nouveau vote s'est écoulé
			if($nb_votes == 0 OR $time >= $next_vote){
			
					//On récupère les valeur des autre votes
					$vote_2 = $vote['Vote']['next_vote_2'];
					$vote_1 = $vote['Vote']['next_vote_1'];
					$vote_4 = $vote['Vote']['next_vote_4'];
					$vote_5 = $vote['Vote']['next_vote_5'];
			
					// On enregistre le nouveau vote
					$this->Vote->create;
					$this->Vote->saveField('user_id', $this->Auth->user('id'));
					$this->Vote->saveField('ip', $_SERVER['REMOTE_ADDR']);
					$this->Vote->saveField('next_vote_3', $time_to_vote_in_seconds);
					$this->Vote->saveField('next_vote_2', $vote_2);
					$this->Vote->saveField('next_vote_1', $vote_1);
					$this->Vote->saveField('next_vote_4', $vote_4);
					$this->Vote->saveField('next_vote_5', $vote_5);

				// On l'ajoute dans la table users
				$this->User->id = $this->Auth->user('id');
				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				$user_vote = $user['User']['votes'] + 1;
				$this->User->saveField('votes', $user_vote);

				// S'il y a une récompense à octroyer
				if($this->config['votes_reward'] != 0){
					// On récupère les infos de l'utilisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nouveau nb de tokens
					$new_user_tokens = $user_tokens + $this->config['votes_reward'];
					// On sauvegarde
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					$this->Vote->saveField('reward', $this->config['votes_reward']);
					$this->User->saveField('reward', $new_reward_count);
				}
				
				//On récupère le nombre de récompense déjà acquise
				$new_reward_count = $user['User']['reward'] + 1;
				//On enregistre le nouveau nombre de récompense disponible
				$this->User->saveField('reward', $new_reward_count);

				// On redirige vers la page de vote
				$this->Session->setFlash("Merci d'avoir voté !", 'success');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

			// Sinon on a déjà voté
			else{
				$this->Session->setFlash('Vous avez déjà voté, vous devez encore attendre '.$time_to_vote_in_minutes.' minutes', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		}
		else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function vote4() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {

			// On met time dans une variable
			$time = time();

			// On récupère les infos depuis la base de données
			$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
			@$next_vote = $vote['Vote']['next_vote_4'];
			$nb_votes = $this->Vote->find('count', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')]]);

			// Temps avant de revoter en secondes
			$time_to_vote_in_seconds = $this->config['votes_time_4'] * 60;
			$time_to_vote_in_seconds = $time + $time_to_vote_in_seconds;

			// Temps avant de revoter en minutes
			$time_to_vote_in_minutes = $next_vote - $time;
			$time_to_vote_in_minutes = $time_to_vote_in_minutes / 60;
			$time_to_vote_in_minutes = round($time_to_vote_in_minutes);

			// Si on n'a jamais voté ou si le temps nécessaire avant un nouveau vote s'est écoulé
			if($nb_votes == 0 OR $time >= $next_vote){
			
			//On récupère les valeur des autre votes
			
			$vote_2 = $vote['Vote']['next_vote_2'];
			$vote_3 = $vote['Vote']['next_vote_3'];
			$vote_1 = $vote['Vote']['next_vote_1'];
			$vote_5 = $vote['Vote']['next_vote_5'];
			
					// On enregistre le nouveau vote
					$this->Vote->create;
					$this->Vote->saveField('user_id', $this->Auth->user('id'));
					$this->Vote->saveField('ip', $_SERVER['REMOTE_ADDR']);
					$this->Vote->saveField('next_vote_4', $time_to_vote_in_seconds);
					$this->Vote->saveField('next_vote_2', $vote_2);
					$this->Vote->saveField('next_vote_3', $vote_3);
					$this->Vote->saveField('next_vote_1', $vote_1);
					$this->Vote->saveField('next_vote_5', $vote_5);

				// On l'ajoute dans la table users
				$this->User->id = $this->Auth->user('id');
				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				$user_vote = $user['User']['votes'] + 1;
				$this->User->saveField('votes', $user_vote);

				// S'il y a une récompense à octroyer
				if($this->config['votes_reward'] != 0){
					// On récupère les infos de l'utilisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nouveau nb de tokens
					$new_user_tokens = $user_tokens + $this->config['votes_reward'];
					// On sauvegarde
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					$this->Vote->saveField('reward', $this->config['votes_reward']);
				}
				
				//On récupère le nombre de récompense déjà acquise
				$new_reward_count = $user['User']['reward'] + 1;
				//On enregistre le nouveau nombre de récompense disponible
				$this->User->saveField('reward', $new_reward_count);

				// On redirige vers la page de vote
				$this->Session->setFlash("Merci d'avoir voté !", 'success');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

			// Sinon on a déjà voté
			else{
				$this->Session->setFlash('Vous avez déjà voté, vous devez encore attendre '.$time_to_vote_in_minutes.' minutes', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		}
		else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function vote5() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {

			// On met time dans une variable
			$time = time();

			// On récupère les infos depuis la base de données
			$vote = $this->Vote->find('first', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')], 'order' => ['Vote.created' => 'DESC']]);
			@$next_vote = $vote['Vote']['next_vote_5'];
			$nb_votes = $this->Vote->find('count', ['conditions' => ['Vote.user_id' => $this->Auth->user('id')]]);

			// Temps avant de revoter en secondes
			$time_to_vote_in_seconds = $this->config['votes_time_5'] * 60;
			$time_to_vote_in_seconds = $time + $time_to_vote_in_seconds;

			// Temps avant de revoter en minutes
			$time_to_vote_in_minutes = $next_vote - $time;
			$time_to_vote_in_minutes = $time_to_vote_in_minutes / 60;
			$time_to_vote_in_minutes = round($time_to_vote_in_minutes);

			// Si on n'a jamais voté ou si le temps nécessaire avant un nouveau vote s'est écoulé
			if($nb_votes == 0 OR $time >= $next_vote){
			
			//On récupère les valeur des autre votes
			
			$vote_2 = $vote['Vote']['next_vote_2'];
			$vote_3 = $vote['Vote']['next_vote_3'];
			$vote_4 = $vote['Vote']['next_vote_4'];
			$vote_1 = $vote['Vote']['next_vote_1'];
			
					// On enregistre le nouveau vote
					$this->Vote->create;
					$this->Vote->saveField('user_id', $this->Auth->user('id'));
					$this->Vote->saveField('ip', $_SERVER['REMOTE_ADDR']);
					$this->Vote->saveField('next_vote_5', $time_to_vote_in_seconds);
					$this->Vote->saveField('next_vote_2', $vote_2);
					$this->Vote->saveField('next_vote_3', $vote_3);
					$this->Vote->saveField('next_vote_4', $vote_4);
					$this->Vote->saveField('next_vote_1', $vote_1);

				// On l'ajoute dans la table users
				$this->User->id = $this->Auth->user('id');
				$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
				$user_vote = $user['User']['votes'] + 1;
				$this->User->saveField('votes', $user_vote);

				// S'il y a une récompense à octroyer
				if($this->config['votes_reward'] != 0){
					// On récupère les infos de l'utilisateur
					$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nouveau nb de tokens
					$new_user_tokens = $user_tokens + $this->config['votes_reward'];
					// On sauvegarde
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					$this->Vote->saveField('reward', $this->config['votes_reward']);
				}
				
				//On récupère le nombre de récompense déjà acquise
				$new_reward_count = $user['User']['reward'] + 1;
				//On enregistre le nouveau nombre de récompense disponible
				$this->User->saveField('reward', $new_reward_count);

				// On redirige vers la page de vote
				$this->Session->setFlash("Merci d'avoir voté !", 'success');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

			// Sinon on a déjà voté
			else{
				$this->Session->setFlash('Vous avez déjà voté, vous devez encore attendre '.$time_to_vote_in_minutes.' minutes', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		}
		else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function reward() {
		// Si l'utilisateur est connecté
		if($this->Auth->user()) {
			$this->User->id = $this->Auth->user('id');
			$user = $this->User->find('first', array('conditions' => array('id' => $this->User->id)));
			if($user['User']['reward'] > 0){
				// JSONAPI
				$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
				// On test si le joueur est en ligne
				$online_players = $api->call('players.online.names');
				$player_is_online = in_array($this->Auth->user('username'), $online_players[0]['success']);
				// Si l'utilisateur est connecté en jeu
				if($player_is_online){
					// S'il y a une/des commande(s) à exécuter
					if(!empty($this->config['votes_command'])){
						// On exécute la/les commande(s)
						$command = str_replace('%player%', $this->Auth->user('username'), $this->config['votes_command']);
						if(strstr($this->config['votes_command'], '&&&')){
							$new_command = explode('&&&', $command);
							foreach($new_command as $command){
								$command = trim($command);
								$api->call('server.run_command', [$command]);
							}
						}
						else{
							$api->call('server.run_command', [$command]);
						}
					}

					// On l'ajoute dans la table users
					$user_reward = $user['User']['reward'] - 1;
					$this->User->saveField('reward', $user_reward);

					// On redirige vers la page de vote
					$this->Session->setFlash("Récompense récupéré !", 'success');
					return $this->redirect(['controller' => 'votes', 'action' => 'index']);
					
				// Si non connecté au jeu
				} else {
					$this->Session->setFlash("Connexion au jeu nécessaire !", 'error');
					return $this->redirect(['controller' => 'votes', 'action' => 'index']);
				}

			// Sinon aucune récompense dispo
			} else {
				$this->Session->setFlash('Aucune récompense à récupérer', 'error');
				return $this->redirect(['controller' => 'votes', 'action' => 'index']);
			}

		// Si on n'est pas connecté
		} else {
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}
}