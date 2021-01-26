<?php
/*Start Micro Calculator*/

// To get new access_token
function get_access_token_from_api(){

    $param = array(                          
                'email' => 'gulam@gmail.com',
                'password' => 123456,
                'api_token' => 'shgmpzzuwop4'
            );

    $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://6packmacros.com/macro/public/api/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $param,
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
          "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $authresponse = json_decode($response,true); 

    //echo '<pre>'; print_r($authresponse);die('Testing_token');

    $response = array();
    if ($err) {
        $response['status'] = false;
        $response['message'] = "cURL Error:" . $err;
    } else {
        
        $_SESSION['api_access_token'] = $authresponse["data"]['token'];
        $_SESSION['api_token'] = $authresponse["data"]['api_token'];

        $response['status'] = true;
        $response['data'] = $authresponse["data"];
        $response['message'] = $authresponse["message"];
    }
        return $response;
}

function user_fat_grams_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-fat-grams';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $fg_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $fg_response;
    }
}

function user_carbs_grams_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-carbs-grams';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $cg_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $cg_response;
    }
}

function user_adc_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/average-daily-calories';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $adc_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $adc_response;
    }
}

function user_tdee_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-tdee';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $tdee_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $tdee_response;
    }
}

function user_remaining_calories_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/remaining-calories';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $rc_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $rc_response;
    }
}

function user_protein_grams_check($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-protein-grams';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $pg_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $pg_response;
    }
}

add_action('wp_ajax_user_total_check', 'user_total_check');
add_action('wp_ajax_nopriv_user_total_check', 'user_total_check');
function user_total_check() {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
        
        $response = array();
        if(!empty($auth_response) && $auth_response['status'] == true){
            //$token = $auth_response['data']['token'];
            //$api_token = $auth_response['data']['api_token'];
        }else{
            $response['status'] = false;
            $response['error'] = true;
            $response['message'] = $authresponse["message"];
            echo json_encode($response);
            exit();
        }
    }

    $gender = $_POST['gender'];
    $height_ft = $_POST['height_ft'];
    $height_in = $_POST['height_in'];
    $weight = $_POST['weight']; 
    $age= $_POST['age'];
    $job_activity = $_POST['job_activity'];


    if(empty($job_activity)) {
        $job_activity = 0;
    }
    //$bmr_rate= $_POST['bmr_rate'];

    $height = 72;
    if(!empty($height_ft)){
       $height = ($height_ft*12) + $height_in;
    }

    
    
    $days_per_week_workout = $_POST['days_per_week_workout'];
    $duration_of_workout = $_POST['duration_of_workout'];
    $workout_type = $_POST['workout_type'];
    $intensity = $_POST['intensity'];

    $days_per_week_cardio = $_POST['days_per_week_cardio'];
    $cardio_intensity = $_POST['cardio_intensity'];
    $duration_of_cardio = $_POST['duration_of_cardio'];

    $goal = $_POST['goal'];

    $bmr_rate_know = $_POST['bmr_rate_know'];
    $natural_calories = $_POST['natural_calories'];

    $_SESSION['gender'] = $gender;
    $_SESSION['height'] = $height;
    $_SESSION['weight'] = $weight;
    $_SESSION['age'] = $age;
    $_SESSION['job_activity'] = $job_activity;

    $_SESSION['days_per_week_workout'] = $days_per_week_workout;
    $_SESSION['duration_of_workout'] = $duration_of_workout;
    $_SESSION['workout_type'] = $workout_type;
    $_SESSION['intensity'] = $intensity;

    $_SESSION['days_per_week_cardio'] = $days_per_week_cardio;
    $_SESSION['cardio_intensity'] = $cardio_intensity;
    $_SESSION['duration_of_cardio'] = $duration_of_cardio;

    $_SESSION['goal'] = $goal;

    $_SESSION['natural_calories'] = $natural_calories;


    /*if ( empty($gender) || empty($height) || empty($weight) || empty($age) || empty($cardio_intensity) || empty($intensity) || empty($duration_of_cardio) || empty($days_per_week)  || empty($duration_of_workout) || empty($goal) ) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = 'Please Fill Required Fields!!';
        echo json_encode($response);
        exit();//return false;
    }*/

    $api_access_token = $_SESSION['api_access_token'];
    $param = array( 
            'gender' => $gender,
            'weight' => $weight,
            'age' => $age,
            'height' => $height,
            'job_activity' => $job_activity,

            'days_per_week_workout' => $days_per_week_workout,
            'duration_of_workout' => $duration_of_workout,
            'workout_type' => $workout_type,
            'intensity' => $intensity,
            'workout' => 1,

            'days_per_week_cardio' => $days_per_week_cardio,
            'cardio_intensity' => $cardio_intensity,
            'duration_of_cardio' => $duration_of_cardio,
            'cardio' => 1,

            'goal' => $goal,
        );

    if($days_per_week_workout == 0){
        unset($param['workout']);
    }

    if($days_per_week_cardio == 0){
        unset($param['cardio']);
    }

    if($bmr_rate_know == 'yes'){
        $param['natural_calories'] = $natural_calories;
    }

    $total_response['status'] = true;
    $total_response['error'] = false;
    $total_response['message'] = "Success";

    $tdee_response = user_tdee_check($param);
    //echo '<pre>'; print_r($tdee_response); die('fgfhfgjh');
    if($tdee_response['status']==true){
        $total_response['data']['tdee'] = $tdee_response['data']['tdee'];
        $tdee = $tdee_response['data']['tdee'];
    }else{
        $total_response['data']['tdee'] = 0000;
        $tdee = 0000;
    }

    $adc_response = user_adc_check($param);
    if($tdee_response['status']==true){
        $total_response['data']['average_daily_calories'] = $adc_response['data']['average_daily_calories'];
        $average_daily_calories =  $adc_response['data']['average_daily_calories'];
    }else{
        $total_response['data']['average_daily_calories'] = 0000;
        $average_daily_calories = 0000;
    }

    $pg_response = user_protein_grams_check($param);
    if($pg_response['status']==true){
        $total_response['data']['protein_grams'] = $pg_response['data']['protein_grams'];
         $protein_grams = $pg_response['data']['protein_grams'];
    }else{
        $total_response['data']['protein_grams'] = 000;
         $protein_grams = 000;
    }

    $rc_response = user_remaining_calories_check($param);
    if($rc_response['status']==true){
        $total_response['data']['remaining_calories'] = $rc_response['data']['remaining_calories'];
          $remaining_calories = $rc_response['data']['remaining_calories'];
    }else{
        $total_response['data']['remaining_calories'] = 0000;
          $remaining_calories = 0000;
    }

    $cg_response = user_carbs_grams_check($param);
    if($cg_response['status']==true){
        $total_response['data']['carb_grams'] = $cg_response['data']['carb_grams'];
        $carb_grams =$cg_response['data']['carb_grams'];
    }else{
        $total_response['data']['carb_grams'] = 000;
        $carb_grams = 000;
    }

    $fg_response = user_fat_grams_check($param);
    if($fg_response['status']==true){
        $total_response['data']['fat_grams'] = $fg_response['data']['fat_grams'];
        $fat_grams = $fg_response['data']['fat_grams'];
    }else{
        $total_response['data']['fat_grams'] = 000;
        $fat_grams = 000;
    }
    $_SESSION['tdee']=$tdee;
    $_SESSION['average_daily_calories'] = $average_daily_calories;
    $_SESSION['protein_grams'] = $protein_grams;
    $_SESSION['remaining_calories'] = $remaining_calories;
    $_SESSION['carb_grams'] = $carb_grams;
    $_SESSION['fat_grams'] = $fat_grams;
    echo json_encode($total_response);
    exit();

}

add_action('wp_ajax_user_cardio_check', 'user_cardio_check');
add_action('wp_ajax_nopriv_user_cardio_check', 'user_cardio_check');
function user_cardio_check() {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
        
        $response = array();
        if(!empty($auth_response) && $auth_response['status'] == true){
            //$token = $auth_response['data']['token'];
            //$api_token = $auth_response['data']['api_token'];
        }else{
            $response['status'] = false;
            $response['error'] = true;
            $response['message'] = $authresponse["message"];
            echo json_encode($response);
            exit();
        }
    }

    $days_per_week_cardio = $_POST['days_per_week_cardio'];
    $cardio_intensity = $_POST['cardio_intensity'];
    $duration_of_cardio = $_POST['duration_of_cardio'];
    $weight = $_POST['weight']; 
        
    //echo '<pre>'; print_r($_POST); die('bmr_response');
    /*if ( empty($duration_of_cardio) || empty($cardio_intensity) || empty($days_per_week) || empty($weight) ) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = esc_html__('Please Fill Required Fields!!');
        echo json_encode($response);
        exit();//return false;
    }*/

    $api_access_token = $_SESSION['api_access_token'];
    $param = array(                  
            'days_per_week_cardio' => $days_per_week_cardio,
            'cardio_intensity' => $cardio_intensity,
            'duration_of_cardio' => $duration_of_cardio,
            'weight' => $weight,
            'cardio' => 1,
            );

    if($days_per_week_cardio == 0){
        unset($param['cardio']);
    }

    $header = array(
        "Authorization: Bearer $api_access_token",
        "Accept: application/json",
    );
    
    $api_url = 'https://6packmacros.com/macro/public/api/get-cardio-calories';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $cardio_response = json_decode($response,true); 
    $_SESSION['cardio_calories']=$cardio_response['data']['cardio_calories'];
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;

        echo json_encode($response);
        exit();
    } else{
        echo $response;
        exit();
    }

}

add_action('wp_ajax_user_workout_check', 'user_workout_check');
add_action('wp_ajax_nopriv_user_workout_check', 'user_workout_check');
function user_workout_check() {
    //echo '<pre>'; print_r($_POST); die('_POST');
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
        
        $response = array();
        if(!empty($auth_response) && $auth_response['status'] == true){
            //$token = $auth_response['data']['token'];
            //$api_token = $auth_response['data']['api_token'];
        }else{
            $response['status'] = false;
            $response['error'] = true;
            $response['message'] = $authresponse["message"];
            echo json_encode($response);
            exit();
        }
    }

    $weight = $_POST['weight']; 
    $days_per_week_workout = $_POST['days_per_week_workout'];
    $workout_type = $_POST['workout_type'];
    $duration_of_workout = $_POST['duration_of_workout'];
    $intensity = $_POST['intensity'];
        
    /*if ( $workout_type < 0 || $days_per_week < 0 || empty($intensity) || empty($duration_of_workout) || empty($weight) ) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = esc_html__('Please Fill Required Fields!!');
        echo json_encode($response);
        exit();//return false;
    }*/

    $api_access_token = $_SESSION['api_access_token'];
    $param = array(                  
            'workout_type' => $workout_type,
            'days_per_week_workout' => $days_per_week_workout,
            'intensity' => $intensity,
            'duration_of_workout' => $duration_of_workout,
            'weight' => $weight,
            'workout' => 1,
            );
    if($days_per_week_workout == 0){
        unset($param['workout']);
    }

    //echo '<pre>'; print_r($_POST); print_r($param); die('get-workout-calories');

    $header = array(
        "Authorization: Bearer $api_access_token",
        "Accept: application/json",
    );
    
    $api_url = 'https://6packmacros.com/macro/public/api/get-workout-calories';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $workout_response = json_decode($response,true); 
    //print_r($workout_response['data']['workout_calories']);die;
    $_SESSION['workout_calories']=$workout_response['data']['workout_calories'];
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;

        echo json_encode($response);
        exit();
    } else{
        echo $response;
        exit();
    }

}

function user_get_bmr($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-bmr';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $bmr_response = json_decode($response,true); 
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $bmr_response;
    }
}

function user_get_ncb($param) {
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
    }

    $api_access_token = $_SESSION['api_access_token'];

    $api_url = 'https://6packmacros.com/macro/public/api/get-knw-bmr';

    $header = array(
            "Authorization: Bearer $api_access_token",
            "Accept: application/json",
        );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    $ncb_response = json_decode($response,true); 
    //echo '<pre>'; print_r($err);print_r($response);die('ncb_responsedd');
    
    if ($err) {
        $response['status'] = false;
        $response['error'] = true;
        $response['message'] = "cURL Error:" . $err;
        return $response;
    } else{
        return $ncb_response;
    }
}

add_action('wp_ajax_user_personal_check', 'user_personal_check');
add_action('wp_ajax_nopriv_user_personal_check', 'user_personal_check');
function user_personal_check() {
    // if(is_user_logged_in()) {
    // }
    if(!isset($_SESSION['api_access_token'])){
        $auth_response = get_access_token_from_api();
        
        $response = array();
        if(!empty($auth_response) && $auth_response['status'] == true){
            //$token = $auth_response['data']['token'];
            //$api_token = $auth_response['data']['api_token'];
        }else{
            $response['status'] = false;
            $response['error'] = true;
            $response['message'] = $authresponse["message"];
            echo json_encode($response);
            exit();
        }
    }

    $gender = $_POST['gender'];
    $height_ft = $_POST['height_ft'];
    $height_in = $_POST['height_in'];
    $weight = $_POST['weight']; 
    $age= $_POST['age'];
    $job_activity = $_POST['job_activity'];
    $bmr_rate = $_POST['bmr_rate'];
    $bmr_rate_know = $_POST['bmr_rate_know'];

    $height = 72;
    if(!empty($height_ft)){
       $height = ($height_ft*12) + $height_in;
    }
    
    // if (empty($gender) || empty($height_ft) || empty($height_in) || empty($weight) || empty($age) ) {
    //     $response['error'] = true;
    //     $response['message'] = esc_html__('Please Fill Required Fields!!');
    //     echo json_encode($response);
    //     exit();//return false;
    // }

    $api_access_token = $_SESSION['api_access_token'];
    $param = array(                  
            'gender' => $gender,
            'weight' => $weight,
            'age' => $age,
            'height' => $height,
            'job_activity' => $job_activity,
            'bmr_rate' => $bmr_rate,
            );

    $response['status'] = true;
    $response['error'] = false;
    $response['message'] = "Success";

    if($bmr_rate_know == 'no'){
        $param = array(                  
                'gender' => $gender,
                'weight' => $weight,
                'age' => $age,
                'height' => $height,
                'job_activity' => $job_activity,
                'bmr_rate' => $bmr_rate,
                );

        $user_get_bmr = user_get_bmr($param);
        if($user_get_bmr['status']==true){
            $response['data']['bmr_rate'] = $user_get_bmr['data']['bmr_rate'];
            $response['data']['natural_calories'] = $user_get_bmr['data']['natural_calories'];
            $bmr_rate =$user_get_bmr['data']['bmr_rate'];
        }else{
            $response['data']['bmr_rate'] = 0000;
            $response['data']['natural_calories'] = 0000;
            $bmr_rate =0000;
        }
    }
    $_SESSION['bmr_rate']=$bmr_rate;

    if($bmr_rate_know == 'yes'){

        $param = array(                  
                'job_activity' => $job_activity,
                'bmr_rates' => $bmr_rate,
                );

        $user_get_ncb = user_get_ncb($param);

        if($user_get_ncb['status']==true){
            //$response['data']['bmr_rate'] = $user_get_ncb['data']['bmr_rate'];
            $response['data']['natural_calories'] = $user_get_ncb['data']['natural_calories'];
        }else{
            //$response['data']['bmr_rate'] = 0000;
            $response['data']['natural_calories'] = 0000;
        }
    }

    //echo '<pre>'; print_r($user_get_ncb);die('user_get_bmr');
    //echo '<pre>'; print_r($api_access_token); print_r($response);die('bmr_response');

    echo json_encode($response);
    exit();
}

/*End Micro Calculator*/