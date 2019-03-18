<?php
function getdirection($currentfield) {
    $orderfield = request('orderfield', '');
    $dir = request('orderdir', '');
    return (($currentfield==$orderfield) && ($dir=='asc' || $dir=='') ) ? $orderfield.' asc' : $orderfield.' desc' ;
}
