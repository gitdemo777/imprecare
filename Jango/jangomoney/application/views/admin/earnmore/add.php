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
            echo '<strong>Well done!</strong> new earnmore created with success.';
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
      
      echo form_open_multipart('admin/earnmore/add', $attributes);
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
              <input type="file" id="" name="image" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Point</label>
            <div class="controls">
              <input type="text" id="" name="point" value="<?php echo set_value('point'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Url</label>
            <div class="controls">
              <input type="text" id="" name="url" value="<?php echo set_value('url'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Package Name</label>
            <div class="controls">
              <input type="text" id="" name="pkg_name" value="<?php echo set_value('pkg_name'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Country</label>
            <div class="controls">
              <select name="country">
              <?php for($i=0;$i<count($country);$i++){
              		echo '<option value="'.$country[$i]['id'].'">'.$country[$i]['name'].'</option>';
              }?>
				</select>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     