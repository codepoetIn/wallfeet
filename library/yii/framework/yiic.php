<?php
/**
 * Yii command line script file.
 *
 * This script is meant to be run on command line to execute
 * one of the pre-defined console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @version $Id: yiic.php,v 1.1.1.1 2012-01-04 21:08:27 karthick Exp $
 */

// fix for fcgi
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once(dirname(__FILE__).'/yii.php');

if(isset($config))
{
	$app=Yii::createConsoleApplication($config);
	$app->commandRunner->addCommands(YII_PATH.'/cli/commands');
	$env=@getenv('YII_CONSOLE_COMMANDS');
	if(!empty($env))
		$app->commandRunner->addCommands($env);
}
else
	$app=Yii::createConsoleApplication(array('basePath'=>dirname(__FILE__).'/cli'));

$app->run();