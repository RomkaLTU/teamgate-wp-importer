<?php
/**
 * Teamgate importer
 *
 * @package       TEAMGATEIM
 * @author        Codesomelabs
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Teamgate importer
 * Plugin URI:    https://codesomelabs.com
 * Description:   Import Teamgate data to custom post type.
 * Version:       1.0.0
 * Author:        Codesomelabs
 * Author URI:    https://codesomelabs.com
 * Text Domain:   teamgate-importer
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Teamgate importer. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * HELPER COMMENT START
 *
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 *
 * The comment above contains all information about the plugin
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 *
 * The function TEAMGATEIM() is the main function that you will be able to
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 *
 * HELPER COMMENT END
 */

// Plugin name
const TEAMGATEIM_NAME = 'Teamgate importer';

// Plugin version
const TEAMGATEIM_VERSION = '1.0.0';

// Plugin Root File
const TEAMGATEIM_PLUGIN_FILE = __FILE__;

// Plugin base
define('TEAMGATEIM_PLUGIN_BASE', plugin_basename(TEAMGATEIM_PLUGIN_FILE));

// Plugin Folder Path
define('TEAMGATEIM_PLUGIN_DIR', plugin_dir_path(TEAMGATEIM_PLUGIN_FILE));

// Plugin Folder URL
define('TEAMGATEIM_PLUGIN_URL', plugin_dir_url(TEAMGATEIM_PLUGIN_FILE));

/**
 * Load composer dependencies
 */
require_once TEAMGATEIM_PLUGIN_DIR . 'vendor/autoload.php';

/**
 * Load the main class for the core functionality
 */
require_once TEAMGATEIM_PLUGIN_DIR . 'core/class-teamgate-importer.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Codesomelabs
 * @since   1.0.0
 * @return  object|Teamgate_Importer
 */
function TEAMGATEIM()
{
    return Teamgate_Importer::instance();
}

TEAMGATEIM();
