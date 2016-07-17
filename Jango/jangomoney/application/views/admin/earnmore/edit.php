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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> earnmore updated with success.';
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

      echo form_open_multipart('admin/earnmore/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="" name="title" value="<?php echo $earnmore[0]['title']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
              <input type="text" id="" name="description" value="<?php echo $earnmore[0]['description']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Image</label>
            <div class="controls">
            <img src="<?php echo base_url('images/earnmore/'.$earnmore[0]['image']); ?>" height="100" width="100" />
              <input type="file" id="" name="image" >
              <input type="hidden" id="" name="old_image" value="<?php echo $earnmore[0]['image']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Point</label>
            <div class="controls">
              <input type="text" id="" name="point" value="<?php echo $earnmore[0]['point']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Url</label>
            <div class="controls">
              <input type="text" id="" name="url" value="<?php echo $earnmore[0]['url']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Package Name</label>
            <div class="controls">
              <input type="text" id="" name="pkg_name" value="<?php echo $earnmore[0]['pkg_name']; ?>" >
            	</div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Country</label>
            <div class="controls">
              <select name="country">
              <?php for($i=0;$i<count($country);$i++){
              		if($earnmore[0]['country_id'] == $country[$i]['id']){
              			echo '<option value="'.$country[$i]['id'].'" selected="selected">'.$country[$i]['name'].'</option>';
              		}else{
              			echo '<option value="'.$country[$i]['id'].'">'.$country[$i]['name'].'</option>';
              		}
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
     