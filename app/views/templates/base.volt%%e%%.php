a:5:{i:0;s:256:"<!doctype html>
<html lang="en">
<head>
	<?= $this->tag->getTitle() ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?= $this->assets->outputCss('style') ?>
	<?= $this->assets->outputJs('js') ?>
	";s:4:"head";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:3:"
	";s:4:"file";s:32:"../app/views/templates/base.volt";s:4:"line";i:10;}}i:1;s:1710:"
</head>
<body>

<div class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
           	<span class="icon-bar"></span>
            <span class="icon-bar"></span>
           	<span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Fireball</a>
		</div>
		<div class=navbar-collapse collapse>
			 <ul class="nav navbar-nav">
              	<li class="active"><a href="#">Home</a></li>
              	<li><a href="#">About</a></li>
           	    <li><a href="#">Contact</a></li>
             	<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 	<li><a href="#">Action</a></li>
                  	<li><a href="#">Another action</a></li>
                  	<li><a href="#">Something else here</a></li>
                  	<li role="separator" class="divider"></li>
                  	<li class="dropdown-header">Nav header</li>
                  	<li><a href="#">Separated link</a></li>
                 	<li><a href="#">One more separated link</a></li>
                </ul>
              </li>
           	</ul>
           	<ul class="nav navbar-nav navbar-right">
           		<li><a href=#>Signin</a></li>
           	</ul>
		  </div>
		
	</div>
</div>

<?= $this->flash->output() ?>

";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:4:"

";s:4:"file";s:32:"../app/views/templates/base.volt";s:4:"line";i:55;}}i:2;s:20:"

</body>
</html>";}