(function( $ ) {
$( document ).ready(function() { 
    var topAction;
    $('.action-list a').click(function(e){
        e.preventDefault();
        topAction = false;
        var code = $(this).attr('key');
        if($(this).parents('.action-list').hasClass('top')){
            topAction = true; 
        }
        var json = $(this).parents('.action-list').find('input.actionJson').val();
        var actionJSON = JSON.parse(json);
        var note = "";
        var inputs = "<form  id='actionForm' method='post'>";
        $.each(actionJSON,function(i,val){
            if(val.code === code){
                var currentAction = val;
                if(currentAction["confirmation-message"]){
                    if(currentAction.note){ note = currentAction.note +'<br><br>';}
                    BootstrapDialog.show({
                        title: currentAction.label,
                        message: note + currentAction["confirmation-message"],
                        buttons: [{
                        cssClass: 'btn-primary',
                        label: 'OK',
                        action: function(dialog) { 
                            if(jQuery.isEmptyObject(currentAction['input-parameters']) == false){
                                dialog.close();
                                $.each(currentAction['input-parameters'],function(j,item){
                                    if(item.dataType == "text"){
                                        if(item.required == "true") {var required ='required="'+item.required+'"';}else{var required = "";}
                                        if(item['allowed-pattern']) {var pattern ='pattern='+item['allowed-pattern']+'';}else{var pattern = "";}
                                        if(item.maxLength) {var maxLength ='maxlength='+item.maxLength+'';}else{var maxLength = "";}
                                        if(item.minLength) {var minLength ='minlength='+item.minLength+'';}else{var minLength = "";}
                                        if(item['dynamic-field-validation']){ var validation = 'validation="true"';}else{var validation = 'validation="false"';}
                                        inputs += '<div class="form-group"><label for="'+item.name+'">'+item.label+'</label><input class="form-control" '+validation+' '+pattern+' type='+item.dataType+' name='+item.name+' '+minLength+' '+maxLength+' '+required+' data-toggle="tooltip" title="'+item.note+'"/><div class="help-block with-errors"></div></div>';  
                                    } 
                                });
                                inputs +='<div class="form-action"><button class="btn btn-primary btnsubmit" type="submit" value="submit">Submit</button></div></form>';
                                BootstrapDialog.show({
                                    title: currentAction.label,
                                    message: inputs,
                                    onshown :function(dialogRef){
                                        $('.form-control').tooltip({'placement':"right",'container':'body'});
                                        $('#actionForm').validator({message: 'This value is not valid'});
                                        $('.form-control').change(function(){
                                            if($(this).parent('.form-group').hasClass('has-error has-danger') === false){
                                                var validField = $(this).attr('name');
                                                var fieldVal = $(this).val();
                                                $('[name='+validField+']').parent('.form-group').find('.help-block').html('');
                                                if(fieldVal && ($(this).attr('validation') == "true")){
                                                    $.each(currentAction['input-parameters'],function(j,item){
                                                        if((validField === item.name) && item['dynamic-field-validation']){
                                                            item['dynamic-field-validation'].parameters.name = validField;
                                                            item['dynamic-field-validation'].parameters.value = fieldVal;
                                                            $.ajax({
                                                                type: item['dynamic-field-validation'].method,
                                                                url: item['dynamic-field-validation'].url,
                                                                data:item['dynamic-field-validation'].parameters,
                                                                success: function (response) {
                                                                    var response = JSON.parse(response);
                                                                    if(response.status == "error"){
                                                                        $('[name='+validField+']').parent('.form-group').addClass('has-error has-danger');
                                                                        $('[name='+validField+']').parent('.form-group').find('.help-block').html(response.message);
                                                                        $('#actionForm').find('.btnsubmit').addClass('disabled');
                                                                    }
                                                                },
                                                                error: function () {
                                                                    $('[name='+validField+']').parent('.form-group').addClass('has-error has-danger');
                                                                }
                                                            });
                                                        }
                                                    })  
                                                }  
                                            }
                                        })
                                        $("#actionForm").submit(function(e){
                                            e.preventDefault();
                                            currentAction.parameters.formData =  $(this).serializeArray();
                                            submitFormAction(currentAction.parameters,currentAction['action-method'],currentAction['action-type'],currentAction['action-url']);
                                            dialog.close();
                                        });
                                    }
                                });
                            }
                            else{
                                submitFormAction(currentAction.parameters,currentAction['action-method'],currentAction['action-type'],currentAction['action-url']);
                                dialog.close();
                            }
                        }
                        }, {
                        label: 'Cancel',
                        action: function(dialog) {
                            dialog.close();
                        }
                        }]
                    });
                }else{
                    if(currentAction['input-parameters']){
                        $.each(currentAction['input-parameters'],function(j,item){
                            if(item.required == "true") {var required ='required="'+item.required+'"';}else{var required = "";}
                            if(item['allowed-pattern']) {var pattern ='pattern='+item['allowed-pattern']+'';}else{var pattern = "";}
                            if(item.maxLength) {var maxLength ='maxlength='+item.maxLength+'';}else{var maxLength = "";}
                            if(item.minLength) {var minLength ='minlength='+item.minLength+'';}else{var minLength = "";}
                            if(item['dynamic-field-validation']){ var validation = 'validation="true"';}else{var validation = 'validation="false"';}
                            if(item.dataType == "text"){
                                inputs += '<div class="form-group"><label for="'+item.name+'">'+item.label+'</label><input class="form-control" '+validation+' '+pattern+' type='+item.dataType+' name='+item.name+' '+minLength+' '+maxLength+' '+required+' data-toggle="tooltip" title="'+item.note+'"/><div class="help-block with-errors"></div></div>';  
                            }else if(item.dataType == "list"){
                                if(item['allowed-values']){
                                    var options = "<option value=''>Select "+item.label+"</option>";
                                    $.each(item['allowed-values'],function(li,listItem){
                                        if(item.defaultValue &&(item.defaultValue == listItem.value)){var selected = 'selected';}else{var selected = "";}
                                        options += '<option value='+listItem.value+' '+selected+'>'+listItem.text+'</option>';
                                    })
                                }
                                inputs += '<div class="form-group"><label for="'+item.name+'">'+item.label+'</label><select class="form-control" '+validation+' '+pattern+' type='+item.dataType+' name='+item.name+' '+minLength+' '+maxLength+' '+required+' data-toggle="tooltip" title="'+item.note+'">'+options+'</select><div class="help-block with-errors"></div></div>';   
                            } else if(item.dataType == "list-multi-select"){
                                if(item['allowed-values']){
                                    var options = "<option value=''>Select "+item.label+"</option>";
                                    $.each(item['allowed-values'],function(li,listItem){
                                        if(item.defaultValue &&(item.defaultValue == listItem.value)){var selected = 'selected';}else{var selected = "";}
                                        options += '<option value='+listItem.value+' '+selected+'>'+listItem.text+'</option>';
                                    })
                                }
                                if(item['dynamic-value-request']){
                                    var data ='{"parameters":{';
                                    $.each(item['dynamic-value-request']['parameters'],function(d,itm){
                                       data += '"'+d+'":"'+itm+'",';
                                    })
                                    data = data.substring(0,data.length - 1);
                                    data +='}}';
                                    var fields = {data: data, method: item['dynamic-value-request']['method'], type : item['dynamic-value-request']['type'], url : item['dynamic-value-request']['url']};
                                    $.ajax({  
                                        type: "POST",  
                                        url: '/cms/resource-action',
                                        data: fields,
                                        dataType: 'json',
                                        error: function(error){

                                        },
                                        success: function(data) {
                                            $('[name="instanceNames"]').prop('disabled',false);
                                            $('[name="instanceNames"]').parents('.multiselect-native-select').find('button.multiselect').removeClass('disabled').prop('disabled',false);
                                            if(data['field-values']){
                                                $.each(data['field-values'],function(i,v){
                                                if(item.defaultValue &&(item.defaultValue == v.id)){var selected = 'selected';}else{var selected = "";}
                                                    options += '<option value='+v.id+' '+selected+'>'+v.value+'</option>';
                                                })
                                                $('#multiselect-list').html(options);
                                                $('[name="instanceNames"]').multiselect('rebuild');
                                                $("button.multiselect").on("click",function(){
                                                    $(this).parent().addClass("open");
                                                })
                                            }else{
                                                $('#multiselect-list').parents('.form-group').find('.help-block').html(data['error-message']);
                                                $('#multiselect-list').parents('.form-group').addClass('has-error has-danger');
                                            }
                                        }
                                    });
                                }
                                
                                inputs += '<div class="form-group"><label for="'+item.name+'">'+item.label+'</label><select disabled="true" multiple="true" id="multiselect-list" class="form-control" '+validation+' '+pattern+' type='+item.dataType+' name='+item.name+' '+minLength+' '+maxLength+' '+required+' data-toggle="tooltip" title="'+item.note+'"><option value="">test</option>'+options+'</select><div class="help-block with-errors"></div></div>';   
                            }
                        });
                        inputs +='<div class="form-action"><button class="btn btn-primary btnsubmit" type="submit" value="submit">Submit</button></div></form>';
                        if(currentAction.note){ note = currentAction.note +'<br><br>';}
                        BootstrapDialog.show({
                            title: currentAction.label,
                            message: note + inputs,
                            onshown :function(dialogRef){
                                $('.form-control').tooltip({'placement':"right",'container':'body'});
                                $('[name="instanceNames"]').multiselect();
                                $('#actionForm').validator({message: 'This value is not valid'});
                                $('.form-control').change(function(){
                                            if($(this).parent('.form-group').hasClass('has-error has-danger') === false){
                                                var validField = $(this).attr('name');
                                                var fieldVal = $(this).val();
                                                $('[name='+validField+']').parent('.form-group').find('.help-block').html('');
                                                if(fieldVal && ($(this).attr('validation') == "true")){
                                                    $.each(currentAction['input-parameters'],function(j,item){
                                                        if((validField === item.name) && item['dynamic-field-validation']){
                                                            item['dynamic-field-validation'].parameters.name = validField;
                                                            item['dynamic-field-validation'].parameters.value = fieldVal;
                                                            $.ajax({
                                                                type: item['dynamic-field-validation'].method,
                                                                url: item['dynamic-field-validation'].url,
                                                                data:item['dynamic-field-validation'].parameters,
                                                                success: function (response) {
                                                                    var response = JSON.parse(response);
                                                                    if(response.status == "error"){
                                                                        $('[name='+validField+']').parent('.form-group').addClass('has-error has-danger');
                                                                        $('[name='+validField+']').parent('.form-group').find('.help-block').html(response.message);
                                                                        $('#actionForm').find('.btnsubmit').addClass('disabled');
                                                                    }
                                                                },
                                                                error: function () {
                                                                    $('[name='+validField+']').parent('.form-group').addClass('has-error has-danger');
                                                                }
                                                            });
                                                        }
                                                    })  
                                                }  
                                            }
                                        })
                                $("#actionForm").submit(function(e){
                                    e.preventDefault();
                                    if($(this).find('.has-error').length==0){
                                        $('.modal').modal('toggle');
                                        currentAction.parameters.formData =  $(this).serializeArray();
                                        submitFormAction(currentAction.parameters,currentAction['action-method'],currentAction['action-type'],currentAction['action-url']);
                                    }
                                });
                            }
                        });
                    }else{
                       submitFormAction(currentAction.parameters,currentAction['action-method'],currentAction['action-type'],currentAction['action-url']);
                    } 
                }
            }
        })
    })
    function submitFormAction(data,method,type,url){
        if(type == "url"){
            url = '/jsdn'+url;
            var hiddenForm = '<form id="actionSubmitForm" method="'+method+'" action="'+url+'">';
            $.each(data,function(i,v){
                hiddenForm += '<input type="hidden" name="'+i+'" value="'+v+'" />'
            })
            hiddenForm += '</form>';
            $('body').append(hiddenForm);
            $('#actionSubmitForm').submit();   
        }else{
            $('body').append('<div class="loading"></div>');
            var dataItems ='{"parameters":{';
            $.each(data,function(d,itm){
               dataItems += '"'+d+'":"'+itm+'",';
            })
            dataItems = dataItems.substring(0,dataItems.length - 1);
            dataItems +='}}';
            var fields = {data: dataItems, method: method, type : type, url : url,actiontype: topAction};
            $.ajax({  
                type: "POST",  
                url: '/cms/resource-action',
                data: fields,
                dataType: 'json',
                beforeSend: function(){

                },
                error: function(error){

                },
                success: function(data) {
                    if(data.status === 'error'){
                        $('.loading').remove();
                        $('.messages').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" aria-label="close">&times;</a><strong> </strong>'+data['error-message']+'</div>');
                        $('html, body').animate({
                            scrollTop: $(".alert").offset().top
                        }, 1000);
                    }
                    else if(data.status === "success"){
                        if(topAction == true){
                            var url = "/cms/resource-summary";
                            $(location).attr('href',url);
                        }else{
                            $('.loading').remove();
                            $('.messages').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" aria-label="close">&times;</a><strong> </strong>'+data['success-message']+'</div>');                  
                            $('html, body').animate({
                            scrollTop: $(".alert").offset().top
                        }, 1000);
                        }
                    }else{
                        $('.loading').remove();
                        $('.messages').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" aria-label="close">&times;</a><strong> </strong>'+Drupal.t('Could not complete the request currently. Please try again later')+'</div>');
                        $('html, body').animate({
                            scrollTop: $(".alert").offset().top
                        }, 1000);
                    }
                    $('.alert .close').click(function(e){
                        e.preventDefault();
                        $(this).parent('div.alert').slideToggle();
                    });
                }
            });
        }
    }
})
})( jQuery );