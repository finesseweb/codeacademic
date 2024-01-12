<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Degree Info </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="degree/add" class="btn btn-gradient-primary btn-fw">Add</a></li>
                
                </ol>
              </nav>
            </div>
            <div class="row">
             <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Degree Lists</h4>
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Name </th>
                          <th> Status </th>
                          <th> Action </th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($this->data)):
					    foreach($this->data as $row):
					  ?>
                        <tr class="table-info">
                          <td> 1 </td>
                          <td> <?=$row['name']?> </td>
                          <td> <?=$row['status']?> </td>
                          <td> <a href="#" class="btn btn-gradient-dark btn-icon-text"><i class="mdi mdi-file-check btn-icon-append"></i>Edit</a> </td>
                          
                        </tr>
                        <?php endforeach; endif;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>