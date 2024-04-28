<div class="container">
    

    
    
  <h2>Drivers</h2>
 <table class="table">
    <thead>
      <tr>
        <th>Drive Name</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody>
        
        <?php 
      $shop=  $this->Shop_model->driver_list();       
      foreach ($shop as $shop) { ?>         
          
          <tr>
      <td><?php echo $shop->drive_name; ?></td>
        <td></td>        
      </tr>
          
    <?php   }
        ?>
      
     
     
    </tbody>
  </table>
</div>
