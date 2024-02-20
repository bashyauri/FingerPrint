<?php
/*
 * Author: Dahir Muhammad Dahir
 * Date: 26-April-2020 12:41 AM
 * About: this file is responsible
 * for all Database queries
 */

namespace fingerprint;

require_once("../core/Database.php");

function setUserFmds($user_id, $index_finger_fmd_string, $middle_finger_fmd_string)
{
    try {
        // Create a Database instance
        $myDatabase = new Database();

        // Prepare the SQL query
        $sql_query = "UPDATE users SET indexfinger=?, middlefinger=? WHERE id=?";

        // Specify the parameter types for binding
        $param_type = "ssi";

        // Create an array of parameters
        $param_array = [$index_finger_fmd_string, $middle_finger_fmd_string, $user_id];

        // Execute the update query
        $affected_rows = $myDatabase->update($sql_query, $param_type, $param_array);

        // Check if the update was successful
        if ($affected_rows > 0) {
            return "success";
        } else {
            // Log an error message
            echo "Failed to update user with ID $user_id in querydb";
            return "failed in querydb";
        }
    } catch (\Exception $e) {
        // Log the exception
        echo "Exception in setUserFmds: " . $e->getMessage();
        return "failed due to exception";
    }
}


function getUserFmds($user_id)
{
    $myDatabase = new Database();
    $sql_query = "select indexfinger, middlefinger from users where id=?";
    $param_type = "i";
    $param_array = [$user_id];
    $fmds = $myDatabase->select($sql_query, $param_type, $param_array);
    return json_encode($fmds);
}

function getUserDetails($user_id)
{
    $myDatabase = new Database();
    $sql_query = "select username, fullname from users where id=?";
    $param_type = "i";
    $param_array = [$user_id];
    $user_info = $myDatabase->select($sql_query, $param_type, $param_array);
    return json_encode($user_info);
}

function getAllFmds()
{
    $myDatabase = new Database();
    $sql_query = "select indexfinger, middlefinger from users where indexfinger != ''";
    $allFmds = $myDatabase->select($sql_query);
    return json_encode($allFmds);
}
