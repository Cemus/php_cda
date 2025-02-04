<?php 

echo "<header>";

include "./views/layout/header.php";


if(session_id() == '') {
    $myAccount = "Mon compte";
    session_start();
}


if (isset($_SESSION["user_id"])){
    $myAccount = $_SESSION["user_firstname"];
    include "./views/layout/headerLogged.php";
}else{
    include "./views/layout/headerVisitor.php";
}

echo "    
        </ul>
    </nav>
</header>
";
