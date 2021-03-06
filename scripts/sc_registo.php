<?php
require_once "../connections/connection.php";

if (isset($_POST['nome']) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['pass'])) &&
    (isset($_POST['pass_confirm'])) && (isset($_POST['departamento'])) && (isset($_POST['interesses'])) && (isset($_POST['curso']))) {

    $nome_utilizador = $_POST['nome'];
    $nickname_utilizador = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $id_curso = $_POST['curso'];
    $id_interesses = $_POST['interesses'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO utilizadores 
                (nome_utilizador,
                nickname_utilizador,
                email_utilizador,
                password_hash_utilizador,
                ref_id_curso) 
                VALUES (?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $nome_utilizador, $nickname_utilizador, $email, $password_hash, $id_curso);
        if (mysqli_stmt_execute($stmt)) {
            $id_user = mysqli_stmt_insert_id($stmt);
            session_start();
            $_SESSION['id_user'] = mysqli_stmt_insert_id($stmt);
            $_SESSION["nome"] = $nome_utilizador;
            $_SESSION["nickname"] = $nickname_utilizador;
            $_SESSION["ativo"] = 1; // rever
            $_SESSION["backoffice"] = 0;
            $_SESSION['avatar']="branco";

            mysqli_stmt_close($stmt);
            mysqli_close($link);
            // UM OU VÁRIOS INTERESSES SEREM INSERIDOS NA BD SEM CONSTRANGIMENTOS
            foreach ($id_interesses as $interesse) {

                $link = new_db_connection();
                $stmt2 = mysqli_stmt_init($link);

                $query2 = "INSERT INTO utilizadores_has_interesses 
                            (utilizadores_id_utilizador,
                            interesses_id_interesse) 
                            VALUES (?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $id_user, $interesse);
                    if (mysqli_stmt_execute($stmt2)) {
                        header("Location: ../home_page.php"); // SUCESSO
                    } else {
                        //echo 'erro5';
                        mysqli_error($link);
                        header("Location: ../sign_up.php?msg=1"); // NAO TEM UM INTERESSE
                        exit;
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    //echo 'erro4';
                    header("Location: ../sign_up.php");
                    exit;
                }
                mysqli_close($link);
            }
        } else {
            //echo 'erro execute';
            header("Location: ../sign_up.php");
            exit;
        }
    } else {
        //echo 'erro execute';
        header("Location: ../sign_up.php");
        mysqli_error($link);
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        exit;
    }
} else {
    header("Location: ../sign_up.php");
    exit;
}
