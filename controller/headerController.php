<?php 
include "./vue/layout/headerTop.php";
echo "<header>";

include "./vue/layout/header.php";
$myAccount = "Mon compte";
if(session_id() == '') {
    session_start();
}
if (isset($_SESSION["user_id"])){
    $myAccount = $_SESSION["user_firstname"];
    include "./vue/layout/headerBot.php";
}

echo "    
        </ul>
    </nav>
</header>
";
