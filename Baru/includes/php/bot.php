<?php    
    require_once "environment.php";        

    function wikimedia_get_token($ch, $type) {
        $fields = array(
            'action' => 'query',
            'meta'   => 'tokens',
            'type'   => $type,
            'format' => 'json'
        );
                
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, encode_as_url($fields));

        $res = curl_exec($ch);
        if($res === FALSE) 
           show_error('wikimedia_get_token()', curl_error($ch));
        
        $res = curl_exec($ch);                
        return json_decode($res, true)['query']['tokens'][$type.'token'];
    }

    function wikimedia_bot_login($ch, $token) {                        
        $fields = array(
            'action'            => 'login',
            'lgtoken'           => $token,
            'lgname'            => $GLOBALS['bot_username'],
            'lgpassword'        => $GLOBALS['bot_password'],
            'format'            => 'json'
        );

        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, encode_as_url($fields));

  
        $res = curl_exec($ch);
        if($res === FALSE) 
           show_error('wikimedia_bot_login()', curl_error($ch));
  
        return json_decode($res, true)['login']['result'] == 'Success';
    }

    function wikimedia_create_account($ch, $user, $password, $token) {        
        $fields = array(
            'action'      => 'createaccount',
            'password'    => $password,
            'retype'      => $password,
            'username'    => $user->username,
            'createtoken' => $token,
            'realname'    => $user->name,            
            'email'       => $user->username . '@ui.ac.id',
            'createreturnurl' => 'http://'.$GLOBALS['base_url'],
            'format' => 'json'
        );
        
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, encode_as_url($fields));

        $res = curl_exec($ch);
        if($res === FALSE) 
           show_error('wikimedia_create_account()', curl_error($ch));

        return json_decode($res, true)['createaccount']['status'] == 'PASS';
    }
?>