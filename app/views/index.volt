<!doctype html>
<html>
<head>
	<title>My Phalcon</title>
	<?php $this->assets->outputCss()?>
	<?php $this->assets->outputJs()?>
</head>
<body>

<?=$this->getContent();?>

</body>
</html>