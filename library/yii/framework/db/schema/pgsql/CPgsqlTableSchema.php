<?php
/**
 * CPgsqlTable class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CPgsqlTable represents the metadata for a PostgreSQL table.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CPgsqlTableSchema.php,v 1.1.1.1 2012-01-04 21:08:27 karthick Exp $
 * @package system.db.schema.pgsql
 * @since 1.0
 */
class CPgsqlTableSchema extends CDbTableSchema
{
	/**
	 * @var string name of the schema that this table belongs to.
	 */
	public $schemaName;
}
