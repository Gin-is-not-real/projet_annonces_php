<?php
// {"times":[1000000300,1000000400,1000000000],"ids":[1001,2002,3003]}

// placer le nom de fichier dans un contexte global pour etre utilisables par les fonctions du script
$file = 'sessions_times.json';

/**
 * recupere les données du fichier sous forme de string, les convertis et les renvoi sous forme d'objet exploitable 
 * 
 */
function getDataObject($file_path) {
    $content = file_get_contents($file_path);
    return json_decode($content);
}

$data_obj = getDataObject($file);
check_for_timeout($data_obj);

// time: start - time()
// 800 = 30 minutes
function check_for_timeout($data_obj) {
    // TESTS
    $actual_time = 1000000900;
    // $actual_time = 164;
    // $actual_time = time();

    /*
    store times and ids to keep for update data after the loop
    */
    $times_to_keep = [];
    $ids_to_keep = [];

    for($i = 0; $i < count($data_obj->times); $i++) {
        $account_time = $data_obj->times[$i];
        $account_id = $data_obj->ids[$i];

        /*
        check if time is over by made the diff between times, delete account if is over, else, store values
        */
        $diff = $actual_time - $account_time;

        if(($diff) > 800) {
            delete_user($account_id);
        }
        else {
            array_push($times_to_keep, $account_time);
            array_push($ids_to_keep, $account_id);
        }
    }

    /*
    recreate data obj, with stored times and ids, and update the file  
    */
    $data_obj->times = $times_to_keep; 
    $data_obj->ids = $ids_to_keep; 
    update_data_file($data_obj);
}

function delete_user($id) {
    // call controllers
}

function update_data_file($data_obj) {
    $file = 'sessions_times.json';
    $json_str = json_encode($data_obj);
    file_put_contents($file, $json_str);
}
