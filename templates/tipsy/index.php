<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

// Задает шаблон
$this->getTemplate();

//Устанавливает кодировку страницы
$this->setCharset('utf-8');

// Добавляет таблицы стилей.
$this->addStylesheet('template.css');
?>

<!DOCTYPE html>
<html>

<head>
<?php $this->getHead();?>
	<link rel="icon" type="image/png" href="favicon.ico">
	<?php #$this->setStylesheets('template.css');?>
</head>

<body>
<div id = "debug" class = "text-success">
	<?php
		TDebug::getDebugMsg();
	?>
</div>
<header>
	<h1>Домашняя страница проета Tipsy cms</h1>
</header>
<div id="errors">
	<p class="text-error"><?php $this->getErrors();?></p>
</div>

<div id="menu_horisontal">
	<a href="http://php.net">PHP</a>
	<a href="http://w3.org">html5</a>
	<a href="<?php  echo shell_exec('./make_source.sh'); ?> ">Получить последние исходники</a>
	'<a href="https://github.com/WhiskeyMan-Tau/tipsy_cms.git"> Посмотреть на GitHub</a>'
</div>

<div id="container">

	<nav>
		<?php $this->getLeft(); ?>
	</nav>

	<section>
		<article>
			<div id="article_name">
				<h1>Заголовок статьи</h1>
			</div>
			<?php THead::getHead(); ?>
				<?php echo $this->content; ?>
			<div id="article_footer">
				<h2>Footer статьи</h2>
			</div>
		</article>
	</section>

</div>

<footer>
	<p>Tipsy CMS 2012 by <a href="http://vk.com/whiskeyman"><b>WhiskeyMan</a></b></p>
</footer>
</body>

</html>
