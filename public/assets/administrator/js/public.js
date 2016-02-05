        
        function isCheck(_name){
            var items=document.getElementsByName(_name);
            for(i=0;i<items.length;i++){
            if(items[i].checked){
                return true;
                }
            }
           return false;
        }
        
        function getArray(_name){
            var result = new Array();
            $('input[name="cate[]"]:checked').each(function() {
               result.push(this.value); 
            });
            
            return result;
        }
        
        function checkAll(){
			var masCheck= document.getElementById('all');
			var itemsCheck=document.getElementsByName('vl_check[]');
			if(masCheck.checked==true){
					for(i=0;i<itemsCheck.length;i++){
							itemsCheck[i].checked=true;
					}
			}else{
				for(i=0;i<itemsCheck.length;i++){
							itemsCheck[i].checked=false;
					}
			}
	    }
        
        function dropmb(){
			if(isCheck('vl_check[]')==false){
					bootbox.alert("Please check least 1 row");
					return false;
			}else{
				if(confirm("Xác nhận (Y/N)?") == false){
					return false;
				}
			}
	    }
        function del_item(_url){
            bootbox.confirm("Delete this row (Y/N)?", function (result) {
                if(result)
                {
                    window.location.href= _url;
                }
            });
        }
        
        $(function(){
           $('.s_available').change(function(){
               var class_name = $(this).val();
               if(class_name == '1')
               {
                    $('.1-2-show').show();
                    $('.1-show').show();
                    
                    
               } 
               else if(class_name == '2')
               {
                    $('.1-2-show').show();
                    $('.1-show').hide();
                    
                    
               }
           }); 
        });