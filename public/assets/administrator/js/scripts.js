
    $(function()
    {
        $('.selectpicker').selectpicker();
        
        var domain = $('#domain').val();
        
        var initUploader = function () {
        $(".upload_images").pluploadQueue({
            // General settings
    		runtimes : 'html5',
    		url : domain+'/insert',
    		chunk_size : '1mb',
    		unique_names : true,
            
            multipart_params : {
                
            },
    		
    		filters : {
    			max_file_size : '1mb',
    			mime_types: [
    				{title : "images files", extensions : "jpg,png,jpeg,gif"}
    			]
    		},
    		// Resize images on clientside if we can
    		resize : {width : 750, height : 750, quality : 90},
    
            init: {
    
                FilesAdded: function (up, files) {
                    var max_files = 5;
                    var i = 0;
                    if (up.files.length > max_files) {
                        alert('Chỉ được up ' + max_files + ' file.');
                    }
                    plupload.each(files, function(file) {
                        if (up.files.length > max_files) {
                            up.removeFile(file);
                        }
                    });
                },
                UploadComplete: function (up, files) {
                    $('#pname').focus();
                    $('.upload-div .alert-success').removeClass('display-none');
                    // destroy the uploader and init a new one
                    up.destroy();
                    setTimeout(function(){
                        if($('#status').val() == 0)
                        {
                            /*input text*/
                            /*$('.item-text-value').each(function (){
                                $(this).val('');
                            });*/
                            /*select box*/
                            /*text area*/
                            /*for(i=0; i < tinymce.editors.length; i++){
                                tinymce.editors[i].setContent('');
                            }*/
                            /*check box*/
                            location.reload();
                        }
                        initUploader();
                    }, 3500);
                    setTimeout(function(){$('.upload-div .alert-success').addClass('display-none');}, 3000);
                }
            }
        });
        var uploader = $('.upload_images').pluploadQueue();
        
        uploader.bind('BeforeUpload', function(up, files) {
            tinyMCE.triggerSave();
            console.log($("#categories").val());
            uploader.settings.multipart_params.categories  = $("#categories").val();
            uploader.settings.multipart_params.pname       = $("#pname").val();
            uploader.settings.multipart_params.ptype       = $("#ptype").val();
            uploader.settings.multipart_params.pstatus     = $("#pstatus").val();
            uploader.settings.multipart_params.pfeature    = $("#pfeature:checked");
            
            uploader.settings.multipart_params.phot        = $("#phot:checked");         
            uploader.settings.multipart_params.pqty        = $("#pqty").val();
            uploader.settings.multipart_params.ppreprice   = $("#ppreprice").val();
            uploader.settings.multipart_params.pbuyprice   = $("#pbuyprice").val();

            var brande   = $('#pbrande-custom').val() ? $('#pbrande-custom').val() : $("#pbrande").val();
            uploader.settings.multipart_params.pbrande     = brande;

            var colors   = $('#pcolors-custom').val() ? $('#pcolors-custom').val() : $("#pcolors").val();
            uploader.settings.multipart_params.pcolors     = colors;

            var material = $('#pmaterials-custom').val() ? $('#pmaterials-custom').val() : $("#pmaterials").val();
            uploader.settings.multipart_params.pmaterials  = material;

            var styles   = $('#pstyles-custom').val() ? $('#pstyles-custom').val() : $("#pstyles").val();
            uploader.settings.multipart_params.pstyles     = styles;

            var uses     = $('#puses-custom').val() ? $('#puses-custom').val() : $("#puses").val();
            uploader.settings.multipart_params.puses       = uses;

            var seasons  = $('#pseasons-custom').val() ? $('#pseasons-custom').val() : $("#pseasons").val();
            uploader.settings.multipart_params.pseasons    = seasons;

            var sizes    = $('#psizes-custom').val() ? $('#psizes-custom').val() : $("#psizes").val();
            uploader.settings.multipart_params.psizes      = sizes;

            uploader.settings.multipart_params.psale       = $("#psale").val();
            uploader.settings.multipart_params.psortdesc   = $("#psortdesc").val();
            uploader.settings.multipart_params.pattributes = encodeURIComponent($("#pattributes").val());
            uploader.settings.multipart_params.fulldesc    = encodeURIComponent($("#fulldesc").val());

            /*ADD || UPDATE*/
            uploader.settings.multipart_params.Status      = $("#status").val();

        });
        
        // add initialIndex property on new files, starting index on previous queue size
        uploader.bind('FilesAdded', function(up,files){
            for(var i = 0, upPreviousSize = up.files.length - files.length, size = files.length; i<size; i++)
            {
                files[i]["initialIndex"] = i +upPreviousSize ;
            }
            //console.log(up.files);
        });
        
        
            // remove the 'holes' in the sequence when removing files 
            // (if not, next files adding would introduce duplicate initialIndex)
            uploader.bind('FilesRemoved', function(up,files){
            // process removed files by initialIndex descending
            var sort = function(a,b){return b.initialIndex - a.initialIndex;};
            files.sort(sort);
            for(var i = 0, size = files.length; i<size; i++)
            {
                $('.'+files[i].id).remove();
                var removedFile = files[i];
                // update the remaining files indexes
                for (var j =0, uploaderLength = up.files.length; j<uploaderLength; j++)
                {
                    var remainingFile = up.files[j];
                    if(remainingFile["initialIndex"] >  removedFile["initialIndex"])
                    remainingFile["initialIndex"]--;
                }
            }           
            //console.log(up.files);
        });
    };
    
    $(document).ready(function(){initUploader();});
    
    });
    
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
   
    /** Function check Query Name UNQ*/  
    $('#pname').keyup(function(){
        var domain = $('#domain').val();
        var pname  = $('#pname').val();
        if($('#status').val() == 0)
        {
            delay(function(){
                $.ajax({
                type: "POST",
        			url: domain+'/checkname' ,
        			data: "pname="+pname,
        			success: function(answer) {
                        
                        if(answer == 'error')
                        {
                            $('#pname').focus();
                            $('#pname').addClass('error_name_unq');
                            bootbox.alert('Tên bị trùng. Vui lòng nhập tên khác.');
                        }   
                        else
                        {
                            $('#pname').removeClass('error_name_unq');
                        }
                                        
        			},
        			error: function() {
        				//window.location("del-img.php?opt=del&id="+idimg+"name="+name);
        			}
       		  });
            }, 700 );
        }
        else
        {
            var SongId = $('#pname').attr('songid');
            delay(function(){
                $.ajax({
                type: "POST",
        			url: domain+'index.php/music/checkname_update' ,
        			data: "SongName="+SongName+"&SongId="+SongId+"&ArtistName="+ArtistName+"&ComposerName="+ComposerName+"&CountryCode="+CountryCode,
        			success: function(answer) {
                        
                        if(answer == 'error')
                        {
                            $('#pname').focus();
                            $('#pname').addClass('error_name_unq');
                            bootbox.alert('Tên bị trùng. Vui lòng nhập tên khác.');
                        }   
                        else
                        {
                            $('#pname').removeClass('error_name_unq');
                        }
                                        
        			},
        			error: function() {
        				//window.location("del-img.php?opt=del&id="+idimg+"name="+name);
        			}
       		  });
            }, 700 );
        }
    });

    /* Function Remove a image off item*/
    $('.remove-img-item').on('click', function (){
        var domain  = $('#domain').val();
        var itemId  = $(this).attr('itemId');
        var imgName = $(this).attr('imgName');

        $.ajax({
            type: "POST",
            url: domain+'/removeFile' ,
            data: 'id='+itemId+'&v='+imgName,
            success: function(answer) {
                
                if(answer == 'error')
                {
                    bootbox.alert('Xóa file lỗi, vui lòng thử lại.');
                    delay(function(){location.reload();}, 3000);
                    
                }   
                else
                {
                    bootbox.alert('Xóa file thành công');
                }

            },
            error: function() {
                bootbox.alert('Xóa file lỗi, vui lòng thử lại.');
                delay(function(){location.reload();}, 3000);
            }
        });
    });

    $('.btn-upload-file').on('change', function (){
        $(".upload-file-info").html($(this).val());
    });

    $('body').on('click', '.reply-review', function (e) {
        var item_id   = $(this).attr('item_id');
        var parent_id = $(this).attr('parent_id');
        bootbox.dialog({
            title: "Reply this review.",
            message: '  ' +
                '<div class="col-md-12"> ' +
                '<form id="submit-reply-review" class="form-horizontal" action="" method="POST"> ' +
                '<div class="form-group"> ' +
                '<textarea class="" name="reply-comment" style="width: 98%;" rows="5"></textarea>' +
                '</div>' +
                '<input type="hidden" name="item_id" value="'+item_id+'">' +
                '<input type="hidden" name="parent_id" value="'+parent_id+'">' +
                '</form> </div> ',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-success",
                    callback: function() {
                        $('#submit-reply-review').submit();
                    }
                }
            }
            }
        );
    });