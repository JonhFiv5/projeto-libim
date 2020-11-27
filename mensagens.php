<?php 
    if (isset($_SESSION['aviso'])){
        echo "<div class=\"erro\">".$_SESSION['aviso']."</div>";
        unset($_SESSION['aviso']);
    } else if (isset($_SESSION['sucesso'])){
        echo "<div class=\"sucesso\">".$_SESSION['sucesso']."</div>";
        unset($_SESSION['sucesso']);
    }
?>