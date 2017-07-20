<?php
/**
 * Extaz-CMS - UpdateController.php
 */

class UpdateController extends AppController {
    public function admin_index() {
        if ($this->Auth->user('role') > 1) {
            $this->set('datas', $this->Update->find('all', ['order' => ['Update.id' => 'DESC']]));

            if($this->request->is('post')) {
                $updater = $this->Auth->user('username');
                $ip = $_SERVER['REMOTE_ADDR'];

                if (version_compare($this->version, $this->last_version) < 0) {
                    $new_file = 'ExtazCMS.zip';

                    $file = "https://extaz-cms.fr/updates/updates/ExtazCMS_".$this->next_version."/file.zip";
                    $sql  = file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_".$this->next_version."/sql.txt");

		    if (!empty($sql)) {
			$db = ConnectionManager::getDataSource('default');
			$db->rawQuery($sql);
		    }

                    if (!copy($file, $new_file)) {
                        $this->Session->setFlash('Un problème est survenu !', 'toastr_error');
                    } else {
                        $zip = new ZipArchive;
                        $res = $zip->open($new_file);

                        if ($res === TRUE) {
                            if (!$zip->extractTo(ROOT)) {
				$zip->close();
				$this->Session->setFlash('Une erreur est survenue lors de la décompression du fichier de la nouvelle version !', 'toastr_error');
				return ;
			    }
                            $zip->close();
                            unlink($new_file);

                            $this->Update->create();
                            $this->Update->saveField('updater', $updater);
                            $this->Update->saveField('ip', $ip);
                            $this->Update->saveField('name', file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/name.txt"));
                            $this->Update->saveField('version', $this->next_version);
                            $this->Update->saveField('type', file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/type.txt"));
                            $this->Update->clear();


                            // On déclare la dossier cible qui doit être vidé
			    $dossier = ROOT . '/app/Plugin/TwigView/tmp/views';
			    $it = new RecursiveDirectoryIterator($dossier, FilesystemIterator::SKIP_DOTS);
			    $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
			    foreach($it as $file) {
				if ($file->isDir())
				    rmdir($file->getPathname());
				else
				    unlink($file->getPathname());
			    }

                            $this->Session->setFlash('Mise à jour effectué avec succès !', 'toastr_success');
                        } else {
                            $this->Session->setFlash('Un problème est survenu !', 'toastr_error');
                        }
                    }
                } else {
		    $this->Session->setFlash('Il n\'y a pas de mise à jour à faire !', 'toastr_error');
      	        }
            }
        } else {
            throw new NotFoundException();
        }
    }
}
