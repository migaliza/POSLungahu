<?php
$cmd=$_REQUEST['cmd'];
switch($cmd)
{
        //add items to the database
    case 1:

        $DB_HOST="localhost";
        $DB_NAME="csashesi_beatrice-lungahu";
        $DB_USER="csashesi_bl16";
	$DB_PWORD="db!hiJ35";
		
	$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
	if($link==false){
            echo "not succesfull";
	}

	$barcode=$_REQUEST['barcode'];
	$product = $_REQUEST['product'];
	$price=$_REQUEST['price'];
	$description=$_REQUEST['Description'];
		
	$str_query="INSERT INTO MwebPoS (barcode,productName,price,Desciption) VALUES('$barcode','$product','$price','$description')";

	if(mysqli_query($link,$str_query)){
            echo '{"result":1,"message": "SUCCESFULLY ADDED"}';
	}else
	{
            echo '{"result":0,"message": "unsuccessful"}';
	}
		
        break;
            
        //this displays the content added to the database
    case 2:
        $DB_HOST="localhost";
		$DB_NAME="csashesi_beatrice-lungahu";
		$DB_USER="csashesi_bl16";
		$DB_PWORD="db!hiJ35";
		
		$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
		if($link==false){
			echo "not succesfull";
		}
		
                
		$str_query="SELECT * FROM  MwebPoS";
		$result=mysqli_query($link,$str_query);
             $row=mysqli_fetch_assoc($result);
        echo '{"result":1,"values":[';	//start of json object
	   while($row){
		  echo json_encode($row);			//convert the result array to json object
		  $row=$result->fetch_assoc();
		  if($row){
			 echo ",";					//if there are more rows, add comma 
		  }
	   }
	   echo "]}";
    break;
       
    //this display the price and product name of a particular product gievn the id
    case 3:
        $DB_HOST="localhost";
		$DB_NAME="csashesi_beatrice-lungahu";
		$DB_USER="csashesi_bl16";
		$DB_PWORD="db!hiJ35";
		
		$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
		if($link==false){
			echo "not succesfull";
		}
		$productID=$_REQUEST['Product_id'];
                $str_query="SELECT productName,Price FROM MwebPoS WHERE Product_id='$productID'";
                
		
		$result=mysqli_query($link,$str_query);
                $row=mysqli_fetch_assoc($result);
        echo '{"result":1,"data":[';	//start of json object
	   while($row){
		  echo json_encode($row);			//convert the result array to json object
		  $row=$result->fetch_assoc();
		  if($row){
			 echo ",";					//if there are more rows, add comma 
		  }
	   }
	   echo "]}";
           
           mysqli_query($link,"DELETE FROM MwebPoS WHERE Product_id='$productID'") or die (mysqli_error());
          
           
           
    break;
    case 4:
        $DB_HOST="localhost";
	$DB_NAME="csashesi_beatrice-lungahu";
	$DB_USER="csashesi_bl16";
	$DB_PWORD="db!hiJ35";
		
	$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
	if($link==false){
		echo "not succesfull";
	}
	$phoneNo=$_REQUEST['phoneNo'];
        $totalAmountSpend=$_REQUEST['gross'];
        $str_query="INSERT INTO MwebPoSsell(phoneNo,price) VALUES($phoneNo,$totalAmountSpend)";
  
	//$result=mysqli_query($link,$str_query);

        if(mysqli_query($link,$str_query)){
            echo '{"result":1,"message": "SUCCESFULLY ADDED"}';
	}else
	{
            echo '{"result":0,"message": "unsuccessful"}';
	}
         $amountspend=(double)$totalAmountSpend;
        if($amountspend>=500){
            echo $amountspend;
            
            
            ob_start();
            $url = "https://api.smsgh.com/v3/messages/send?"
            . "From=BMI%20GENERAL%20TRADERS"
            . "&To=%2B$phoneNo"
            . "&Content=You%20receive%20a%20ten%20percent%20discount%20on%20your%20next%20purchase"
            . "&ClientId=odfbifrp"
            . "&ClientSecret=rktegnml"
            . "&RegisteredDelivery=true";
            // Fire the request and wait for the response
            //$myUrl=   urlencode().($url);
              file_get_contents($url,null,null);
             //var_dump($response);
             ob_end_clean();
              
              
        }
        break;
        
    case 5:
        $DB_HOST="localhost";
	$DB_NAME="csashesi_beatrice-lungahu";
	$DB_USER="csashesi_bl16";
	$DB_PWORD="db!hiJ35";
		
	$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
	if($link==false){
		echo "not succesfull";
	}
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        
        $query = mysqli_query($link,"SELECT * from login WHERE password='$password' AND username='$username'");
        if($query){
            echo '{"result":1,"message": "SUCCESFULLY ADDED"}';
	}else
	{
            echo '{"result":0,"message": "unsuccessful"}';
	}
        break;
        
       case 6:
        $DB_HOST="localhost";
		$DB_NAME="csashesi_beatrice-lungahu";
		$DB_USER="csashesi_bl16";
		$DB_PWORD="db!hiJ35";
		
		$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
		if($link==false){
			echo "not succesfull";
		}
		
                
		$str_query="UPDATE * FROM  MwebPoS WHERE Product_id='$productID'";
		$result=mysqli_query($link,$str_query);
             $row=mysqli_fetch_assoc($result);
        echo '{"result":1,"values":[';	//start of json object
	   while($row){
		  echo json_encode($row);			//convert the result array to json object
		  $row=$result->fetch_assoc();
		  if($row){
			 echo ",";					//if there are more rows, add comma 
		  }
	   }
	   echo "]}";
    break;
}
?>