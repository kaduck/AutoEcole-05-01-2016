<?php
	
	/*
	 * Caravan controller core
	 * This class is above all caravan classes
	 *
	 * @author J�r�mie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	abstract class CaravanController {
		
		/**
		 * State of CaravanController
		 */
		public static $initialized = false;
		
		/**
		 * Twig's instance (template's engine)
		 */
		protected $twig = null;
		
		/**
	     * Check that the controller is available for the current user/visitor
	     */
	    abstract protected function checkAccess();

	    /**
	     * Check that the current user/visitor has valid view permissions
	     */
	    abstract protected function viewAccess();
		
		/**
		 * Initialize the CaravanController class
		 */
		public function init() {
			if (self::$initialized) {
				return;
			}
			self::$initialized = true;
			
			if(file_exists(_TWIG_AUTOLOADER_)) {
				try {
					require_once(_TWIG_AUTOLOADER_);
					Twig_Autoloader::register();
				
					$loader = new Twig_Loader_Filesystem(array(_DEPENDENCIES_DIR_, _CARAVANS_VIEWS_)); 
					$this->twig = new Twig_Environment($loader, array(
					  'cache' => _TWIG_CACHE_
					));
				} catch (Exception $e) {
					throw new Exception('Le fichier de d�marrage Twig ne peut pas s\'executer!');
				}
			} else {
				throw new Exception('Il n\'existe pas le fichier de d�marrage Twig � cet emplacement "'._TWIG_AUTOLOADER_ .'"!');
			}
		}
	}