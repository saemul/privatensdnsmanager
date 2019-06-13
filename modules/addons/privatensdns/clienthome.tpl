{if $message['status'] == 'success'}
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Well done!</strong> {$message['messages']}
    </div>
{elseif $message['status'] == 'failed'}
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Oh snap!</strong> {$message['messages']}
    </div>
{/if}
<div class="panel panel-default">
<div class="panel-heading">
    <h4>DNS Manager
    <span class=" pull-right">
        <a id='terminated' data-loading-text="<i class='fa fa-spinner fa-spin '></i> Terminating" href="index.php?m=privatensdns&domainname={$domainname}&terminate" class="btn btn-warning"><i class="fa fa-ban"></i> Terminate All Record</a>
    </span>
    </h4>
    <div class="clearfix"></div>

</div>
<div class="panel-body">
    <table class="table table-condensed table-striped">
        <thead class="bg-primary">
            <th>HostName</th>
            <th>Type</th>
            <th>Ttl</th>
            <th>Value</th>
            <th>#Action</th>
        </thead>
        <tbody>
            {foreach $dns as $value}
            <tr>
                <td><input type='text' class='form-control' value='{$value->host_name}'></td>
                <td><input type='text' class='form-control' value='{strtoupper($value->type)}'></td>
                <td><input type='text' class='form-control' value='{$value->ttl}'></td>
                <td><input type='text' class='form-control' value='{$value->value}'></td>
                <td><a href='index.php?m=privatensdns&domainname={$domainname}&delete&ids={$value->dns_manager_id}' class='btn btn-danger deleted' data-loading-text="<i class='fa fa-spinner fa-spin '></i> Deleting"><i class="fa fa-trash"></i> Delete</a></td>
            </tr>
            {/foreach}
        </tbody>
    </table>
     <form id='form_privatensdns' method="post" action='index.php?m=privatensdns&domainname={$domainname}&add'>
      
        <table class="table table-condensed table-striped">
            <tbody>
                <tr>
                     
                    <input type='hidden' name="domain" class='form-control' value='{$domainname}'>
                     
                    
                     <td>
                         <input name="host" class='form-control' placeholder='Hostname'>
                     </td>
                     <td>
                         <select name="type" class="form-control">
						    <option value="a">A</option>
						    <option value="aaaa">AAAA</option>
							<option value="cname">CNAME</option>
							<option value="mx">MX</option>
							<option value="txt">TXT</option>
							<option value="sfp">SFP</option>
							<option value="ns">NS</option>
						</select>
                     </td>
                      
                      <td>
                         <input name="ttl" class='form-control' placeholder='ttl'>
                     </td>
                      <td>
                         <input name="value" class='form-control' placeholder='value'>
                     </td>
                </tr>
                <tr>
                    <td colspan='6'>
                        <center><button id='add' class='btn btn-primary' type='submit' data-loading-text="<i class='fa fa-spinner fa-spin '></i> Adding DNS Record"><i class="fa fa-plus"></i> Add New</button></center>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
</div>
<script>
    $(document).ready(function(){
        var uri = window.location.toString();
        if (uri.indexOf("&add") > 0 || uri.indexOf("&delete&ids") > 0 || uri.indexOf("&confirm") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("&add"));
            var clean_uri2 = uri.substring(0, uri.indexOf("&delete&ids"));
            var clean_uri3 = uri.substring(0, uri.indexOf("&confirm"));
            window.history.replaceState({}, document.title, clean_uri);
            window.history.replaceState({}, document.title, clean_uri2);
            window.history.replaceState({}, document.title, clean_uri3);
        }
    });
    $("#add").click(function() {
        var $btn = $(this);
        $btn.button('loading');
        
    });

    $(".deleted").click(function(){
        var $btn = $(this);
        var answer = confirm("Are you sure you want to delete this record?");
        if(answer){
            $btn.button('loading');
            return true;
        }
        else{
            return false;
        }
    });

    $("#terminated").click(function() {
        var $btn = $(this);
        var answer = confirm("Are you sure you want to terminate all record?");
        if(answer){
            $btn.button('loading');
            return true;
        }
        else{
            return false;
        }
        
    });
</script>
