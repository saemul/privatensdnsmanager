PrivateNS DNS Manager Module v3

1. Upload zip into your WHMCS installation folder
2. Extract zip
3. Open WHMCS Admin Page -> Setup -> Addon Modules
4. Activate PrivateNS DNS Manager
5. Insert Client ID, Secret ID and you Reseller URL
6. Save Changes
7. Put this code somewhere in your clientareadomain.tpl and clientareadomaindetails.tpl

<a href="index.php?m=irsfadns&domainname={$domain}">
DNS Manager</a>