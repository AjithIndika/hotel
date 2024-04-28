 <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand logo" href="<?php echo base_url('dash')?>">Home</a>

  
  <!-- Links -->
  <ul class="navbar-nav">
   
    
     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Setting</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('categories/categories') ?>">Main Categories</a>
      <a class="dropdown-item" href="<?php echo base_url('table/table') ?>">Table</a>
       <a class="dropdown-item" href="<?php echo base_url('item/item') ?>">Items</a>
     <!--  <a class="dropdown-item" href="<?php echo base_url('table/waiter') ?>"><h4>Waiter</h4></a> !---->
       <a class="dropdown-item" href="<?php echo base_url('shop/payment') ?>">Payment Method</a>
      <a class="dropdown-item" href="<?php echo base_url('users/userlist') ?>">Users</a>
      <a class="dropdown-item" href="<?php echo base_url('shop/waiter') ?>">Waiter</a>
      <a class="dropdown-item" href="<?php echo base_url('shop/shop') ?>">Shop Setting</a>
       <a class="dropdown-item" href="<?php echo base_url('shop/kot') ?>">KOT Print</a>
        <a class="dropdown-item" href="<?php echo base_url('shop/see') ?>">See Print</a>
        <a class="dropdown-item" href="<?php echo base_url('pos/rebill')?>"> RE PRINT </a>
        <a class="dropdown-item" href="<?php echo base_url('shop/clashop')?>"> MY </a>
          <a class="dropdown-item" href="<?php echo base_url('supplier/new_supplier')?>"> Supplier</a>
    </div>
  </li>
  
  <li class="nav-item">
      <a class="nav-link " href="<?php echo base_url('selling/delet_bill');?>">Delete Bill</a>
  </li>
  
  
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Deliver Service</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('shop/deliver') ?>">New Deliver</a>
      <a class="dropdown-item" href="<?php echo base_url('deliver_list') ?>">Deliver List</a>
      
    </div>
  </li>
  
  
  
      <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Driver</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('driver') ?>">New Driver</a>
      <a class="dropdown-item" href="<?php echo base_url('driver_list') ?>">Driver List</a>
      
    </div>
  </li>
  
     <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Report</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('sellingDate') ?>">Selling</a>
      <a class="dropdown-item" href="<?php echo base_url('delet_bill_data') ?>">Deleted Bill</a>
      
    </div>
  </li>
  
  
  
  <li class="nav-item" >
            <a class="nav-link" href="<?php echo base_url('logout'); ?>">Hi <?php echo $this->session->uname; ?> Logout</a>
        </li>
        
        
        
        
  </ul>
</nav>

<!------------------------
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

    
    <ul class="navbar-nav">  

        <?php if ($this->session->user_type == "Admin") { ?>
            <a class="logo" href="<?php echo base_url('dash') ?>">
            <img src="<?php echo base_url('images/icon/logo.png') ?>" alt="Lanka Hall" width="5%" />
            </a>
        <?php } ?>

        <?php if ($this->session->user_type == "Cashier") { ?>
            <a class="logo" href="<?php echo base_url('selling') ?>">
            <img src="<?php echo base_url('images/icon/logo.png') ?>" alt="Lanka Hall" />
            </a>
        <?php } ?>
        
      
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('logout'); ?>">Hi <?php echo $this->session->uname; ?> Logout</a>
        </li>

    </ul>

</nav>


<hr></hr> 
<div class="container">
<ul class="nav nav-pills">
  <li class="nav-item">
      <a class="nav-link active" href="<?php echo base_url('dash')?>"><h4>Home</h4></a>
  </li>

  
   <li class="nav-item">
      <a class="nav-link " href="<?php echo base_url('selling/delet_bill');?>"><h4>Delete Bill</h4></a>
  </li>
  
 
  
  
   <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><h4>Setting</h4></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('categories/categories') ?>"><h4>Main Categories</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('table/table') ?>"><h4>Table</h4></a>
       <a class="dropdown-item" href="<?php echo base_url('item/item') ?>"><h4>Items</h4></a>
   <a class="dropdown-item" href="<?php echo base_url('table/waiter') ?>"><h4>Waiter</h4></a>
       <a class="dropdown-item" href="<?php echo base_url('shop/payment') ?>"><h4>Payment Method</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('users/userlist') ?>"><h4>Users</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('shop/shop') ?>"><h4>Shop Setting</h4></a>
       <a class="dropdown-item" href="<?php echo base_url('shop/kot') ?>"><h4>KOT Print</h4></a>
        <a class="dropdown-item" href="<?php echo base_url('shop/see') ?>"><h4>See Print</h4></a>
        <a class="dropdown-item" href="<?php echo base_url('pos/rebill')?>"><h4> RE PRINT </h4></a>
    </div>
  </li>
  
  
  
  
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><h4>Deliver Service</h4></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('shop/deliver') ?>"><h4>New Deliver</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('deliver_list') ?>"><h4>Deliver List</h4></a>
      
    </div>
  </li>
  
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><h4>Driver</h4></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('driver') ?>"><h4>New Driver</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('driver_list') ?>"><h4>Driver List</h4></a>
      
    </div>
  </li>
 
  
   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><h4>Report</h4></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url('sellingDate') ?>"><h4>Selling</h4></a>
      <a class="dropdown-item" href="<?php echo base_url('delet_bill_data') ?>"><h4>Deleted Bill</h4></a>
      
    </div>
  </li>
  
  
</ul>
    
</div>



!------------------>
<div class="mt-4"></div>
