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

                if ($this->version != $this->last_version) {
                    $new_file = 'ExtazCMS.zip';

                    $file = "https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/file.zip";
                    $sql  = file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/sql.txt");

                    $db = ConnectionManager::getDataSource('default');
                    $db->rawQuery($sql);

                    if (!copy($file, $new_file)) {
                        $this->Session->setFlash('Un problème est survenu !', 'toastr_error');
                    } else {
                        $zip = new ZipArchive;
                        $res = $zip->open($new_file);

                        if ($res === TRUE) {
                            $zip->extractTo(ROOT);
                            $zip->close();
                            unlink($new_file);

                            $this->Update->create;
                            $this->Update->saveField('updater', $updater);
                            $this->Update->saveField('ip', $ip);
                            $this->Update->saveField('name', file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/name.txt"));
                            $this->Update->saveField('version', $this->next_version);
                            $this->Update->saveField('type', file_get_contents("https://extaz-cms.fr/updates/updates/ExtazCMS_$this->next_version/type.txt"));
                            $this->Update->clear();

							// On déclare la dossier cible qui doit être vidé
							$dossier = ROOT . '/app/Plugin/TwigView/tmp/views';
							$dir_iterator = new RecursiveDirectoryIterator($dossier);
							$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
							// On supprime chaque dossier et chaque fichier	du dossier cible
							foreach($iterator as $fichier){
								$fichier->isDir() ? rmdir($fichier) : unlink($fichier);
							}

                            $this->Session->setFlash('Mise à jour effectué avec succès !', 'toastr_success');
                        } else {
                            $this->Session->setFlash('Un problème est survenu !', 'toastr_error');
                        }
                    }
                }
            }
        } else {
            throw new NotFoundException();
        }
    }
}