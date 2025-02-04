<?php 

echo "<header>";

include "./vue/layout/header.php";


if(session_id() == '') {
    $myAccount = "Mon compte";
    session_start();
}


if (isset($_SESSION["user_id"])){
    $myAccount = $_SESSION["user_firstname"];
    include "./vue/layout/headerLogged.php";
}else{
    include "./vue/layout/headerVisitor.php";
}

echo "    
        </ul>
    </nav>
</header>
";
