<!DOCTYPE html>
<html lang="pt">
<head>

    <?php include_once "helpers/help_css.php"?>

    <?php include_once "helpers/help_meta.php"?>

</head>
<body>

<script> admin_user = true; </script>

<?php $nav_administradores = true; ?>

<?php $pag_admin = true; ?>

<?php include_once "components/cp_header.php" ?>

<?php include_once "scripts/sc_check_admin.php" ?>

<?php include_once "components/cp_admin_administradores.php" ?>

<?php include_once "components/cp_navegacao_mobile_admin.php" ?>

<?php include_once "helpers/help_js.php"?>

</body>
</html>