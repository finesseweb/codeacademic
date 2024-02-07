<div class="main-panel">
 <div class="row">
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit University</h4>

                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/university/update/<?= $university['university_id'] ?>">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>University Name</label>
                                <input type="text" class="form-control" name="university_name" value="<?= $university['university_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>University Location</label>
                                <input type="text" class="form-control" name="university_location" value="<?= $university['university_location'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="active" <?= ($university['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= ($university['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    <a href="/university" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
