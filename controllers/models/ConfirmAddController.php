<?php
	
	/*
	 * Controller for confirm new location
	 * This class handles news locations
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LocationController.php');
	 
	class ConfirmAddController extends LocationController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Create';
		
		/**
		 * The constructor of ConfirmAddController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ConfirmAddController class and their parents
		 */
		public function init() {
			try {
				parent::init();	
			} catch (Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			
			if (file_exists (_CONTROLLERS_DIR_ .'/Tools.php')) {
				$url = Tools::getInstance()->request_url;
				$url .= '&id=ukn';
				$controller = Tools::getInstance()->getUrl_controller($url);
				
				if ($controller == 'ConfirmAddController') {
					if (file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php');
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['sector']) && !empty($_POST['location'])) {
								\Location\CreateModel::getInstance()->add_location($_POST['sector'], $_POST['location']);
								header('Location: /Cas-M-Ping/locations/show/all');
								
							} else {
								header('Location: /Cas-M-Ping/locations/add');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant l\'ajout des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._LOCATIONS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
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
