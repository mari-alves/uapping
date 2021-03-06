<main class="container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page-backoffice">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-nucleos">
                <article class="col-12 mt-4 px-4 text text-center">
                    <h2 class="h2-admin-administradores-sub d-inline-block mr-2"> Núcleos </h2>
                </article>
                    <article class="col-12 px-4 mt-3">
                        <a href="backoffice_add_nucleo.php">
                        <div class="art-nucleo-criacao"
                             style='background-image: url("assets/img/cover_criar_nucleo.svg");'>
                            <img class="sinal-mais-criacoes"
                                 src="assets/criacoes_nucleos/sinal_mais_criacoes.svg">
                        </div>
                        </a>
                    </article>
                <article id="nucleos_oficiais" class="col-12 mt-4 px-4">

                    <section class="row mb-3">
                        <?php
                        require_once "connections/connection.php";
                        $padding = false;
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT 
                                    nucleos.id_nucleo,
                                    nucleos.nome_nucleo,
                                    nucleos.sigla_nucleo,
                                    nucleos_oficiais.imagem_oficial,
                                    cores_oficiais.nome_cor_oficial 
                                    FROM nucleos
                                    INNER JOIN nucleos_oficiais
                                    ON nucleos.id_nucleo = nucleos_oficiais.ref_id_nucleo
                                    INNER JOIN cores_oficiais
                                    ON nucleos_oficiais.ref_id_cor_oficial = cores_oficiais.id_cor_oficial;";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id_nucleo, $nome_nucleo, $sigla_nucleo, $imagem_oficial,$cor);
                                while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                    <article class="col-6 art-card-nucleo_geral" style="
                                    <?php if ($padding === false) { ?>
                                            padding-right:8px;
                                        <?php $padding = true;
                                    } else { ?>
                                            padding-left:8px;
                                        <?php $padding = false;
                                    } ?>
                                            ">
                                        <a href="nucleos_detail.php?id_nucleo=<?= $id_nucleo ?>">
                                            <div class="nucleo_card mb-3" style="background-image: url('assets/nucleos/cover_nucleo_<?=$cor?>.svg');">
                                                <div class="row align-items-center sec_nucleo_card_img">
                                                    <div class="col-2 art_nucleo_card min-nucleo-card">
                                                        <img src="assets/nucleos/<?= $imagem_oficial ?>.svg">
                                                    </div>
                                                    <div class="col-6 art_nucleo_card word-warp pl-0 mr-2">
                                                        <p class="p-nucleo_name m-0"> <?= htmlspecialchars($sigla_nucleo) ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
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
        </article>
    </section>
    <?php include_once "components/cp_footer.php"?>
</main>