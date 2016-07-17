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
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new challenge created with success.';
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
      
      echo form_open_multipart('admin/challenge/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="" name="title" value="<?php echo set_value('title'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
              <textarea id="" name="description"> <?php echo set_value('description'); ?> </textarea>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Image</label>
            <div class="controls">
              <input type="file" id="" name="image">
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Reference URL</label>
            <div class="controls">
              <input type="text" id="" name="ref_url" value="<?php echo set_value('ref_url'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Package Name</label>
            <div class="controls">
              <input type="text" id="" name="pkg_name" value="<?php echo set_value('pkg_name'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Reference ID</label>
            <div class="controls">
              <input type="text" id="" name="ref_id" value="<?php echo set_value('ref_id'); ?>" >
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     