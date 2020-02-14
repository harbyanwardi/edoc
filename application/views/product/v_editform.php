<?php echo $nav;?>
	
	<div class="row">
		
		<div class="col-md-6">
			<div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                        	<a href="<?php echo base_url()."Welcome" ?>"><button class="btn btn-success btn-md" style="margin-bottom: 5px;">BACK</button></a>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Form Edit Product</h3>
                                    <form action="<?php echo base_url('Welcome/do_update') ?>" method="POST" enctype="multipart/form-data">
                                    <form role="form">
                                        
                                        
                                        <div class="form-group">
                                          	<input name="id" type="hidden" value="<?php echo $id; ?>" class="form-control" required />
                                            
                                            <label>Product Name</label>
                                            <input name="product_name" type="text" value="<?php echo $product_name; ?>" class="form-control" autofocus="autofocus" required />
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            
                                            
                                            <label>Qty</label>
                                            <input name="qty" type="text" value="<?php echo $qty; ?>" class="form-control" autofocus="autofocus" required />
                                            
                                        </div>

                                         
                                        <button type="submit" class="btn btn-primary">SAVE</button>

                                    </form>
                                    <br />
                                      

                                 
    							</div>
    
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
		</div>
	</div>
</div>
<?php echo $footer;?>