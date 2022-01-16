<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * HELPER COMMENT START
 *
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features.
 *
 * To add a new class, here's what you need to do:
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Teamgate_Importer_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 *
 * HELPER COMMENT END
 */

if (! class_exists('Teamgate_Importer')) :

    /**
     * Main Teamgate_Importer Class.
     *
     * @package     TEAMGATEIM
     * @subpackage  Classes/Teamgate_Importer
     * @since       1.0.0
     * @author      Codesomelabs
     */
    final class Teamgate_Importer
    {

        /**
         * The real instance
         *
         * @access  private
         * @since   1.0.0
         * @var     object|Teamgate_Importer
         */
        private static $instance;

        /**
         * TEAMGATEIM helpers object.
         *
         * @access  public
         * @since   1.0.0
         * @var     object|Teamgate_Importer_Helpers
         */
        public $helpers;

        /**
         * TEAMGATEIM settings object.
         *
         * @access  public
         * @since   1.0.0
         * @var     object|Teamgate_Importer_Settings
         */
        public $settings;

        /**
         * Throw error on object clone.
         *
         * Cloning instances of the class is forbidden.
         *
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, __('You are not allowed to clone this class.', 'teamgate-importer'), '1.0.0');
        }

        /**
         * Disable unserializing of the class.
         *
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, __('You are not allowed to unserialize this class.', 'teamgate-importer'), '1.0.0');
        }

        /**
         * Main Teamgate_Importer Instance.
         *
         * Insures that only one instance of Teamgate_Importer exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @access      public
         * @since       1.0.0
         * @static
         * @return      object|Teamgate_Importer    The one true Teamgate_Importer
         */
        public static function instance()
        {
            if (! isset(self::$instance) && ! ( self::$instance instanceof Teamgate_Importer )) {
                self::$instance                 = new Teamgate_Importer;
                self::$instance->base_hooks();
                self::$instance->includes();
                self::$instance->helpers        = new Teamgate_Importer_Helpers();
                self::$instance->settings       = new Teamgate_Importer_Settings();

                //Fire the plugin logic
                new Teamgate_Importer_Run();

                /**
                 * Fire a custom action to allow dependencies
                 * after the successful plugin setup
                 */
                do_action('TEAMGATEIM/plugin_loaded');
            }

            return self::$instance;
        }

        /**
         * Include required files.
         *
         * @access  private
         * @since   1.0.0
         * @return  void
         */
        private function includes()
        {
            require_once TEAMGATEIM_PLUGIN_DIR . 'core/includes/classes/class-teamgate-importer-helpers.php';
            require_once TEAMGATEIM_PLUGIN_DIR . 'core/includes/classes/class-teamgate-importer-settings.php';
            require_once TEAMGATEIM_PLUGIN_DIR . 'core/includes/cpt.php';
            require_once TEAMGATEIM_PLUGIN_DIR . 'core/includes/custom-fields.php';

            require_once TEAMGATEIM_PLUGIN_DIR . 'core/includes/classes/class-teamgate-importer-run.php';
        }

        /**
         * Add base hooks for the core functionality
         *
         * @access  private
         * @since   1.0.0
         * @return  void
         */
        private function base_hooks()
        {
            add_action('plugins_loaded', array( self::$instance, 'load_textdomain' ));
        }

        /**
         * Loads the plugin language files.
         *
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function load_textdomain()
        {
            load_plugin_textdomain('teamgate-importer', false, dirname(plugin_basename(TEAMGATEIM_PLUGIN_FILE)) . '/languages/');
        }
    }

endif; // End if class_exists check.
