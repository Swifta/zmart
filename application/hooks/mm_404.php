<?php
class mm_404 {
	public function __construct()
	{
		Event::clear('system.404', array('Kohana', 'show_404'));
		Event::add('system.404', array($this, 'show_404'));
	}
	public function show_404()
	{

		header('HTTP/1.1 404 File Not Found');

		Kohana::$instance = new Layout_Controller;
		$template = new View('_error/404');
		$template->title = '404 Page Not Found';
		$template->content = '404 Message and image';
		$template->render(TRUE);
		die();
	}
}
$hook = new mm_404;
unset($hook);
