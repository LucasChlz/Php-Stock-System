<?php
    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $products = Stock::Select('products','id = ?',array($id));
    }
?>
<div class="container-register">
    <div class="box-form">
      <h2><i class="fas fa-box-open"></i> Edit Product</h2>
          <div class="box-txt">
        </div><!--box-txt-->
        <div class="container">
            <form method="post" enctype="multipart/form-data">
                <?php Stock::Edit($id); ?>
                <div class="form-g">
                    <label>Product's name</label>
                    <input type="text" name="name" value="<?php echo $products['name']; ?>">
                </div><!--form-g-->

                <div class="form-g">
                    <label>Description</label>
                    <input type="text" name="description" value="<?php echo $products['description']; ?>">
                </div><!--form-g-->

                <div class="form-g">
                    <label>Provider</label>
                    <input type="text" name="provider" value="<?php echo $products['provider']; ?>">
                </div><!--form-g-->

                <div class="form-g">
                    <label>Manufacturer</label>
                    <input type="text" name="manufacturer" value="<?php echo $products['manufacturer']; ?>">
                </div><!--form-g-->

                <div class="form-g">
                    <label>Amount</label>
                    <input type="number" name="amount" value="<?php echo $products['amount']; ?>">
                </div><!--form-g-->

                <div class="form-g">
                    <label>Image</label>
                    <input type="file" name="image">
                    <input type="hidden" name="img" value="<?php echo $products['image']; ?>">
                </div><!--form-g-->

                <input type="submit" name="action" value="Update!">
            </form>
        </div><!--container-->
    </div><!--box-form-->
</div><!--container-->