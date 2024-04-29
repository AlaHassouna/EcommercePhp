<?php 
require('top.php');
$categories='';
$msg='';
if(isset($_GET['id'])&& $_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $sql="select * from categories where id='$id'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if($check > 0){
        $row=mysqli_fetch_assoc($res);
        $categories=$row['categories'];
    }else{
        header('location:categories.php');
        die();
    }
    
}

if(isset($_POST['submit'])){
    $categories=get_safe_value($con,$_POST['categories']);
    $sql="select * from categories where categories='$categories'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id'])&& $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($getData['id']==$id){

            }else{
                $msg="Category already exist";
            }
        }else{
        $msg="Category already exist";
    }

    }
    if(empty($msg)){
        if(isset($_GET['id'])&& $_GET['id']!=''){
            mysqli_query($con,"update categories set categories='$categories' where id='$id'");
    
        }else{
            mysqli_query($con,"insert into categories (categories,status) values('$categories','1')");
    
        }
        header('location:categories.php');
        die();

    }
        
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <input type="text" id="category_name" name="categories" placeholder="Enter Category Name" class="form-control" value="<?php echo $categories ?>"/>
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