<div class="container">
    <section class="view">

        <div class="search">
            <form method="post">
                <h2><i class="fas fa-search"></i> Enter the product name</h2>
                <input type="text" name="search" placeholder="Enter the product name">
                <input style="height: 30px" type="submit" name="action" Value="Search">
                <div class="line"></div>
            </form>
        </div><!--search-->
        <?php Stock::Delete() ?>
        <br>
        <section class="containers flex flex-wrap">
            <?php
                if(isset($_POST['update'])) {
                    $amount = $_POST['amount'];
                    $id = $_POST['id'];
                    $amounts = Sql::connect()->prepare("UPDATE `products` SET amount = ? WHERE id = $id");
                    $amounts->execute(array($amount));
                }
                $products = Stock::Search('products','');
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