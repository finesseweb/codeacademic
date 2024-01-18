<div class="content-wrapper">
    
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>
<div class="page-header">
              <h3 class="page-title"> Colleges </h3>
			  
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/college/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
                </ol>
              </nav>
            </div>
            <div class="row">
             <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">College List</h4>
                    <table class="table table-striped table-bordered" id="example">
   <thead>
    <tr class="table-info">
        <th>Sl No</th>
        <th>College Name</th>
        <th>University Name</th>
        <th>Status</th>
                <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php $slNo = 1; ?>
    <?php foreach ($colleges as $college): ?>
        <tr>
            <td><?= $slNo++ ?></td>
            <td><?= $college['college_name'] ?></td>
            <td><?= $college['university_name'] ?></td>
            <td><?= $college['status'] ?></td>
            <td>
                <a class="btn btn-gradient-dark btn-icon-text" href="/college/edit/<?= $college['college_id'] ?>" class="btn btn-info btn-sm"><i class="mdi mdi-file-check btn-icon-append">Edit</i></a>
                <!-- Other table data -->
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
