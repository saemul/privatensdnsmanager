<?php 

   class MainDnsPrivatens 
   {   
        function request($url, $method, $oauth2, $datas){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => http_build_query($datas),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$oauth2,
                "Content-Type: application/x-www-form-urlencoded",
                "X-Requested-With: XMLHttpRequest"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return $err;
            } else {
                return json_decode($response);
            }
        }

        function authentication($url,$data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url."/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data)
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $result = json_decode($response);

            return $result;
        }

        function checkStatus($params,$domain) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $domain
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/check/status","POST",$auth->access_token,$datas);
                
                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function confirmChangeNs($params,$domain) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $domain
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/confirm","POST",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function createDNS($params,$domain) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $domain
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/create","POST",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function addDNS($params,$data) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $data['domain'],
                "name" => $data['host'],
                "type" => $data['type'],
                "ttl" => $data['ttl'],
                "value" => $data['value']
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/add","POST",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function deleteDNS($params,$ids) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "dns_manager_id" => $ids,
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/delete","DELETE",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function terminateDNS($params,$domain) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $domain,
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/terminate","DELETE",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }

        function listDNS($params,$domain) {
            $oauth2 = [
                "grant_type" => "client_credentials",
                "client_id" => $params['clientid'],
                "client_secret" => $params['secretid'],
                "scope" => "",
        
            ];
            $datas = [
                "domain" => $domain
            ];
            try {
                $auth = $this->authentication($params['apiurl'],$oauth2);
                
                $request = $this->request($params['apiurl']."/rest/v2/dnsmanager/list","POST",$auth->access_token,$datas);

                return $request;
                
            } catch (\Exception $e) {
                return array(
                    'error' => $e->getMessage(),
                );
            }
            
        }
   }

function privatensdns_config() {
    $form  = array(
        "apiurl" => array (
            "FriendlyName" => "API Url",
            "Type"         => "text", # Text Box
            "Size"         => "255", # Defines the Field Width
            "Description"  => "API Url",
            "Default"      => "",
            "Placeholder"  => "Secret Id"
        ),
        "clientid" => array (
            "FriendlyName" => "Client Id",
            "Type"         => "text", # Text Box
            "Size"         => "255", # Defines the Field Width
            "Description"  => "Client Id API Privatens",
            "Default"      => "",
            "Placeholder"  => "Client Id"
        ),
        "secretid" => array (
            "FriendlyName" => "Secret Id",
            "Type"         => "text", # Text Box
            "Size"         => "255", # Defines the Field Width
            "Description"  => "Secret Id API Privatens",
            "Default"      => "",
            "Placeholder"  => "Secret Id"
        )
        );
      $configarray = array(
        "name" => "Privatens DNS Manager",
        "description" => "DNS Manager For Privatens",
        "version" => "1.0",
        "author" => "Privatens DNS Manager",
        "fields" => $form
        );
        return $configarray;
}


function privatensdns_clientarea($vars) { 
    
    $main      = new MainDnsPrivatens;

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $session    = $_SESSION['uid'];
    $domainname = $_GET['domainname'];
    $datas      = array(
        'session'   =>$session,
        'domainname'=>$domainname,
        'vars'=>json_encode($vars),
    );

    $check=$main->checkStatus($vars,$_GET['domainname']);
    if(isset($_GET['delete'])){ 
        $domainname=$_GET['domainname'];
        $ids=$_GET['ids'];
        $deleteDns = $main->deleteDNS($vars,$ids);
        if($deleteDns->code == 200){
            $message = ['status' => 'success', 'messages' => $deleteDns->message];
        }else{
            $message = ['status' => 'failed', 'messages' => 'Failed delete dns record. Please contact your administrator!'];
        }

        $getDNS = $main->listDNS($vars,$_GET['domainname']);
        $dataDns = ['dns' => $getDNS->data, 'domainname' =>$_GET['domainname'], 'message' => $message];
        return array(
            'pagetitle'    => 'Privatens DNS Manager',
            'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
            'templatefile' => 'clienthome',
            'requirelogin' => true, # accepts true/false
            'forcessl'     => false, # accepts true/false
            'vars'         => $dataDns,
        );
    }

    if(isset($_GET['terminate'])){ 
        $domainname=$_GET['domainname'];
        $terminateDns = $main->terminateDNS($vars,$domainname);
        if($terminateDns->code == 200){
            $message = ['status' => 'success', 'messages' => $terminateDns->message];
        }else{
            $message = ['status' => 'failed', 'messages' => 'Failed delete dns record. Please contact your administrator!'];
        }

        $dataDns = ['domainname' =>$_GET['domainname'], 'message' => $message];
        return array(
            'pagetitle'    => 'Privatens DNS Manager',
            'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
            'templatefile' => 'confirm',
            'requirelogin' => true, # accepts true/false
            'forcessl'     => false, # accepts true/false
            'vars'         => $dataDns,
        );
    }
    
    
    if(isset($_GET['add'])){   
        $domainname=$_GET['domainname'];
        $data=array(
            'domain'=>$_POST['domain'],
            'host'  =>$_POST['host'],
            'type'  =>$_POST['type'],
            'value' =>$_POST['value'],
            'ttl'   =>$_POST['ttl'],
        );
        $addDNS = $main->addDNS($vars,$data);
        if($addDNS->code == 200){
            $message = ['status' => 'success', 'messages' => $addDNS->message];
        }else{
            $message = ['status' => 'failed', 'messages' => 'Failed add dns record. Please contact your administrator!'];
        }

        $getDNS = $main->listDNS($vars,$_GET['domainname']);
        $dataDns = ['dns' => $getDNS->data, 'domainname' =>$_GET['domainname'], 'message' => $message];
        return array(
            'pagetitle'    => 'Privatens DNS Manager',
            'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
            'templatefile' => 'clienthome',
            'requirelogin' => true, # accepts true/false
            'forcessl'     => false, # accepts true/false
            'vars'         => $dataDns,
        );
        
    }

    if(isset($_GET['confirm'])){
        $changeNs = $main->confirmChangeNs($vars,$_GET['domainname']);
        if($changeNs->code == 200){
            $createDNS = $main->createDNS($vars,$_GET['domainname']);
            if($createDNS->code == 200){
                $message = ['status' => 'success', 'messages' => $createDNS->message];
            }else{
                $message = ['status' => 'failed', 'messages' => 'Failed create dns record. Please contact your administrator!'];
            }
            
            sleep (10);

            $getDNS = $main->listDNS($vars,$_GET['domainname']);
            $allData = ['dns' => $getDNS->data, 'domainname' =>$_GET['domainname']];
            return array(
                'pagetitle'    => 'Privatens DNS Manager',
                'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
                'templatefile' => 'clienthome',
                'requirelogin' => true, # accepts true/false
                'forcessl'     => false, # accepts true/false
                'vars'         => $allData,
            );

        }

    }
    
    if($check->data->status == 0){
        return array(
            'pagetitle'    => 'Privatens DNS Manager',
            'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
            'templatefile' => 'confirm',
            'requirelogin' => true, # accepts true/false
            'forcessl'     => false, # accepts true/false
            'vars'         => $datas,
        );
    }


    $getDNS = $main->listDNS($vars,$_GET['domainname']);
    $allData = ['dns' => $getDNS->data, 'domainname' =>$_GET['domainname']];
    return array(
        'pagetitle'    => 'Privatens DNS Manager',
        'breadcrumb'   => array('index.php?m=privatensdns'=>'Privatens DNS Manager'),
        'templatefile' => 'clienthome',
        'requirelogin' => true, # accepts true/false
        'forcessl'     => false, # accepts true/false
        'vars'         => $allData,
    );
 
}
