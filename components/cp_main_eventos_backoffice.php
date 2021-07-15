<?php
require_once "connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT nucleos_membros.ref_id_nucleo,nucleos_membros.admin_membro FROM nucleos_membros
        INNER JOIN nucleos_oficiais
        ON nucleos_membros.ref_id_nucleo=nucleos_oficiais.ref_id_nucleo
        INNER JOIN nucleos
        ON nucleos_oficiais.ref_id_nucleo=nucleos.id_nucleo
        WHERE ref_id_utilizador=? AND nucleos_membros.admin_membro=1";
if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
    mysqli_stmt_execute($stmt); // Execute the prepared statement
    mysqli_stmt_bind_result($stmt, $id_nucleo, $admin_membro);
    mysqli_stmt_fetch($stmt);

}
mysqli_stmt_store_result($stmt);
$rows = mysqli_stmt_num_rows($stmt);

mysqli_stmt_close($stmt);
mysqli_close($link);
if (isset($admin_membro) && $admin_membro==1) {
?>
    <main class="background_cinza container-fluid main-flex">
        <section class="row">
            <article class="col-12">
                <section class="row section-search-home-page-backoffice">
                    <article class="col-12">
                        <section class="row justify-content-center mb-3">
                            <article class="col-12 px-4">
                                <h2 class="h2-admin-administradores"> Gestão <span> UAPPING </span></h2>
                            </article>
                        </section>
                        <section class="row justify-content-center">
                            <article class="col-12 px-4 position-relative">
                                <i class="fas fa-search icon-search-top"></i>
                                <input class="input_search-home-page-admin" type="text" id="search-bar"
                                       name="search_bar">
                            </article>
                        </section>
                        <section class="row justify-content-center mt-4">
                            <article class="col-12 art-date_slide">
                                <Dateslide id="slide_date" class="px-4 date-slide">
                                    <hoje class="date-slide-elements slide-hoje"> Hoje</hoje>
                                    <amanha class="date-slide-elements slide-amanha ml-2"> Amanhã</amanha>
                                    <!--- para apresentar os dias dentro dos pill utilizando tempo real de forma dinâmica--->
                                    <?php
                                    for ($n = 0; $n <= 5; $n++) {
                                        $data_pill = date("Y-m-d", strtotime("+" . $n . "days"));
                                        if ($n >= 2) {
                                            echo '<dia class="date-slide-elements slide-dias ml-2" id="pill_' . $n . '">' . date('j', strtotime($data_pill)) . '</dia>';
                                        }
                                    }
                                    ?>
                                    <calendar class="date-slide-elements_admin slide-dias ml-2"><img
                                                src="assets/img/calendar.svg"></calendar>
                                </Dateslide>
                            </article>
                        </section>
                    </article>
                </section>
                <section class="row">
                    <article class="col-12 mt-5 mb-3 px-4">
                        <h2 class="pl-2 h2-eventos"> Eventos </h2>
                    </article>
                    <?php
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT eventos.id_evento,eventos.nome_evento, eventos.data_evento,eventos.hora_evento,eventos.imagem_evento,eventos.ref_id_nucleo 
                        FROM eventos
                        INNER JOIN nucleos_oficiais
                        ON eventos.ref_id_nucleo=nucleos_oficiais.ref_id_nucleo  
                        WHERE eventos.ref_id_nucleo=?
                        ORDER BY eventos.data_evento ASC";
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $id_nucleo);
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $data_evento, $hora_evento, $imagem_evento, $id_nucleo);
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <article class="col-12">
                                    <section class="row px-4">
                                        <article class="col-12 event-card mb-5">
                                            <a href="evento_detail.php?id_evento=<?= $id_evento ?>">
                                                <section class="row">
                                                    <article class="col-12">
                                                        <section class="row event-header mb-3 align-items-center">
                                                            <titulo class="col-12 mt-3 mb-1">
                                                                <h4 class="h4-eventos"> <?= $nome_evento ?> </h4>
                                                            </titulo>
                                                            <article class="col-6">
                                                                <section class="row">
                                                                    <data class="col-12 mb-2">
                                                                        <img class="mr-1"
                                                                             src="assets/img/calendar_black.svg">
                                                                        <p class="d-inline"> <?php
                                                                            if (date('Y-m-d') == $data_evento) {
                                                                                echo "Hoje";
                                                                            } else if (date("Y-m-d", strtotime("+" . 1 . "days")) == $data_evento) {
                                                                                echo "Amanhã";
                                                                            } else {
                                                                                echo date('j/m', strtotime($data_evento));
                                                                            }
                                                                            ?> </p>
                                                                    </data>
                                                                    <horas class="col-12">
                                                                        <img class="mr-1" src="assets/img/clock.svg">
                                                                        <p class="d-inline"> <?= date('G:i', strtotime($hora_evento)) ?> </p>
                                                                    </horas>
                                                                </section>
                                                            </article>
                                                            <nucleo class="col-6 text-right" style="height:3.5rem;">
                                                                <!-- falta aqui fazer ligação também -->
                                                                <img src="assets/img/NRock_1.svg">
                                                            </nucleo>
                                                        </section>
                                                        <section class="row event-cover"
                                                                 style='background-image: url("assets/img/<?= $imagem_evento ?> ");'>
                                                        </section>
                                                    </article>
                                                </section>
                                            </a>
                                            <div class="card-footer text-right py-1 px-4">
                                                <img class="save_share" src="assets/img/ban_cinza.svg">
                                                <!-- <img class="ml-3 save_share" src="assets/img/ban_vermelho.svg"> -->
                                            </div>
                                        </article>

                                    </section>
                                </article>
                                <?php
                            }
                        } else {
                            echo "Error:" . mysqli_stmt_error($stmt);
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo("Error description: " . mysqli_error($link));
                    }
                    mysqli_close($link);
                    ?>
                </section>
            </article>
        </section>
        <footer class="row justify-content-center py-5">
            <article class="col-3 text-center">
                <a href="https://www.facebook.com/" target="_blank"> <span
                            class="fab fa-facebook-f text-white fa-3x"></span> </a>
            </article>
            <article class="col-3 text-center mw-6rem">
                <a href="https://twitter.com/" target="_blank"> <span class="fab fa-twitter text-white fa-3x"></span>
                </a>
            </article>
            <article class="col-3 text-center">
                <a href="https://www.instagram.com/" target="_blank"> <span
                            class="fab fa-instagram text-white fa-3x"></span> </a>
            </article>
        </footer>
    </main>

    <Panel id="panel_interesses_menu_mobile" class="">
        <interesses id="interesses_menu" class="container-fluid interesses_menu">
            <form action="" method="post" id="interesses_pills">
                <section class="row mx-4">
                    <article class="col-12 mt-4 mb-2">
                        <h5 class="h5-interesses"> Interesses </h5>
                    </article>
                    <article class="col-12">
                        <section class="row justify-content-start">
                            <article id="checkpills_1" class="col-4 check-interesse-pills">
                                <div class="check-interesse-pills-text"><p id="checkpills-text-1"> Cultura </p></div>
                                <input id="checkpills-input-1" name="" value="" type="checkbox">
                            </article>
                            <article id="checkpills_2" class="col-4 check-interesse-pills">
                                <div class="check-interesse-pills-text"><p id="checkpills-text-2"> Música </p></div>
                                <input id="checkpills-input-2" name="" value="" type="checkbox">
                            </article>
                            <article id="checkpills_3" class="col-4 check-interesse-pills">
                                <div class="check-interesse-pills-text"><p id="checkpills-text-3"> Dança </p></div>
                                <input id="checkpills-input-3" name="" value="" type="checkbox">
                            </article>
                            <article id="checkpills_4" class="col-4 check-interesse-pills">
                                <div class="check-interesse-pills-text"><p id="checkpills-text-4"> Desporto </p></div>
                                <input id="checkpills-input-4" name="" value="" type="checkbox">
                            </article>
                            <article id="checkpills_5" class="col-4 check-interesse-pills">
                                <div class="check-interesse-pills-text"><p id="checkpills-text-5"> Jogos </p></div>
                                <input id="checkpills-input-5" name="" value="" type="checkbox">
                            </article>
                        </section>
                    </article>
                </section>
                <section class="row mx-4">
                    <article class="col-12 my-4">
                        <h5 class="h5-interesses"> Núcleos </h5>
                    </article>
                    <article class="col-12 my-4">
                        <p class=""> Cultura </p>
                    </article>
                    <article class="col-12">
                        <section class="row">
                            <article class="col-12">
                                <span class=""> Cultura </span>
                                <span> Música </span>
                                <span> Dança </span>
                                <span> Desporto </span>
                                <span> Jogos </span>
                            </article>
                        </section>
                    </article>
                </section>
            </form>
        </interesses>
        <background id="background_interesses_menu" class="black-ground"></background>
    </Panel>
<?php } else {
     echo "<script>window.location.href='home_page.php'</script>"; // sera q isto é problematico?
} ?>