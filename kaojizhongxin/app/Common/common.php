<?php

function true_file_path($file_path ,$flag=1){

        $new_path = __ROOT__ . '/Public/downloads/' . $file_path;
        return $new_path;
    }

    ?>