<div class="content-wrapper">
    
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>
<div class="page-header">
              <h3 class="page-title"> University </h3>
			  
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/university/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
                
                </ol>
              </nav>
            </div>
            <div class="row">
             <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">University List</h4>
    <table class="table table-striped table-bordered" id="example">
        <thead >
            <tr class="table-info">
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($universities as $university): ?>
                <tr >
                    <td><?= $university['university_id'] ?></td>
                    <td><?= $university['university_name'] ?></td>
                    <td><?= $university['university_location'] ?></td>
                    <td><?= $university['status'] ?></td>
                    <td>
                        <a class="btn btn-gradient-dark btn-icon-text" href="/university/edit/<?= $university['university_id'] ?>"><i class="mdi mdi-file-check btn-icon-append">Edit</i></a>
                        <a href="/university/delete/<?= $university['university_id'] ?>" onclick="return confirm('Are you sure you want to delete this university?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
                </div>
              </div>
            </div>
<div/>
