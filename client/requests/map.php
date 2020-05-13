<?php
session_start();

if($_SESSION['id']==NULL || $_SESSION['u_id']==NULL) {

    header("Location: ../../index.php");
}
include_once("../others/config.php");
 include_once("../../includes/endyn.php");
//$myid=$_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MAP</title>
  <style>
    #map{
      height:400px;
      width:100%;
    }
  </style>
</head>
<body>
  <h1>Borrower Location</h1>
  <div id="map"></div>
	
	<?php
	$decode=$_GET['id'];
	//echo $decode;
	$decrypted = my_simple_crypt( $decode, 'd' );
	$dypid=$decrypted;
	//echo $dypid;
	//return;
	$sql="SELECT * from location where user_id=$dypid";
	$result = mysqli_query($con,$sql);
	  $res = mysqli_fetch_array($result);         
            echo "<tr>";          
			GLOBAL $a;
			GLOBAL $b;
			$a=$res['latitude'];
			$b=$res['longitude'];
	
			//echo "<td>".$res['latitude']."</td>";
			//echo "<td>".$res['longitude']."</td>";
	
	  
		$sql1="SELECT * from users where id=$dypid";
		$result1 = mysqli_query($con,$sql1);
		$res1 = mysqli_fetch_array($result1); 
		$name=$res1['first_name']." ".$res1['last_name'];
	
	
	?>

  <script>
    function initMap(){
      // Map options
      var options = {
        zoom:8,
        center:{lat:23.3601,lng:90.0589}
        //center:{lat:<?php echo $a;?>,lng:<?php echo $b; ?>}
      }

      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);

      // Listen for click on map
      google.maps.event.addListener(map, 'click', function(event){
        // Add marker
        addMarker({coords:event.latLng});
      });
	
		

      // Array of markers
      var markers = [
    
        {
          coords:{lat:<?php echo $a;?>,lng:<?php echo $b; ?>},
          content:'<h5><?php echo $name;?></h5>'
        }
       
      ];

      // Loop through markers
      for(var i = 0;i < markers.length;i++){
        // Add marker
        addMarker(markers[i]);
      }

      // Add Marker Function
      function addMarker(props){
        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          //icon:props.iconImage
        });

        // Check for customicon
        if(props.iconImage){
          // Set icon image
          marker.setIcon(props.iconImage);
        }

        // Check content
        if(props.content){
          var infoWindow = new google.maps.InfoWindow({
            content:props.content
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });
        }
      }
    }
  </script>
  <script async defer
    src="your_api_key">
    </script>
</body>
</html>
