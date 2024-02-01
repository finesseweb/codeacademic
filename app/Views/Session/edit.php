 <div class="main-panel">
 <div class="row">
<div class="col-12">

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Session</h4>
                    <form class="form-sample"method="post" action="/session/edit/<?=$session['session_id']?>">
                      <p class="card-description"> Session Edit </p>
                      <div class="row">
					  <?php $validation = \Config\Services::validation();
					  
					 
					  ?>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"> Name</label>
                            <div class="col-sm-9">
                              <input type="text" name='session' class="form-control" value="<?=$session['session_name']?>" />
							  <?php if ($validation->getError('session_name')) { ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('session_name'); ?>
                            </div>
                        <?php } ?>
                            </div>
                          </div>
                        </div>
						 <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="year" required>
                                        <?php foreach ($Years as $Year): ?>
                                            <option value="<?= $Year['year_id'] ?>" <?php if($Year['year_id']==$session['academic_year_id']) { echo "selected" ; } ?>><?= $Year['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                              <select name='status' class="form-control">
                                <option value='active' <?php if($session['status']=='acive') { echo "selected"; } ?>>Active</option>
                                <option value='deactive' <?php if($session['status']=='deactive') { echo "selected"; } ?>>Deactive</option>
                               
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                     <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <select class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input class="form-control" placeholder="dd/mm/yyyy" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
					  <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Membership</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked> Free </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Address </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 1</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address 2</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                              <select class="form-control">
                                <option>America</option>
                                <option>Italy</option>
                                <option>Russia</option>
                                <option>Britain</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>-->
					   <div class="row">
					    <div class="col-sm-3"></div>
					   <div class="col-sm-9">
					  <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                      <button class="btn btn-light">Cancel</button>
					  </div>
					  </div>
                    </form>
                  </div>
                </div>
              </div>
			  </div>