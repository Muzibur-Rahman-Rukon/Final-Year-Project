<div class="container">
	<div class="row">
		<div class="col-lg-12" style="margin-top: 10px;margin-bottom: 10px">
			<span style="margin-left: 50%">
				<button class="btn btn-info"><a style="color:white" href="<?php echo base_url('admin/addDistrict') ?>">Add District</a></button>
			</span>
		</div>
		<div class="col-lg-12">
      <?php if ($this->session->flashdata('class')): ?>
        <div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>

  </button>
  <?php echo $this->session->flashdata('message'); ?>
  
    
</div>
              
            <?php endif; ?>
			<?php if($district) ?>
			<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Division Name</th>
      <th scope="col">District Name</th>
      <th scope="col" colspan="4">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	$i=1;
     foreach($district as $p){

  	 ?>
    <tr>
      <th scope="row"><?php echo $i++; ?></th>
      <td><?php echo $p->division_name ?></td>
      <td><?php echo $p->district_name ?></td>
      <td><button class="btn btn-danger"><a style="color: #ffff"  href="<?php echo site_url('admin/DeleteDistrict/'.$p->district_id) ?>">Delete</a></button></td>
      <?php 
       $div=$this->modAdmin->chekExistenceInAdmin($p->district_name,$p->district_id);
       $d=$this->modAdmin->chekStateByDistrict($p->district_id,$p->district_name);
      
         
       
       if (count($div)==0) {
       $arrayName = array('division_id' => $p->id ,
                          'district_id' => $p->district_id );
      

   ?>
  
      <td><button class="btn btn-success"><a style="color: #ffff"  href="<?php echo site_url('admin/AddDistrictAsAdmin/'.$p->id."/".$p->district_id) ?>">Give Access Of This Website</a></button></td>
    <?php } elseif ($d) {
      if ($d->state >'0') {
       
    
         
     ?>
      <td style="color:green">Permission Still Running</td>
      <td><button class="btn btn-danger"><a style="color: #ffff"  href="<?php echo site_url('admin/abortDistrictAccess/'.$p->district_id) ?>">Deny Access</a></button></td>
    <?php } elseif ($d->state=='0') {
      # code...
    ?>
    <td style="color: red">Permission is Denied</td>
    <td><button class="btn btn-success"><a style="color: #ffff"  href="<?php echo site_url('admin/givePermissionByDIForAdmin/'.$p->district_id) ?>">Give Access</a></button></td>
  <?php }
  } ?>
    </tr>
<?php } ?>
    
  </tbody>
</table>

		</div>
	</div>
</div>