
<div class="content-wrapper">
    <?php if (session()->has('success')): ?>
        <p class="alert alert-success"><?= session('success') ?></p>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <p class="alert alert-danger"><?= session('error') ?></p>
    <?php endif; ?>

    <div class="page-header">
        <h3 class="page-title"> Edit Academic Year </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/academicyears" class="btn btn-gradient-primary btn-fw">Back</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/academicyears/update/<?= $academicYear['academic_year_id']; ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="academic_year_code">Academic Year Code</label>
                            <input type="text" name="academic_year_code" id="academic_year_code" class="form-control" value="<?= $academicYear['academic_year_code']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $academicYear['start_date']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $academicYear['end_date']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="university_id">Select University</label>
                            <select name="university_id" id="university_id" class="form-control" required>
                                <option value="">Select a University</option>
                                <?php foreach ($universities as $university): ?>
                                    <option value="<?= $university['university_id']; ?>" <?= $university_id == $university['university_id'] ? 'selected' : ''; ?>>
                                        <?= $university['university_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="college_id">Select Colleges</label>
                            <select name="college_id[]" id="college_id" class="form-control" multiple required>
                                <?php foreach ($related_colleges as $college): ?>
                                    <option value="<?= $college['college_id']; ?>" <?= in_array($college['college_id'], $selected_colleges) ? 'selected' : ''; ?>>
                                        <?= $college['college_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" <?= $academicYear['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $academicYear['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                        <a href="/academicyears" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Listen for changes in the university dropdown
        $('#university_id').change(function () {
            var universityId = $(this).val();

            // Make an AJAX request to fetch colleges for the selected university
            $.ajax({
                type: 'GET',
                url: '/academicyear/getCollegesByUniversity/' + universityId,
                dataType: 'json',
                success: function (data) {
                    var collegeDropdown = $('#college_id');
                    collegeDropdown.empty(); // Clear previous options

                    if (data.length > 0) {
                        // Populate the college dropdown with fetched data
                        $.each(data, function (index, college) {
                            collegeDropdown.append('<option value="' + college.college_id + '">' + college.college_name + '</option>');
                        });
                    } else {
                        // If no colleges found for the selected university
                        collegeDropdown.append('<option value="">No colleges available</option>');
                    }
                },
                error: function () {
                    console.error('Error fetching colleges.');
                }
            });
        });
    });
</script>
