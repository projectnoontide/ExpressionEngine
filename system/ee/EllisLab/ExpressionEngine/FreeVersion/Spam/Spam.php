<?php
/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2017, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

namespace EllisLab\ExpressionEngine\FreeVersion\Spam;

use EllisLab\ExpressionEngine\Protocol\Spam\Spam as SpamProtocol;

/**
 * Free Version Spam Class
 *
 * Prevents errors in the free version, which doesn't come with the Spam module
 */
class Spam implements SpamProtocol {

	/**
	 * Returns true if the string is classified as spam
	 *
	 * @param string $source Text to classify
	 * @return bool Is Spam?
	 */
	public function isSpam($source)
	{
		return FALSE;
	}

	/**
	 * Store flagged spam to await moderation. We store a serialized array of any
	 * data we might need as well as a class and method name. If an entry that was
	 * caught by the spam filter is manually flagged as ham, the spam module will
	 * call the stored method with the unserialzed data as the argument. You must
	 * provide a method to handle re-inserting this data.
	 *
	 * @param string $class    The class to call when re-inserting a false positive
	 * @param string $method   The method to call when re-inserting a false positive
	 * @param string $content  Array of content data
	 * @param string $doc      The document that was classified as spam
	 * @return void
	 */
	public function moderate($file, $class, $approve_method, $remove_method, $content, $doc)
	{
		// void
	}
}
