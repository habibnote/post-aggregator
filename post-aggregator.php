<?php 
/*
 * Plugin Name:       Post Aggregator
 * Plugin URI:        
 * Description:       
 * Version:           0.0.1
 * Requires PHP:      7.2
 * Author:            Md. Habib
 * Author URI:        https://me.habibnote.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       post-aggregator
 * Domain Path:       /languages
 */

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
* Plugin Main Class
*/
class PostAggregator {
    static $instance = false;

    /**
     * Class Constructor
     */
    private function __construct() {
        $this->include();
        $this->define();
        $this->hooks();
    }

     /**
     * Include all needed files
     */
    private function include() {
        require_once( dirname( __FILE__ ) . '/includes/functions.php' );
        require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
    }

    /**
     * define all constant
     */
    private function define() {
        define( "DEVS_MODE", true ); // 'true' | is development mode on

        define( 'POST_AGGREGATOR_FILE', __FILE__ );
        define( 'POST_AGGREGATOR_VERSION', '1.0' );
        define( 'POST_AGGREGATOR_PLUGIN_DIR', plugin_dir_path( POST_AGGREGATOR_FILE ) );
        define( 'POST_AGGREGATOR_PLUGIN_URL', plugin_dir_url( POST_AGGREGATOR_FILE ) );
        define( 'POST_AGGREGATOR_ASSET', plugins_url( 'assets', POST_AGGREGATOR_FILE ) );

        if( DEVS_MODE ) {
           define( 'ASSETS_VERSION', time() );
        }
        else {
            define( 'ASSETS_VERSION', POST_AGGREGATOR_VERSION );
        }
    }

    /**
     * All hooks
     */
    private function hooks() {
        /**
         * Register the activation hook.
         * This hook is triggered when the plugin is activated.
         * It installs necessary database tables, sets initial seeds, 
         * and checks database versions.
         */
        new PostAggregator\Classes\Install();

        /**
         * Register hooks for Admin end.
         * This hook is triggered only admin end.
         */
        if( is_admin() ) {
            new PostAggregator\Classes\Admin();
        }
        /**
         * Register hooks for Front end.
         * This hook is triggered only front end.
         */
        if( ! is_admin() ) {
            new PostAggregator\Classes\Front();
        }
        /**
         * Register hooks for Common.
         * This hook is triggered both admin & front also.
         */
        new PostAggregator\Classes\Common();
    }

    /**
     * Singleton Instance
    */
    static function init() {
        
        if( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Cick off the plugins 
 */
PostAggregator::init();

