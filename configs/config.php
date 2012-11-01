<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

// Параметры конфигурации системы
abstract class TConfig
{
	// Параметры подключения к базе данных
	// Todo: Правильная база whiskeyman_tipsy, параметры базы данных изменены на неверные для проверки модулей логирования и исключения
	public static $db_type = 'mysqli';
	
	public static $db_host = 'localhost';
	public static $db_user = 'whiskeyman_tipsy';
	public static $db_password = 'password';
	public static $db_dbname = 'whiskeyman_tipsy';
	public static $db_port = 3306;
	public static $db_socket = '';

	// Ошибки и отладка (none, simple, maximum)
	public static $error_reporting = 'maximum';
	// Отладка системы (1 - да, 0 - нет)
	public static $debug = 1;
	
	// Настройки времени
	public static $timezone = 'Europe/Moscow';

	// Внешний вид
	public static $template = 'tipsy';
	
	// Куки
	public static $Session_lifetime = 15;
}

?>
