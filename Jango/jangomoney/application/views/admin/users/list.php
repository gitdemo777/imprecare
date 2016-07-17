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
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="green header">Email</th>
                <th class="red header">Phone</th>
                <th class="red header">Joining</th>
                <th class="red header">Earning</th>
                <th class="red header">Balance</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($users as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['first_name'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['phone'].'</td>';
                echo '<td>'.$row['joining'].'</td>';
                echo '<td>'.$row['earning'].'</td>';
                echo '<td>'.$row['balance'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/users/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>