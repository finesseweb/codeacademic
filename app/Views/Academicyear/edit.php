<!-- application/Views/academic_year/edit.php -->

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Academic Year </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/academicyear" class="btn btn-gradient-primary btn-fw">Back</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Academic Year Details</h4>
                    <form method="POST" action="/academicyear/update/<?= $academicYear['academic_year_id']; ?>">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="academic_year_code">Academic Year Code</label>
                            <input type="text" name="academic_year_code" id="academic_year_code" class="form-control" required
                                   pattern="[0-9]{4}-[0-9]{4} year" title="Please enter the format: xxxx-xxxx year"
                                   value="<?= $academicYear['academic_year_code']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required
                                   value="<?= $academicYear['start_date']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required
                                   value="<?= $academicYear['end_date']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="college_id">Select College</label>
                            <select name="college_id" id="college_id" class="form-control">
                                <option value="">Select a College</option>
                                <?php foreach ($colleges as $college): ?>
                                    <option value="<?= $college['college_id']; ?>" <?= ($college['college_id'] == $academicYear['college_id']) ? 'selected' : ''; ?>>
                                        <?= $college['college_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="university_id">Select University</label>
                            <select name="university_id" id="university_id" class="form-control">
                                <option value="">Select a University</option>
                                <?php foreach ($universities as $university): ?>
                                    <option value="<?= $university['university_id']; ?>" <?= ($university['university_id'] == $academicYear['university_id']) ? 'selected' : ''; ?>>
                                        <?= $university['university_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary btn-fw">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
