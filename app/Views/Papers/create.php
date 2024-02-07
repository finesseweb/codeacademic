<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Paper</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/papers/store">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Paper Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="paper_title" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Paper Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="paper_description" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
					 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Course</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="course_id" required>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?= $course['course_id'] ?>"><?= $course['course_name'] ?></option>
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
                                            <option value="<?= $college['college_id'] ?>"><?= $college['college_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
					 <div class="row">
					 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Credits</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="credits" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Countable</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="countable_credit" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
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
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
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
                                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
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
