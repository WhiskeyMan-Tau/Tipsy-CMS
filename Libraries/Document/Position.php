<?php
namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Document\Content;
use Tipsy\Libraries\Database\Database;
use Tipsy\Libraries\Database\Query;
use Tipsy\Config\Config;
use Tipsy\Libraries\Loader;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Class Position - Класс отвечающий за позиции (блоки для разного типа контента) в шаблоне html.
 * @package Tipsy\Libraries\Document
 */
abstract class Position extends Document
{
	/**
	 * @var	array	Позиции текущего шаблона.
	 */
	protected static $positions = array();

	protected static $ns_com ='';

	/**
	 * Метод определяющий компонент, привязанный к позиции (тип выводимого контента).
	 */
	public static function get($positionName)
	{
		$positionName = strtolower($positionName);
		// Если позиция не зарегистрирована (например новая) в списке, тогда:
		if(!in_array($positionName, self::$positions)){
			// Заполняет массив-список позиций шаблона.
			self::$positions[] = $positionName;
			// Проверяет наличие данных о позиции в базе данных...
			if(!Query::select("SELECT name FROM positions WHERE name = \"$positionName\";")){
				// В случае отсутствия информации - регистрирует позицию в БД.
				Query::insert("INSERT INTO positions (name) VALUES (\"$positionName\");");
			}
		}
		// Получает контент позиции.
		self::getPosContent($positionName);
	}

	/**
	 * Метод получающий данные для компонента привязанного к позиции.
	 */
	protected static function getPosContent($position)
	{
		// Определяет тип контента текущей позиции, заданный пользователем.
		$posContentType = Query::select("SELECT * FROM positions WHERE name = \"$position\";");

		// Формирует название компонента, который привязан к позиции шаблона.
		$com =  ucfirst($posContentType['name']);
		// Формирует имя пространста имен компонента.
		$com_ns = "\\Tipsy\\Components\\$com\\$com";

		// Выодит название позиции на страницу, если разрешена отладка шаблона в настройках.
		if($posContentType and  Config::$tmplDebug) {
			echo '<fieldset><legend>'.$posContentType['name'].'</legend></fieldset>';
		}

		// Выполняет инициализацию компонента, если существует его класс.
		if(class_exists($com_ns)){

			// Подключает шаблон текущей позиции в шаблон страницы, указанный в родительском классе Document.
			$pos_tmpl = file_get_contents(parent::$template .DIRECTORY_SEPARATOR. 'Positions' .DIRECTORY_SEPARATOR. $com . '.tpl');

			$content = str_replace('{content}',  $com_ns::init(), $pos_tmpl);

			while (stripos($content,'{php}')){
				$start_php = stripos($content,'{php}');
				$end_php = stripos($content,'{/php}');
				$lenght = $end_php-$start_php+6;
				$php_code = eval(substr($content,$start_php+5,$lenght-11));

				$content = substr_replace($content,$php_code,$start_php,$lenght);

			}
			echo $content;
			#echo $code = substr_replace($content,$php_code,$start_php,$lenght);


		}

	}
}