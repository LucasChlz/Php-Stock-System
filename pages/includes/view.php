<?php
    if(isset($_GET['pending']) == false) {
?>
<div class="container">
    <section class="view">
        <div class="search">
            <form method="post">
                <h2><i class="fas fa-search"></i> Enter the product name</h2>
                <input type="text" name="search" placeholder="Enter the product name">
                <input class="src" style="height: 30px" type="submit" name="action" Value="Search">
                <div class="line"></div>
            </form>
        </div><!--search-->
        <?php Stock::Delete() ?>
        <?php 
            $All = Sql::connect()->prepare("SELECT * FROM `products` WHERE amount = 0");
            $All->execute();
            if($All->rowCount() > 0) {
                Stock::Alert('error','You have missing products, click <a href="'.MAIN_PATH.'view?pending">here</a> to view them');
            }

            if(isset($_POST['update'])) {
                $amount = $_POST['amount'];
                $id = $_POST['id'];
                $amounts = Sql::connect()->prepare("UPDATE `products` SET amount = ? WHERE id = $id");
                if($amounts->execute(array($amount))) {
                    Stock::Alert('success','Product updated successfully');
                }
            }
        ?>
        <br>
        <section class="containers flex flex-wrap">
            <?php
                if(isset($_POST['action']) && $_POST['action'] == 'Search') {
                    $products = Stock::Search('products','');
                }else {
                    $sql = Sql::connect()->prepare("SELECT * FROM `products` WHERE amount > 0");
                    $sql->execute(); 
                    $products = $sql->fetchAll();
                }
                foreach($products as $key => $value) {
            ?>
              <div class="item-single item">
                  <img src="<?php echo MAIN_PATH; ?>uploads/<?php echo $value['image']; ?>" alt="">
                  <div class="item-single-txt">
                      <p>Name: <?php echo $value['name']; ?></p>
                      <p>Description: <?php echo $value['description']; ?></p>
                      <p>Provider: <?php echo $value['provider']; ?></p>
                      <p>Manufacturer: <?php echo $value['manufacturer']; ?></p>
                  </div><!--item-single-txt-->
                  <div class="btn">
                      <form method="post">
                            <input type="number" name="amount" value="<?php echo $value['amount']; ?>">
                            <input type="submit" name="update" value="update">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>"><br><br>
                            <a class="bt delete" href="<?php echo MAIN_PATH ?>view?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Delete</a>
                            <a class="bt edit" href="<?php echo MAIN_PATH ?>edit?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      </form>
                  </div><!--btn-->
              </div><!--item-single-->   
            <?php } ?>  
        </section><!--containers-->
        
    </section><!--view-->
</div><!--container-->
<?php }else{ ?>
    <div class="container">
    <section class="view">
        <div class="search">
                <h2><i class="fas fa-search"></i> <a href="<?php echo MAIN_PATH; ?>view">Products in stock</a> > Missing products</h2>
            </form>
        </div><!--search-->
        <?php Stock::Delete() ?>
        <?php 

            if(isset($_POST['update'])) {
                $amount = $_POST['amount'];
                $id = $_POST['id'];
                $amounts = Sql::connect()->prepare("UPDATE `products` SET amount = ? WHERE id = $id");
                $amounts->execute(array($amount));
            }

            $All = Sql::connect()->prepare("SELECT * FROM `products` WHERE amount = 0");
            $All->execute();
            if($All->rowCount() == 0) {
                Stock::Alert('success','You have no missing products');
            }
        ?>
        <br>
        <section class="containers flex flex-wrap">
            <?php
                $sql = Sql::connect()->prepare("SELECT * FROM `products` WHERE amount = 0");
                $sql->execute();
                $products = $sql->fetchAll();
                foreach($products as $key => $value) {
            ?>
              <div class="item-single item">
                  <img src="<?php echo MAIN_PATH; ?>uploads/<?php echo $value['image']; ?>" alt="">
                  <div class="item-single-txt">
                      <p>Name: <?php echo $value['name']; ?></p>
                      <p>Description: <?php echo $value['description']; ?></p>
                      <p>Provider: <?php echo $value['provider']; ?></p>
                      <p>Manufacturer: <?php echo $value['manufacturer']; ?></p>
                  </div><!--item-single-txt-->
                  <div class="btn">
                      <form method="post">
                            <input type="number" name="amount" value="<?php echo $value['amount']; ?>">
                            <input type="submit" name="update" value="update">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>"><br><br>
                            <a class="bt delete" href="<?php echo MAIN_PATH ?>view?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Delete</a>
                            <a class="bt edit" href="<?php echo MAIN_PATH ?>edit?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      </form>
                  </div><!--btn-->
              </div><!--item-single-->   
            <?php } ?>  
        </section><!--containers-->
        
    </section><!--view-->
</div><!--container-->
<?php } ?>