<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Telat | <?php echo $this->renderSection("titulo"); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link href="<?php echo base_url('css/fontawesome.min.css'); ?>" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('favicon.ico'); ?>">

    <?php echo $this->renderSection("estilos"); ?>
</head>

<body>
    <?php echo $this->include("partials/header.php"); ?>
    <div class="container">
        <?php echo $this->renderSection("contenido"); ?>
    </div>
    <?php echo $this->include("partials/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php echo $this->renderSection("scripts"); ?>

</body>

</html>