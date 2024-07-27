<?php
/**
 * Model.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Models;

use EDD_Multi_Currency\Traits\HasAttribute;
use EDD_Multi_Currency\Traits\Serializer;

abstract class Model {

	use HasAttribute, Serializer;

}
