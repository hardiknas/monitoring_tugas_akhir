<?php
switch ($_GET['p']) {
	default:
		include 'utama.php';
		break;
	case 'home':
		include 'utama.php';
		break;
	case 'about':
		include 'about.php';
		break;
	case 'info':
		include 'info.php';
		break;
}
?>