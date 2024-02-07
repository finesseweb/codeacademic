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

                <form method="POST" action="/professor/update/<?= $professor['professor_id'] ?>">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Course Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="first_name" value="<?= $professor['first_name'] ?>" required />
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $professor['last_name'] ?>" name="last_name" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
					<div class="col-md-6">
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="<?= $professor['email'] ?>" name="email" required />
                                </div>
                            </div>
                        </div>
					<div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Department</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="department_id" required>
                                        <?php foreach ($department as $depart): ?>
                                            <option value="<?= $depart['department_id'] ?>"><?= $depart['department_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
					</div>	
					 <div class="row">
						 
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" required>
                                        <option value="active" <?= ($professor['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($professor['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
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
