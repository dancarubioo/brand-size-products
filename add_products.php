<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" class="tip-bottom"><i class="icon-home"></i>
            Add New Products</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add New Products</h5>
        </div>

        <div class="widget-content nopadding">
          <form name="form1" action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Select company </label>
              <div class="controls">
                <select class="span11" name="company_name">
                        <?php 
                        $res = mysqli_query($link, "SELECT *
                                                    FROM company_name");
                        while($row = mysqli_fetch_array($res)){
                            echo "<option>";
                            echo $row["company_name"];
                            echo "</option>";
                        }
                        ?>
                </select>
              </div>
            </div>

        <div class="widget-content nopadding">
          <form name="form1" action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Enter product name </label>
              <div class="controls">
                <input type="text" class="span11" name="product_name" placeholder="Enter product name">
              </div>
            </div>

        <div class="control-group">
            <label class="control-label">Select unit </label>
              <div class="controls">
                <select class="span11" name="unit">
                        <?php 
                        $res = mysqli_query($link, "SELECT *
                                                    FROM units");
                        while($row = mysqli_fetch_array($res)){
                            echo "<option>";
                            echo $row["unit"];
                            echo "</option>";
                        }
                        ?>
                </select>
              </div>
            </div>

            <div class="alert alert-danger" id="error" style="display:none">
                This product already exist! Please try another.
            </div>

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>

            <div class="alert alert-success" id="success" style="display:none">
                Record inserted successfully.
            </div>
          </form>
        </div>
      </div>

      <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Company name</th>
                  <th>Product name</th>
                  <th>Size</th>

                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $res = mysqli_query($link, "SELECT * 
                                            FROM products");
                while($row = mysqli_fetch_array($res)){
                    ?>

                <tr>
                  <td><center><?php echo $row["id"]; ?></center></td>
                  <td><center><?php echo $row["company_name"]; ?></center></td>
                  <td><center><?php echo $row["product_name"]; ?></center></td>
                  <td><center><?php echo $row["unit"]; ?></center></td>
                  <td><center><a href="edit_products.php?id=<?php echo $row["id"]; ?>" style="color:green">Edit</a></center></td>
                  <td><center><a href="delete_products.php?id=<?php echo $row["id"]; ?>" style="color:red">Delete</a></center></td>
                </tr>

                    <?php
                    }
                    ?>

              </tbody>
            </table>
          </div>
    </div>
</div>

<?php
    if(isset($_POST["submit1"])){

        $count = 0;
        $res = mysqli_query($link, "SELECT * 
                                    FROM products
                                    WHERE company_name = '$_POST[company_name]' &&
                                          product_name = '$_POST[product_name]' &&
                                          unit = '$_POST[unit]'")
                                    or die(mysqli_error($link));
        $count = mysqli_num_rows($res);

        if($count>0){
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="none";
                document.getElementById("error").style.display="block";
            </script>

            <?php
        }
        else{
            mysqli_query($link, "INSERT INTO products
                                 VALUES (NULL, 
                                        '$_POST[company_name]',
                                        '$_POST[product_name]',
                                        '$_POST[unit]')") 
                                or die(mysqli_error($link));

            ?>
            <script type="text/javascript">
                document.getElementById("error").style.display="none";
                document.getElementById("success").style.display="block";
                setTimeout(function(){
                    window.location.href=window.location.href;
                },3000);
                
            </script>

            <?php
        }
    }
    
?>

<!--end-main-container-part-->

<?php
include "footer.php";
?>