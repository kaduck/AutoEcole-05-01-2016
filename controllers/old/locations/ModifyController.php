<?php
	
	/*
	 * Controller for location modifications
	 * This class handles modifications locations
	 *
	 * @author J�r�mie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LocationController.php');
	 
	class ModifyController extends LocationController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'modify';
		
		/**
		 * The constructor of ModifyController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ModifyController class and their parents
		 */
		public function init() {
			try {
				parent::init();	
			} catch (Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			
			if (file_exists (_CONTROLLERS_DIR_ .'/Tools.php')) {
				$url = Tools::getInstance()->request_url;
				$controller = Tools::getInstance()->getUrl_controller($url);
				
				if ($controller == 'ModifyController') {
					if (file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php') && file_exists (_SECTORS_MODELS_ .'/'. $this->model_name .'Model.php')) {
						if (file_exists (_LOCATIONS_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
								require_once (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_SECTORS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);
								
								$sectors = \Sector\DisplayModel::getInstance()->display_sectors();
								$type_locations = \Location\DisplayModel::getInstance()->display_TypeLocationModels();
								$data = \Location\DisplayModel::getInstance()->display_location($id);
								echo $this->twig->render($this->view_name .'.tpl', array('sectors' => $sectors, 'typeLocations' => $type_locations, 'id' => $data[0], 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant l\'affichage des donn�es: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._LOCATIONS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le mod�le "'. $this->model_name .'" n\'existe pas dans "'._LOCATIONS_MODELS_ .'" ou "'._SECTORS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas �valuable!');
			}
		}
		
		/**
	     * @see LocationController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see LocationController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}