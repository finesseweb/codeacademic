<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Academic Years </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/academicyears/create" class="btn btn-gradient-primary btn-fw">Add</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Academic Year List</h4>
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr class="table-info">
                                <th>Sl No</th>
                                <th>Academic Year Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>College</th>
                                <th>University</th> <!-- Add this column -->
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $slNo = 1; ?>
                            <?php foreach ($academicYears as $academicYear): ?>
                                <tr>
                                    <td><?= $slNo++ ?></td>
                                    <td><?= $academicYear['academic_year_code'] ?></td>
                                    <td><?= $academicYear['start_date'] ?></td>
                                    <td><?= $academicYear['end_date'] ?></td>
                                    <td><?= $academicYear['college_name'] ?></td>
                                    <td><?= $academicYear['university_name'] ?></td> <!-- Display university name -->
                                    <td><?= $academicYear['status'] ?></td>
                                    <td>
                                        <a class="btn btn-gradient-dark btn-icon-text" href="/academicyears/edit/<?= $academicYear['academic_year_id'] ?>">
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
