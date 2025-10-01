<?php
    // Sorting Algorithm

    // sortEntries sorts an array of arrays, including an sql datetime value
    // It sorts the array into the most recent posts first
    function sortEntries(&$array) {
        $firstKey = "datetime"; //the key of the value is to sorted by

        for ($i=0; $i<sizeof($array)-1; $i++) {
            for ($k=0; $k<(sizeof($array)-$i)-1; $k++) {
                if ($array[$k][$firstKey] < $array[$k+1][$firstKey]) {
                    $temp = $array[$k+1];
                    $array[$k+1] = $array[$k];
                    $array[$k] = $temp;
                }
            }
        }
    }
?>