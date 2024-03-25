<?php

class clean
{
    function cleaner ($d)
    {
        $d = trim($d);
        $d = stripslashes($d);
        $d = htmlspecialchars($d);
        return ($d);
    }

}
