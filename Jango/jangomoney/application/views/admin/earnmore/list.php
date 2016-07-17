    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Title</th>
                <th class="yellow header headerSortDown">Description</th>
                <th class="yellow header headerSortDown">Image</th>
                <th class="yellow header headerSortDown">Point</th>
                <th class="yellow header headerSortDown">Url</th>
                <th class="yellow header headerSortDown">Package Name</th>
                <th class="yellow header headerSortDown">Country</th>
                <th class="yellow header headerSortDown">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($earnmore as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['description'].'</td>';
                echo '<td><img src='.base_url('images/earnmore/'.$row['image']).' height="100" width="100" /></td>';
                echo '<td>'.$row['point'].'</td>';
                echo '<td>'.$row['url'].'</td>';
                echo '<td>'.$row['pkg_name'].'</td>';
                echo '<td>';
                for($i=0;$i<count($country);$i++){
              		if($row['country_id'] == $country[$i]['id']){
              			echo $country[$i]['name'];
              		}
              	}
              	echo '</td>';
                echo '<td class="crud-actions">';
                if($row['status'] == '1'){
                	echo '<a href="'.site_url("admin").'/earnmore/updatestatus/'.$row['id'].'/0" class="btn btn-info">Deactive</a>';
                }else{
                	echo '<a href="'.site_url("admin").'/earnmore/updatestatus/'.$row['id'].'/1" class="btn btn-info">Active</a>';
                }
                echo ' <a href="'.site_url("admin").'/earnmore/update/'.$row['id'].'" class="btn btn-info">edit</a>  
                  <a href="'.site_url("admin").'/earnmore/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>