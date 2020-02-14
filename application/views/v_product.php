<?php echo $nav;?>
	
	<div class="row">
		<?=$this->session->flashdata('pesan')?>
		<div class="col-md-6 offset-md-3">
			<a href="<?php echo base_url()."Welcome/add"; ?>"><button class="btn btn-success btn-sm" style="margin-bottom: 5px;">ADD PRODUCT</button></a>
			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
			<table id="myTable" class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Qty</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
                        $nomor = 1;
                        foreach($data as $d){ 
                        ?>
                            <tr class="odd gradeX">
                             <td><?php echo $nomor; ?></td>
                             
                             <td><?php echo $d['product_name']?></td>
                             <td><?php echo $d['qty']?></td>
                             <td align="center">
                                <a href="<?php echo base_url()."Welcome/do_edit/".$d['id']; ?>"><button class="btn btn-primary btn-sm" style="margin-bottom: 5px;">EDIT</button></a>
                                <a href="<?php echo base_url()."Welcome/do_delete/".$d['id']; ?>"><button class="btn btn-danger btn-sm" style="margin-bottom: 5px;">DELETE</button></a>
                             </td>
                                            
                            </tr>
                     <?php 
                        $nomor = $nomor+1;} ?>
				</tbody>
				
			</table>
		</div>
	</div>
</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<?php echo $footer;?>