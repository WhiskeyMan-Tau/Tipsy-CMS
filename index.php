<?php
namespace Tipsy;

// Устанавливает что это главный файл.
use Tipsy\Config\Config;

/**
 * @package		Tipsy CMS
 * @version		0.0.1
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Tkachenko Aleksey, e-mail: whiskeyman.tau@gmail.com
 */
define('_TEXEC', 1);

// Подключаем настройки php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'php_set.php';

// Подключает каркас системы
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Framework.php';