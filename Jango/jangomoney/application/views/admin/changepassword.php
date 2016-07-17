    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Change Password
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> password changed success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/changepassword', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Old Password</label>
            <div class="controls">
              <input type="password" id="" name="old_password">
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">New Password</label>
            <div class="controls">
              <input type="password" id="" name="new_password">
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Confirm Password</label>
            <div class="controls">
              <input type="password" id="" name="confirm_password">
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Change Password</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     