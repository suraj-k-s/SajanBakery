<?php
include("../Assets/Connection/Connection.php");
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>USER VIEW REQUEST</title>
</head>
<?php
include("Head.php");
?>
<body>
<h1>MY ORDERS</h1>
<br>
<br>
<table border="2">
  <tbody>
    <tr>
        <td>SL NO</td>
        <td>REQUEST DATE</td>
        <td>FOR DATE</td>
        <td>SHAPE</td>
        <td>CATEGORY</td>
        <td>WEIGHT</td>
        <td>ICING</td>
        <td>COLOR</td>
        <td>TOPPING</td>
        <td>DELIVERY ADDRESS</td>
		    <td>DETAILS</td>
        <td>DELIVERY TIME</td>
        <td>IMAGE</td>
        <td>CONTACT</td>
		    <td>STATUS</td>
    </tr>
	  
	  <?php 
		$i=0;
		$selqry="SELECT * FROM `tbl_request` r inner join tbl_user u on u.user_id=r.user_id inner join tbl_shape s on s.shape_id=r.shape_id inner join tbl_category c on c.category_id=r.category_id where u.user_id=$_SESSION[uid] and request_status>0";
		$res=$con->query($selqry);
		while($data=$res->fetch_assoc())
		{
			
		$i++;
      	?>	
    <tr>
		<td><?php echo $i; ?> </td> 
        <td><?php echo $data['request_date'] ?></td>
        <td><?php echo $data['request_fordate'] ?></td>
        <td><?php echo $data['shape_name'] ?></td>
        <td><?php echo $data['category_name'] ?></td>
        <td><?php echo $data['request_kg'] ?></td>
        <td><?php 
          if($data['icing_id']!=0)
          {
            $selIce="SELECT * FROM `tbl_icing` where icing_id ='".$data['icing_id']."'";
		        $resIce=$con->query($selIce);
		        $dataIce=$resIce->fetch_assoc();
            echo $dataIce["icing_name"];
          }
          else{
            echo "Complementary";
          }
        ?></td>
        <td><?php 
          if($data['color_id']!=0)
          {
            $selCol="SELECT * FROM `tbl_color` where color_id='".$data['color_id']."'";
		        $resCol=$con->query($selCol);
		        $dataCol=$resCol->fetch_assoc();
            echo $dataCol["color_name"];
          }
          else{
            echo "Complementary";
          }
        ?></td>
        <td>
        <?php 
          if($data['topping_id']!=0)
          {
            $selTop="SELECT * FROM `tbl_topping` where topping_id='".$data['topping_id']."'";
		        $resTop=$con->query($selTop);
		        $dataTop=$resTop->fetch_assoc();
            echo $dataTop["topping_name"];
          }
          else{
            echo "Complementary";
          }
        ?>
        </td>
        <td><?php echo $data['delivery_location'] ?></td>
 		    <td><?php 
        if($data['request_details']==0)
        {
          echo "Nothing Default";
        }
        else
        {
          echo $data['request_details'];
        } 
        ?></td>
	      <td><?php echo $data['delivery_time'] ?></td>
	      <td>
          <?php
            if($data['request_image']=="Image Not Found")
            {
                echo "Image Not Found";
            }
            else{
              ?>
                <a href="../Assets/Files/Request/<?php echo $data['request_image'] ?>" target="_blank">
                  <img src="../Assets/Files/Request/<?php echo $data['request_image'] ?>" width="80" height="80" />
                </a>
              <?php
            }
          ?>
        </td>
		    <td><?php echo $data['delivery_contact'] ?></td>
		    <td>
            <?php
                  if($data['request_status']=="1")
                  {
                    echo "Order Placed";
                  }
                  else if($data['request_status']=="2")
                  {
                    echo "Order Processing";
                  }
                  else if($data['request_status']=="3")
                  {
                    echo "Order Ready To Deliver";
                  }
                  else if($data['request_status']=="4")
                  {
                    echo "Order Completed";
                  }

              ?>  



        </td>	
					
      </tr>
	  <?php } ?>
</table>
<?php
include("Foot.php");
?>
</body>
</html>