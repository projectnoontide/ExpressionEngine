/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2017, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

$(document).ready(function () {

	$('fieldset :input:hidden').attr('disabled', true);
	$('fieldset:visible input[type=hidden]').attr('disabled', false);

	$('select[name="field_type"]').on('change', function() {
		$('fieldset input:hidden, select:hidden, textarea:hidden').attr('disabled', true);
		$('fieldset:visible input[type=hidden], input:visible, select:visible, textarea:visible').attr('disabled', false);
	});

});
