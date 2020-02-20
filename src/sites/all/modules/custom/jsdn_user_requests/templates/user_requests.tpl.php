    <div class="container-fluid requests">
    <div class="row"> 
                <div class="col-md-12">
                  <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo JSDN_OAUTH_HOST;?>/jsdn/dashboard/dashboardHome.action?brdcrm=new" ><?php echo t('Subscriptions');?></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link active" id="license-requests" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false"><?php echo t('License Requests');?></a>
                    </li>
                  </ul>				
                  <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade active in" id="requests" role="tabpanel" aria-labelledby="license-requests">
                      <div>
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                            <tr>
                              <th class="select-filter no-sort"><?php echo t('Service Name');?></th>
                              <th class="select-filter no-sort"><?php echo t('Offer Name');?></th>
                              <th class="no-sort"><?php echo t('License Request ID');?></th>
                              <th class="no-sort"><?php echo t('Requested By');?></th>
							   <th class="select-filter no-sort"><?php echo t('Email');?></th>
                              <th><?php echo t('Requested On');?></th>
                              <th class="select-filter no-sort"><?php echo t('Department');?></th>
                              <th class="no-sort"><?php echo t('Price');?></th>
                              <th class="no-sort"><?php echo t('Available Licenses');?></th>
                              <th class="select-filter no-sort" type="Status"><?php echo t('Status');?></th>
                              <th class="no-sort all action"><?php echo t('Actions');?></th>
                              <th></th>
                            </tr>
                          </thead>
                        </table>
                      <div class="dt-more-container"> <a id="jctable-load-more" style="display:none"><?php echo t('Load More');?></a> </div>
                      </div>
                  </div>
                  </div>
                </div>
        </div>
    </div>
<div class="modal fade actionpopup">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div> 
    <script>
    function endUserPopup(a){
      var useraction = jQuery(a).attr('rel');
      var requestId = jQuery(a).attr('requestId');
      var offerName = jQuery(a).attr('offerName');
      var requestBy = jQuery(a).attr('requestBy');
      var comment = jQuery(a).attr('comment');
	  var serviceType = jQuery(a).attr('serviceType');
      if(useraction == "Approval"){
        var title = "<?php echo t('Approval Comment');?>";
        var label = "<?php echo t('Comment');?>";
      }else if(useraction == "Rejection"){
        var title = "<?php echo t('Reason for Rejection');?>";
        var label = "<?php echo t('Reason');?>";
      }else if(useraction == "Request"){
        var title = "<?php echo t('Reason for Request');?>";
        var label = "<?php echo t('Reason');?>";
      }

      if(useraction == "reject"){
      jQuery('.actionpopup .modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:#fff"><?php echo t('Reason for Rejection');?></h4></div><form id="cancelForm" type="reject"><div class="modal-body textleft"><div><?php echo t('Kindly specify the reason for rejection');?></div><div class="form-item"><label class="margin"><span class="required">*</span><?php echo t('Reason');?>:</label><div class="form-item"><input type="hidden" value="'+requestId+'" name="license-request-id"/><textarea id="comment" name="reject-comments" class="form-text required" maxlength="1200"></textarea></div></div></div><div class="modal-footer"><div class="button"><button type="submit" class="btn btn-primary"><?php echo t('Confirm');?></button><button class="btn btn-default cancel"><?php echo t('Cancel');?></button></div></div></form>');
      }else if(useraction == "approve"){
      jQuery('.actionpopup .modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:#fff"><?php echo t('Approve');?></h4></div><form id="cancelForm" type="approve"><div class="modal-body textleft"><div><?php echo t('Do you want to approve a license of');?> "'+offerName+'" <?php echo t('to');?> '+requestBy+'?</div><div class="form-item"><label class="margin"><span class="required">*</span><?php echo t('Comments');?>:</label><div class="form-item"><input type="hidden" value="'+requestId+'" name="license-request-id"/><input type="hidden" value="'+serviceType+'" name="serviceType"/><textarea id="comment" name="approve-comments" class="form-text required" maxlength="1200"></textarea></div></div></div><div class="modal-footer"><div class="button"><button type="submit" class="btn btn-primary"><?php echo t('Confirm');?></button><button class="btn btn-default cancel"><?php echo t('Cancel');?></button></div></div></form>');
      }else{
      jQuery('.actionpopup .modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" style="color:#fff">'+title+'</h4></div><div class="modal-body"><div class="textleft"><label>'+label+':</label><p>'+comment+'</p></div></div><div class="modal-footer"><button class="btn btn-default cancel"><?php echo t('Close');?></button></div></div>');
      }
      jQuery('.actionpopup').modal('show');
    }
    var actionType = null;
jQuery(document).ready(function (){
   var table = jQuery('#example').DataTable({
  language: {
	emptyTable:"<?php echo t('No data available in table');?>",
    infoEmpty: "<?php echo t('Showing').' 0 '.t('of').' 0';?>",
    info:"<?php echo t('Showing'). ' _END_ '.t('of').' _TOTAL_';?>", 
    search: "_INPUT_",
        searchPlaceholder: "<?php echo t('Search by License Request ID');?>",
    },
    dom: 'frti',
    "serverSide": true,
    "processing": false,
    "bFilter": true,
    ajax: jQuery.fn.dataTable.pageLoadMore({
            "url": "/cms/sites/all/modules/custom/jsdn_user_requests/api/requestAPI.php",
            "type": "POST",
    }),
   "preDrawCallback": function() {jQuery('div#requests').block({ message: '<?php echo t('Processing');?>'}); },
    "columns": [
        { "data": "service-name" }, 
        { "data": "offer-name" }, 
        { "data": "request-id" }, 
        { "data":"requested-by"},
		{ "data":"requester-emailId"},
        { "data": "requested-on"},
        { "data": "department"},
        { "data":"price"},
        { "data": "available-Quantity"},
        { "data": "status",
         "render": function(data, type, row, meta){
            if(row['statusCode'] === 'Rejected'){
              var comment = row['reject-Comments'];
              var action = "Rejection";
            }else if(row['statusCode'] === "Approved"){
              var comment = row['approve-Comments'];
              var action = "Approval";
            }else if(row['statusCode'] === "Requested"){
              var comment = row['request-Comments'];
              var action = "Request";
            }
            if(data){
              data = '<a onclick="endUserPopup(this)" comment="'+comment+'" rel="'+action+'">' + data + '</a>';
            }return data;
          } 
        }, 
      { 
         "data": "actions",
     // Actions column gerating here. Need to build it dynamically from the json
         "render": function(data, type, row, meta){
      // Need to handle no action case also
      if(data.length > 0){
      var arrayLength = data.length;
	  var serviceType = row['serviceType'];
            if(type === 'display'){
              jQuerylist = "";
              jQuery(data).each(function(i){
                jQuerylist += '<li><a onclick="endUserPopup(this)" rel="'+data[i].key+'" requestId="'+row['request-id']+'" offerName="'+row['offer-name']+'" requestBy="'+row['requested-by']+'" serviceType="'+serviceType+'">'+data[i].label+'</a></li>';
              })
                data = '<div class="dropdown"><img class="actions" src="/cms/sites/all/modules/custom/jsdn_user_requests/images/actions-dot.gif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img><ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel">'+jQuerylist+'</ul>                        </div>';
            }
          }
            return data;
         }
      },
  { "data": "empty" },    
   ],
    responsive: {
        details: {
            type: 'column',
            target: -1
        }
    },
  columnDefs: [
  {
        className: 'control',
        orderable: false,
        targets:   -1,
    },
  {
      "targets"  : 'no-sort',
      "orderable": false,
      },
      {
      "targets"  : 0,
      "render": jQuery.fn.dataTable.render.ellipsis( 20 )
      },
      {
      "targets"  : 1,
      "render": jQuery.fn.dataTable.render.ellipsis( 15 )
      },
      {
      "targets"  : 3,
      "render": jQuery.fn.dataTable.render.ellipsis( 15 )
      },
      {
      "targets"  : 4,
      "render": jQuery.fn.dataTable.render.ellipsis( 25 )
      },	  
      {
      "targets"  : 5,
      "render": jQuery.fn.dataTable.render.ellipsis( 20 )
      },	  
      {
      "targets"  : 7,
      "className": "text-center"
      } ],
    "order": [ 5, 'desc' ],
      drawCallback: function(){
        jQuery('div#requests').unblock();
        jQuery(".input-sm").removeAttr("disabled");
        actionType = null;
         if(jQuery('#jctable-load-more').is(':visible')){
            jQuery('html, body').animate({
               scrollTop: jQuery('#jctable-load-more').offset().top
            }, 1000);
         }
         jQuery('#jctable-load-more').toggle(this.api().page.hasMore());
        },
      initComplete: function (settings, json) {
      // Create Filter icons for the columns enabled filters
      this.api().columns('.select-filter').every( function (pos) {
            var column = this;
      
      // columnsource will get the data for this column
      var columnsource = table.column( this.index() ).dataSrc();
      // This will get the filter array for this column
            // create the filter icon and show in the column
      var select = jQuery('<div class="dropdown"><img class="filter" src="/cms/sites/all/modules/custom/jsdn_user_requests/images/filter.png" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img><ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><a class="filterApply" filterby="'+columnsource+'"><?php echo t('Apply');?></a></ul></div>')
            .appendTo( jQuery(column.header()))
      // Generate Column Filter Values and prepend to the above filter dropdown. Need to handle no result case
      var list ={};
      jQuery.each( json.filters[columnsource], function( index, data ){
        if(list[columnsource]){
          list[columnsource] += '<li><span><input name="filterCheckbox" type="checkbox" value="'+data.value+'"></span><span>'+data.label+'</span></div></li>';
        }else{
          list[columnsource] = '<li><span><input name="filterCheckbox" type="checkbox" value="'+data.value+'"></span><span>'+data.label+'</span></div></li>';
        }
        
      });
	  select.find('ul').prepend( list[columnsource] );
      jQuery('.dropdown-menu input').on('click',function(e){
        e.stopImmediatePropagation();
        var container = jQuery(".dropdown-menu");
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
          container.hide();
        }
      })
      // Below should take care when click on apply pass all the filter values to the backend. Need to work on
      jQuery('.filterApply').on( 'click', function (event) {
        jQuery(this).parents('div.dropdown').removeClass('open');
        event.stopImmediatePropagation();
        var selfilters = [];
        var items =[];
        var filterType = jQuery(this).attr('filterby');
              jQuery.each(jQuery(this).parent('ul').find("input:checked"), function(){        
                  selfilters.push('"'+jQuery(this).val()+'"');
              });
              var val = jQuery.fn.dataTable.util.escapeRegex(
                selfilters.join(", ")
                );
              actionType = "filter";
              var items = '['+selfilters+']';
              column
              .search( items ? ''+items+'' : '', true, false )
              .page.len('10')
              .draw();
          });

            });
        }   
   });
 // Handle search on enter key press
  jQuery('#example_filter input').unbind();
  jQuery('#example_filter input').bind('keyup', function(e) {
    if(e.keyCode == 13) {
      actionType = "search";
      	  var numericReg = /^[0-9\s]*$/;
          if(numericReg.test(this.value) == false){
            this.value='';
          }
		 else{
	jQuery(".input-sm").attr("disabled", "disabled");
      table.search(this.value).columns().search('').page.len('10').draw();  
	  }
    }
  });
 // Handle Load more 
   jQuery('#jctable-load-more').on('click', function(){ 
      table.page.loadMore();
   });
   
});
</script>