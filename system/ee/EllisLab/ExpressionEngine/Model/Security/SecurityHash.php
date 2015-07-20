<?php

namespace EllisLab\ExpressionEngine\Model\Security;

use EllisLab\ExpressionEngine\Service\Model\Model;

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		https://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine Throttle Model
 *
 * @package		ExpressionEngine
 * @subpackage	Security
 * @category	Model
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class SecurityHash extends Model {

	protected static $_primary_key = 'hash_id';
	protected static $_table_name = 'security_hashes';

	protected static $_relationships = array(
		'Session' => array(
			'type' => 'belongsTo'
		)
	);

	protected $hash_id;
	protected $date;
	protected $session_id;
	protected $hash;
	protected $used;
}
