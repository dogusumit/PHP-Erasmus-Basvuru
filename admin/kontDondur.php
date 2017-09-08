<?php
function kontDondur($a)
{
    switch ($a) {
        case "ÖnLisans":
            return "kont_onlis";
            break;
        case "Lisans":
            return "kont_l";
            break;
        case "Y.Lisans":
            return "kont_yl";
            break;
        case "Doktora":
            return "kont_dok";
            break;
        default:
            echo 'kontDondur fonksiyon hatası!';
    }
}
?>