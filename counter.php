<?php
function updateCounterWithCookie($filename = 'compteur.txt') {
    if (!isset($_COOKIE['visited'])) {
        if (!file_exists($filename)) {
            file_put_contents($filename, '0');
        }
        $counter = (int) file_get_contents($filename);
        $counter++;
        file_put_contents($filename, $counter);
        setcookie('visited', 'true', time() + 3600);
        return $counter;
    } else {
        if (!file_exists($filename)) {
            file_put_contents($filename, '0');
        }
        return (int) file_get_contents($filename);
    }
}

$visits = updateCounterWithCookie();
?>

