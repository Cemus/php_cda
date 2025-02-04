<?php 
include "./vue/layout/headerTop.php";
echo "<header>";

include "./vue/layout/header.php";
if(session_id() == '') {
    session_start();
}
if (isset($_SESSION["user_id"])){
    include "./vue/layout/headerBot.php";
}

echo "    
        </ul>
    </nav>
</header>
";
