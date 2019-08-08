PrivateNS DNS Manager Module v3

1. Upload zip into your WHMCS installation folder
2. Extract zip
3. Open WHMCS Admin Page -> Setup -> Addon Modules
4. Activate PrivateNS DNS Manager
5. Insert Client ID, Secret ID and you Reseller URL that you can get from https://developer.irsfa.id, for API Documentation please read here: https://developer.irsfa.id/documentation/ 
6. Save Changes
7. Put this code somewhere in your clientareadomaindetails.tpl

<div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4><strong>DNS Manager:</strong></h4> <a href="https://customdomainanda.com/index.php?m=privatensdns&domainname={$domain}" class="btn btn-info" role="button">DNS Manager</a>
            </div>
</div>

    after thisline code:
<div class="row">
    <div class="col-sm-offset-1 col-sm-5">
        <h4><strong>{$LANG.clientareastatus}:</strong></h4> {$status}
    </div>
</div>