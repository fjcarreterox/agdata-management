<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('main.css'); ?>
</head>
<body>
    <header></header>
	<div class="container">
        <div class="col-md-12 cabecera">
            <a alt="Ir al menú principal" href="http://localhost/agdata-gestion/public/" class="no-decoration">
                <?php echo Asset::img('logo.png',array("class"=>"logo","alt"=>"Ir al menú principal")); ?>
                <h1>AGDATA S.L.</h1>
            </a>
            <h2>Área de gestión interna</h2>
			<!--<h3><?php /*echo $title;*/ ?></h3>-->
			<hr/>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error...</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
<?php echo $content; ?>
		</div>
		<footer>
			<p class="pull-right">Sesión iniciada como USER (ROL).</p>
			<!--<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php /*echo e(Fuel::VERSION);*/ ?></small>
			</p>-->
		</footer>
	</div>
</body>
</html>
