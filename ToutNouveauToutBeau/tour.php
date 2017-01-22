<?php
    $dom = new DomDocument();
    $dom->load('./config.xml');
    
    $racine = $dom->documentElement;
    
    $ip = $dom->getElementsByTagName('Tour');
    if($_SERVER['REMOTE_ADDR'] === $ip->item(0)->nodeValue){
        echo 'ok';
    }
    else {
        echo 'non';
    }
    
?>