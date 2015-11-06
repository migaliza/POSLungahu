/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//loading values to page one
            function login(){
                
                var userName = $("#username").val();
                var  password = $("#password").val();
                var stringV = "username="+userName+"&password="+password;
                var theUrl="request.php?cmd=5&"+stringV;
                var obj5 = sendRequest(theUrl);
            
                if(obj5.result==1){
                    
                    window.location.href="#pagetwo";
                }
                else{
       
                }

            }
            
        $(document).on("pagecreate","#pagetwo",function(){
		var theUrl = "request.php?cmd=2";

			var obj=sendRequest(theUrl);

			if(obj.result==1){
                            //alert(obj.result);

			var row;
			
			$.each(obj.values,function(i,value){
				row+="<li data-role='list-divider'  data-theme='d' data-divider-theme='a'>"+value.productName+"</li>"+
                                        "<li><p>"+"Barcode:"+"<strong>"+value.barcode+"</p>"+
                                        "<p>"+"Price: "+value.Price+"<p>"+
                                        "<p>"+"Description: "+value.Desciption+"</p></li>"
			});

			$("#inventory").append(row);
                        $("#inventory").listview("refresh");
                        }
		});
                
            //send response when url is passed
            function sendRequest(u){
                    var obj=$.ajax({url:u,async:false});
                     var result=$.parseJSON(obj.responseText);
                    return result;
                                
		}
                
                  //cordova function to scan
            
            function scanBarcode(){
		cordova.plugins.barcodeScanner.scan(
			function (result) {
                            $("#barcode").val(result.text)
                        },
                            function (error) {
				alert("Scanning failed: " + error);
                            }
		);
            }
            
            //save all transaction
            function saveTransaction(){
                $("#submitTransaction").click(function(ev){
                  ev.preventDefault();
                var phoneNo=$("#phoneNo").val();
                var grosspay=$("#gross").val();
                var transaction="gross="+grosspay+"&phoneNo="+phoneNo;
                var theUrl="http://cs.ashesi.edu.gh/~csashesi/class2016/beatrice-lungahu/MobileWeb/AppPointofSale/request.php?cmd=4&"+transaction;
                var obj3 = sendRequest(theUrl);
             
           
                if(obj3.result==1){
                    
                    $('#messageTransaction').text(obj3.message);
                    $('#messageTransaction').show();
                }
                else{
                    $('#messageTransaction').text(obj3.message);
                    $('#messageTransaction').css("backgroundColor","red");
                }
                });
                
            }
         
              function saveInventory(){

               $("#save_inventory").click(function(ev){
                    ev.preventDefault();
                    
                    var barcode = $("#barcode").val();
                    var product = $("#product").val();
                    var price = $("#price").val();
                    var description = $("#description").val();
                    var stringVal = "barcode="+barcode+"&product="+product+"&price="+price+"&Description="+description;
                    var theUrl ="request.php?cmd=1&"+stringVal;
                    var obj = sendRequest(theUrl);

                    if(obj.result==1)
                    {
			$('#showMessage').text(obj.message);
			$('#showMessage').show();
                    }
                    else
                    {
			$('#showMessage').text("Error adding");
			$('#showMessage').css("backgroundColor","red");
                    }

		});
                }
            
            //loading itemd to page three
            $(document).on("pagecreate","#pagefour",function(){
		var theUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/beatrice-lungahu/MobileWeb/AppPointofSale/request.php?cmd=2";

			var obj=sendRequest(theUrl);
		
			if(obj.result==1){
                            var totalAmount=0;

                            var list="";
                             var prdctID=""
			$.each(obj.values,function(i,value){
                            prdctID=value.Product_id;
                            //alert(prdctID);
				list+='<li><a href="#" class="details" id='+prdctID+'>'+value.productName+'</a></li>';
			});
	
			$("#itemsBought").append(list).promise().done(function(){
				$(this).on("click",".details",function(e){
                                    e.preventDefault();
                                    var theUrl2="http://cs.ashesi.edu.gh/~csashesi/class2016/beatrice-lungahu/MobileWeb/AppPointofSale/request.php?cmd=3&Product_id="+this.id;
                                    var obj2 = sendRequest(theUrl2);
   
                                     var row="";
                                          $.each(obj2.data,function(i,value){
                                              row+='<tr><td>'+value.productName+'</td><td>'+value.Price+'</td></tr>';
                                              var valuePrice=parseFloat(value.Price);
                                              totalAmount+=valuePrice;
                                          })
                                          $("tbody").append(row);
				});
				$("#itemsBought").listview("refresh");
			});
                        $("#grossAmount").click(function(ev){
                            ev.preventDefault();
                            $("#gross").val(totalAmount);
                            
                        });
                        }
		});
                     
                /*move to the nnext page*/
		function navigateView() {
                    
			$.mobile.changePage("#pagethree");
                        
                    
		}

		/*move to the nnext page*/
		function navigateHome() {
                        
			$.mobile.changePage("#pagetwo");
		}
                
                function navigatethree() {
                       
			$.mobile.changePage("#pagefour");
		}
                
                $(function(){
                    saveInventory();
                });
		

