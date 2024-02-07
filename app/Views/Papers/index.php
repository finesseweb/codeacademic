<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Papers </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/papers/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Papers List</h4>
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Paper Name</th>
                                <th>Paper Description</th>
								<th>Course Name</th>
								<th>College Name</th>
								<th>Credit</th>
								<th>Countable</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $slNo = 1; ?>
                            <?php foreach ($papers as $paper): ?>
                                <tr>
                                    <td><?= $slNo++ ?></td>
                                    <td><?= $paper['paper_title'] ?></td>
									<td><?= $paper['paper_description'] ?></td>
                                    <td><?= $paper['course_name'] ?></td>
									<td><?= $paper['college_name'] ?></td>
									<td><?= $paper['credits'] ?></td>
									<td><?= $paper['countable_credit'] ?></td>
									<td><?= $paper['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="/papers/edit/<?= $paper['course_id'] ?>">
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
