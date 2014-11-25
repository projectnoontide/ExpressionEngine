<?php
namespace EllisLab\ExpressionEngine\Module\Channel\Model;

use EllisLab\ExpressionEngine\Service\Model\Model;

class ChannelFieldGroup extends Model {

	protected static $_primary_key 	= 'group_id';
	protected static $_gateway_names 	= array('ChannelFieldGroupGateway');

	protected static $_relationships = array(
		'ChannelFieldStructures' => array(
			'type' => 'one_to_many',
			'model' => 'ChannelFieldStructure'
		)
	);

	protected $group_id;
	protected $site_id;
	protected $group_name;

}
