<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Course</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/courses/update/<?= $courses['course_id'] ?>">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Course Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="course_name" value="<?= $courses['course_name'] ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Department Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department_id" required>
                                        <?php foreach ($department as $depart): ?>
                                            <option value="<?= $depart['department_id'] ?>" <?= ($depart['department_id'] == $courses['department_id']) ? 'selected' : '' ?>><?= $depart['department_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
					<div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Academic Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="academic_year_id" required>
                                        <?php foreach ($academics as $academic): ?>
                                            <option value="<?= $academic['academic_year_id'] ?>" <?= ($academic['academic_year_id'] == $courses['academic_year_id']) ? 'selected' : '' ?>><?= $academic['academic_year_code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
					 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">College Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="college_id" required>
                                        <?php foreach ($colleges as $college): ?>
                                            <option value="<?= $college['college_id'] ?>" <?= ($college['college_id'] == $courses['college_id']) ? 'selected' : '' ?>><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
						<div class="row">
						 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Credits</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="credits" value="<?= $courses['credits'] ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" required>
                                        <option value="active" <?= ($courses['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($courses['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                    <a href="/caste" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
