<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Professor </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/professor/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Course List</h4>
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email</th>
								<th>Department Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $slNo = 1; ?>
                            <?php foreach ($professors as $professor): ?>
                                <tr>
                                    <td><?= $slNo++ ?></td>
                                    <td><?= $professor['first_name'].' '.$professor['last_name'] ?></td>
									
                                    <td><?= $professor['email'] ?></td>
									 <td><?= $professor['department_name'] ?></td>
									 <td><?= $professor['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="/professor/edit/<?= $professor['professor_id'] ?>">
                                            <i class="mdi mdi-file-check btn-icon-append">Edit</i>
                                        </a>
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
</div>
