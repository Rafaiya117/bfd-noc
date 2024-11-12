<?php
include '_a.php';
// No login.. 



include 'register_query.php';


$location_data = get_upzila();


add_js([
    'assets/js/pages/registration.js'
]);

pg_header();
show_banner();
?>
<script>
    let location_data = <?php echo json_encode($location_data); ?>;

    <?php if(!empty($_POST)){ ?>
        let post_other_upazila_input = <?php echo @$_POST['other-upazila-input']; ?> || '';
    $(document).ready(function() {
        $('#purpose').val('<?php echo @$_POST['purpose']; ?>').change();
        console.log(`#purpos changed to <?php echo @$_POST['purpose']; ?> >> ${$('#purpose').val()}`);
        $('#district').val('<?php echo @$_POST['district']; ?>').change();
        $('#upazila').val('<?php echo @$_POST['upazila']; ?>').change();
        $('#affliation_applicant').val('<?php echo @$_POST['affliation_applicant']; ?>').change();
    });
    <?php } ?>
    
    
    
</script>

<!--====== ERROR PART START ======-->


    <div class="container center">
        <div class="reg-size reg_position">
            <div class="">
                <div class="login-box">
                    <div class="login-title text-center">
                        
                        <h3 class="title">Create an Account for Applicant</h3>
                    </div>
                    <form id="reg_form"  method="POST">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="registration">Registration</h3>

                                <?php show_message(); ?>
                                <div class="form-group" style="margin-top: -1rem!important">
                                    <br><label for="email">Email address</label>
                                    <span class="custome_span">*</span>
                                    <input type="email" class="form-control" id="email"  name="email"  value="<?php echo @$_POST['email']; ?>"  autofocus  required />
                                </div>
                                <div class="form-group" style="margin-top: -1rem!important">
                                    <br><label for="password">Password</label>
                                    <span class="custome_span">*</span>
                                    <input style="font-size:15px;font-weight: bold;" type="password" class="form-control"   name="password"  value="<?php echo @$_POST['password']; ?>"  id="password" required onCopy="return false"  onPaste="return false" />
                                </div>
                               <div class="form-group" style="margin-top: -1rem!important">
                                    <br><label for="re-password">Re-type Password</label>
                                    <span class="custome_span">*</span>
                                    <input style="font-size:15px;font-weight: bold;" type="password" class="form-control"   name="re-password"  value="<?php echo @$_POST['re-password']; ?>"  id="re-password" required onCopy="return false" onPaste="return false" />
                                    <span id="re-password-error" style="color: red; display: none;">Password does not match. Please try again.</span>
                                </div>
                                <div class="form-group">
                                    <br><label for="name">Name</label>
                                    <span class="custome_span">*</span>
                                    <input type="text" class="form-control inner_textfield" id="name"  name="name"  value="<?php echo @$_POST['name']; ?>"   required  />
                                </div>
                                <div class="form-group">
                                    <label for="nid">NID number</label>
                                    <span class="custome_span">*</span>
                                    <input type="number" class="form-control inner_textfield" id="nid"  name="nid"  value="<?php echo @$_POST['nid']; ?>"  placeholder=" " required pattern="[0-9]{10}|[0-9]{11}|[0-9]{13}" />
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address">Permanent Address</label>
                                    <span class="custome_span">*</span>
                                    <textarea type="text" class="form-control inner_textfield" id="permanent_address"  name="permanent_address"   required><?php echo @$_POST['permanent_address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Present Address</label>
                                    <span class="custome_span">*</span>
                                    <textarea type="text" class="form-control inner_textfield" id="address"  name="address"    required> <?php echo @$_POST['address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="wrapper" for="purpose">Purpose of This Account</label>
                                    <span class="custome_span">*</span>
                                    <div class="button dropdown">
                                        <select class="form-control inner_textfield" id="purpose" name="purpose" >
                                            <option value="" ></option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Institution">Institution</option>
                                            
                                            
                                        </select>
                                    </div>
                                    <div class="output">
                                        <div id="Individual" class="purpose_based_options Individual">
                                            <label for="phone">Contact number</label>
                                            <span class="custome_span">*</span>
                                            <input type="tel" maxlength="11" class="form-control inner_textfield" id="phone"  name="phone"  value="<?php echo @$_POST['phone']; ?>"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" >
                                        </div>
                                        <div id="Institution" class="purpose_based_options Institution">
                                            <label for="institutional_name">Institution Name</label>
                                                <span class="custome_span">*</span>
                                                <input type="text" class="form-control inner_textfield" id="institutional_name"  name="institutional_name"  value="<?php echo @$_POST['institutional_name']; ?>"   />
                                            <label for="institutional_address">Address</label>
                                                <span class="custome_span">*</span>
                                                <input type="text" class="form-control inner_textfield" id="institutional_address"  name="institutional_address"  value="<?php echo @$_POST['institutional_address']; ?>"   />
                                            <label for="institutional_contact">Contact number</label>
                                                <span class="custome_span">*</span>
                                                <input type="tel" maxlength="11" class="form-control inner_textfield" id="institutional_contact"  name="institutional_contact"  value="<?php echo @$_POST['institutional_contact']; ?>"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" >
                                            <label for="intitute_email">Email</label>
                                                <span class="custome_span">*</span>
                                                <input type="text" class="form-control inner_textfield" id="intitute_email"  name="intitute_email"  value="<?php echo @$_POST['intitute_email']; ?>"   />
                                            <label for="purpose_import_export">Purpose of the import/export</label>
                                                <span class="custome_span">*</span>
                                                <input type="text" class="form-control inner_textfield" id="purpose_import_export"  name="purpose_import_export"  value="<?php echo @$_POST['purpose_import_export']; ?>"   />
                                            <label for="source_species">Source of the species</label>
                                                <span class="custome_span">*</span>
                                                <input type="text" class="form-control inner_textfield" id="source_species"  name="source_species"  value="<?php echo @$_POST['source_species']; ?>"   />
                                        </div>
                                        <div id="Commercial" class="purpose_based_options commercial">
                                            <label for="company_name">Company name</label>
                                            <span class="custome_span">*</span>
                                            <input type="text" class="form-control inner_textfield" id="company_name"  name="company_name"  value="<?php echo @$_POST['company_name']; ?>"  >
                                            <div class="form-group">
                                                <label for="company_phone">Company/Owner phone number</label>
                                                <span class="custome_span">*</span>
                                                <input type="tel" maxlength="11" class="form-control inner_textfield" id="company_phone"  name="company_phone"  value="<?php echo @$_POST['company_phone']; ?>"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="company_licence_num">License number</label>
                                                <span class="custome_span">*</span><sub>(Please contact with BFD office, if you don't have it)</sub>
                                                <input type="text" class="form-control inner_textfield" id="company_licence_num"  name="company_licence_num"  value="<?php echo @$_POST['company_licence_num']; ?>"   />
                                            </div>
                                            <div class="form-group">
                                                <label for="company_licence_num">Licence validity date</label>
                                                <span class="custome_span">*</span>
                                                <br><sub>(Please contact with BFD office, if you don't have it)</sub>
                                                <input type="date" class="form-control inner_textfield" id="company_licence_validity" name="company_licence_validity" value="<?php echo @$_POST['company_licence_validity']; ?>" >
                                            </div>
                                            <div class="form-group" id="affiliation-group">
                                                <label for="affliation_applicant"> Affliation with importing company</label>
                                                <span class="custome_span">*</span>
                                                <select class="form-control inner_textfield"  name="affliation_applicant"  value="<?php echo @$_POST['affliation_applicant']; ?>"  id="affliation_applicant">
                                                    <option value="N/A"> Choose option</option>
                                                    <option value="owner">Owner</option>
                                                    <option value="employee">Employee</option>
                                                </select>
                                                <div class="form-group">
                                                <label for="applicant_designation">Designation</label>
                                                <!-- <span class="custome_span">*</span> -->
                                                <input type="text" class="form-control inner_textfield" id="applicant_designation" name="applicant_designation" value="<?php echo @$_POST['applicant_designation']; ?>"  >
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="district_id">District:</label>
                                    <span class="custome_span">*</span><br>
                                    <select class="form-control inner_textfield" id="district" name="district" required >
                                        <option value=""></option>
                                        <?php 
                                            
                                            for($i=0; $i<count($location_data['districts']); $i+=1){
                                                echo '<option value="',$location_data['districts'][$i]['name'],'">',$location_data['districts'][$i]['name'],'</option>';
                                        }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="upazila">Police station / Upazila:</label>
                                    <span class="custome_span">*</span><br>
                                    <select class="form-control inner_textfield" id="upazila"  name="upazila"  required >
                                        <option value=""></option>
                                        <?php 
                                            
                                            for($i=0; $i<count($location_data['upazilas']); $i+=1){
                                                echo '<option value="',$location_data['upazilas'][$i]['name'],'">',$location_data['upazilas'][$i]['name'],'</option>';
                                        }?>
                                    </select>
                                </div>
                            
                            <div class="form-group" >
                                <label for="agree" ><input type="checkbox" id="agree"  name="agree"   value="yes" required> Information Provided above is Accurate and true</label>
                            </div>
                            <div class="form-group"><input id="search" class="main-btn reg-btn" type="submit"  name="register"  value="Registration" /></div><br>
                            <div class="link">Already have an account ? <a style="color:skyblue;" href="login.php"><b>Login</b></a></div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
                                    </div>
    
    <!-- <div class="error-color">
        <img src="assets/images/error-color.png" alt="color">
    </div> -->
    <!-- <div class="error-thumb">
            <img src="assets/images/734.jpg" alt="">
        </div> -->

<!--====== ERROR PART ENDS ======-->


<?php
pg_footer();












