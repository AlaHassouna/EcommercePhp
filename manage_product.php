<?php 
require('top.php');

$categories_id="";
$name="";
$mrp="";
$price="";
$qty="";
$image="";
$short_desc="";
$description="";
$meta_title="";
$meta_desc="";
$meta_keyword="";


$categories='';
$msg='';
$image_required='required';
if(isset($_GET['id'])&& $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $sql="select * from product where id='$id'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if($check > 0){
        $row=mysqli_fetch_assoc($res);
        $categories_id=$row['categories_id'];
        $name=$row['name'];
        $mrp=$row['mrp'];
        $price=$row['price'];
        $qty=$row['qty'];
        $image=$row['image'];
        $short_desc=$row['short_desc'];
        $description=$row['description'];
        $meta_title=$row['meta_title'];
        $meta_desc=$row['meta_desc'];
        $meta_keyword=$row['meta_keyword'];
    }else{
        header('location:product.php');
        die();
    }
    
}

if(isset($_POST['submit'])){
    $categories_id=get_safe_value($con,$_POST['categories_id']);
    $name=get_safe_value($con,$_POST['name']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
    
    $short_desc=get_safe_value($con,$_POST['short_desc']);
    $description=get_safe_value($con,$_POST['description']);
    $meta_title=get_safe_value($con,$_POST['meta_title']);
    $meta_desc=get_safe_value($con,$_POST['meta_desc']);
    $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
   



    $sql="select * from product where name='$name'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id'])&& $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($getData['id']==$id){

            }else{
                $msg="Product already exist";
            }
        }else{
        $msg="Product already exist";
    }

    }
    if($_FILES['image']['type']!='' && $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' ){
        $msg="Please select only png,jpg and jpeg image formate";
    }
   
    if(empty($msg)){
        if(isset($_GET['id'])&& $_GET['id']!=''){
            if($_FILES['image']['name']!=''){
                $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                $update_sql="update product set categories_id='$categories_id', name='$name' ,mrp='$mrp' ,price='$price' ,qty='$qty' ,short_desc='$short_desc' ,description='$description' ,meta_title='$meta_title' ,meta_desc='$meta_desc' ,meta_keyword='$meta_keyword' ,image='$image' where id='$id'";
            }else{
                $update_sql="update product set categories_id='$categories_id', name='$name' ,mrp='$mrp' ,price='$price' ,qty='$qty' ,short_desc='$short_desc' ,description='$description' ,meta_title='$meta_title' ,meta_desc='$meta_desc' ,meta_keyword='$meta_keyword' where id='$id'";
           
            }
            mysqli_query($con,$update_sql);
    
        }else{
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($con,"insert into product (categories_id,name,mrp,price,qty, short_desc, description, meta_title, meta_desc, meta_keyword, status,image  ) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')");

    
        }
        header('location:product.php');
        die();

    }
        
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <select class="form-control" name="categories_id">
                                        <option>
                                            Select Category
                                        </option>
                                        <?php
                                        // Récupérer tous les résultats de la requête SQL
                                            $result = mysqli_query($con, "select id,categories from categories order by categories desc");

                                            // Vérifier s'il y a des résultats
                                            if (mysqli_num_rows($result) > 0) {
                                                // Parcourir les résultats et afficher chaque ligne
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // echo "<script>console.log('Aucun résultat trouvé.');</script>";
                                                    // echo "<script>console.log('row[id] :".$row['id']."');</script>";
                                                    // echo "<script>console.log('categories_id :".$categories_id."');</script>";
                                                    if($row['id']==$categories_id){
                                                        // echo "<script>console.log('hi');</script>";
                                                        echo "<option selected value=".$row['id']." >".$row['categories']."</option>";
                                                    }else{
                                                        echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                    }
                                                       
                                                }
                                            } else {
                                                // Aucun résultat trouvé
                                                echo "<script>console.log('Aucun résultat trouvé.');</script>";
                                 
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Product Name</label>
                                    <input type="text"  name="name" placeholder="Enter product Name" class="form-control" value="<?php echo $name ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="mrp" class=" form-control-label">MRP</label>
                                    <input type="text"  name="mrp" placeholder="Enter product mrp" class="form-control" value="<?php echo $mrp ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="price" class=" form-control-label">Price</label>
                                    <input type="text"  name="price" placeholder="Enter product price" class="form-control" value="<?php echo $price ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="qty" class=" form-control-label">Quantity</label>
                                    <input type="text" name="qty" placeholder="Enter product quantity" class="form-control" value="<?php echo $qty ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="image" class=" form-control-label">Image</label>
                                    <input type="file" name="image" placeholder="Enter product image" class="form-control" <?php echo $image_required?>/>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc" class=" form-control-label">Short description</label>
                                    <textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class=" form-control-label">Description</label>
                                    <textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_title" class=" form-control-label">Meta title</label>
                                    <textarea name="meta_title" placeholder="Enter product meta title" class="form-control" required><?php echo $meta_title ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc" class=" form-control-label">Meta description</label>
                                    <textarea name="meta_desc" placeholder="Enter product meta title" class="form-control" required><?php echo $meta_desc ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword" class=" form-control-label">Meta keyword</label>
                                    <textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword ?></textarea>
                                </div>

                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block" style="margin-top: 2%;">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                                <div style="text-align:center;margin-top:2%;border-radius: .5rem;color:red;"> 
                                <?php 
                                    echo $msg; 
                                    ?></div>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
</div>
<?php 
require('footer.php');
?>