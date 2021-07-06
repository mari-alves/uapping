<main class="main container-fluid main-flex">
    <section class="row">
        <article class="col-12">
            <section class="row sec-top-nucleos">
                <article class="col-12 section-search-home-page">
                    <section class="row justify-content-center">
                        <article class="col-12 px-4">
                        </article>
                    </section>
                </article>
            </section>
            <section class="row section-nucleos background_cinza pb-5">
                <article class="col-12 mt-4 mb-3 position-relative">
                    <h2 class="text-center h2-nucleo_save"> Guardados </h2>
                </article>
                <article class="col-12 px-4 mb-3">
                    <switch class="checkbox-top-home-page position-relative">
                        <border class="checkbox-top-home-page_overlay"></border>
                        <selector id="selector" class="selector">
                        </selector>
                        <section style="height:100%;" class="row sec-selector-home-page text-center align-content-center">
                            <article id="ativos" class="switch-interesses col-6">
                                <p> Ativos </p>
                            </article>
                            <article id="passados" class="switch-todos col-6" style="color:#1D1D1D;">
                                <p> Passados </p>
                            </article>
                        </section>
                    </switch>
                </article>
                <article class="col-12 text-center mb-3 px-5 p-text">
                    <p id="text_saved_ativos"> Aqui podes ver todos os eventos que não queres mesmo deixar passar... </p>
                    <p id="text_saved_passados" style="display:none;"> Aqui podes ver todos os eventos  que queres mais tarde recordar... </p>
                </article>

                <article class="col-12 mt-4">
                    <section class="row px-4">

                        <article class="col-12 event-card mb-5">
                            <a href="#">
                                <section class="row">
                                    <article class="col-12">
                                        <section class="row event-header mb-3">
                                            <titulo class="col-12 mt-3 mb-1">
                                                <h4 class="h4-eventos"> Smells like drunk spirit </h4>
                                            </titulo>
                                            <article class="col-6">
                                                <section class="row">
                                                    <data class="col-12 mb-2">
                                                        <img class="mr-1" src="assets/img/calendar_black.svg">
                                                        <p class="d-inline"> Hoje </p>
                                                    </data>
                                                    <horas class="col-12">
                                                        <img class="mr-1" src="assets/img/clock.svg">
                                                        <p class="d-inline"> 21:45 </p>
                                                    </horas>
                                                </section>
                                            </article>
                                            <nucleo class="col-6 text-right">
                                                <img src="assets/img/NRock_1.svg">
                                            </nucleo>
                                        </section>
                                        <section class="row event-cover" style='background-image: url("assets/img/smells_rock_1.jpg");'>
                                        </section>
                                    </article>
                                </section>
                            </a>
                            <div class="card-footer text-right py-1 px-4">
                                <i class="save_share text-white mr-3 fas fa-share-alt"></i>
                                <i class="save_share text-white far fa-bookmark"></i>
                            </div>
                        </article>

                    </section>
                </article>

            </section>
        </article>
    </section>
    <footer class="row justify-content-center py-5 mt-0">
        <article class="col-3 text-center">
            <a href="https://www.facebook.com/" target="_blank"> <span class="fab fa-facebook-f text-white fa-3x"></span> </a>
        </article>
        <article class="col-3 text-center mw-6rem">
            <a href="https://twitter.com/" target="_blank"> <span class="fab fa-twitter text-white fa-3x"></span> </a>
        </article>
        <article class="col-3 text-center">
            <a href="https://www.instagram.com/" target="_blank"> <span class="fab fa-instagram text-white fa-3x"></span> </a>
        </article>
    </footer>
</main>

<Panel id="panel_interesses_menu_mobile" class="">
    <interesses id="interesses_menu" class="container-fluid interesses_menu">
        <section class="row mx-4">
            <article class="col-12 my-4">
                <h5 class="h5-interesses"> Interesses </h5>
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
    </interesses>
    <background id="background_interesses_menu" class="black-ground"></background>
</Panel>