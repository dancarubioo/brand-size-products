<?php
include "header.php";
include "../user/connection.php";
$id = $_GET["id"];
$company_name='';
$product_name='';
$unit='';
$res = mysqli_query($link, "SELECT *
                            FROM products
                            WHERE id = $id");
while($row=mysqli_fetch_array($res)){
    $company_name = $row["company_name"];
    $product_name = $row["product_name"];
    $unit = $row["unit"];
}
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" class="tip-bottom"><i class="icon-home"></i>
            Edit Products</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Products</h5>
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

                            ?>
                            <option <?php if($row["company_name"] == $company_name){
                                    echo"Selected";
                                }?>>
                            <?php
                            
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
                <input type="text" class="span11" name="product_name" placeholder="Enter product name" value="<?php echo $product_name; ?>">
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
                            ?>
                            <option <?php if($row["unit"] == $unit){
                                    echo"Selected";
                                }?>>
                            <?php
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
                Record updated successfully.
            </div>
          </form>
        </div>
      </div>

        </div>
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
            /*mysqli_query($link, "INSERT INTO products
                                 VALUES (NULL, 
                                        '$_POST[company_name]',
                                        '$_POST[product_name]',
                                        '$_POST[unit]',
                                        '$_POST[packing_size]')") 
                                or die(mysqli_error($link)); */
            
            mysqli_query($link,"UPDATE products
                                SET company_name = '$_POST[company_name]',
                                    product_name = '$_POST[product_name]',
                                    unit = '$_POST[unit]'
                                WHERE id = $id")
                                or die(mysqli_error($link));

            ?>
            <script type="text/javascript">
                document.getElementById("error").style.display="none";
                document.getElementById("success").style.display="block";
                setTimeout(function(){
                    window.location="add_products.php";
                },1000);
                
            </script>

            <?php
        }
    }
    
?>

<!--end-main-container-part-->

<?php
include "footer.php";
?>