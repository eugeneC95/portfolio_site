<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Add Product</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Product Detail:</div>
                <div class="panel-body">
                    <div class="emp-response"></div>
                    <form action="process_add_item.php" method="post">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Prodcut Name</label>
                                <input type="text" class="form-control" placeholder="Product Name" name="product" id="product" required data-error="Enter Product Name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="Quantity" name="quantity" id="quantity" required data-error="Enter Product Name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="Quantity" name="price" id="price" required data-error="Enter Product Name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Enter by</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?php echo $user['name'];?>" required data-error="Enter Product Name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <button type="submit" name="action" class="btn btn-lg btn-primary">Submit</button>
                        <button type="reset" class="btn btn-lg btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p>HMS Developed by CSW</a></p>
        </div>
    </div>

</div>    <!--/.main-->
