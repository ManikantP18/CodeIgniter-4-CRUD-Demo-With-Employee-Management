<div class="container mt-3">

<form id="registerForm" action="<?= base_url('edit_employee');?>" method="post" enctype="multipart/form-data">
 <div class="row">
    <div class="col-md-6">
        <div class="form-group">

            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" maxlength="20" id="first_name" aria-describedby="emailHelp" value="<?= isset($emp_obj['first_name'])? $emp_obj['first_name'] : set_value('first_name')?>" placeholder="Enter First Name" required>
            <span class="error"> <?= (!empty($validation) && $validation->hasError('first_name'))? $validation->showError('first_name') : ''; ?>
        
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" maxlength="20" id="first_name" aria-describedby="emailHelp" value="<?= isset($emp_obj['last_name'])? $emp_obj['last_name'] : set_value('last_name')?>" placeholder="Enter Last Name" required>

            <span class="error"> <?= (!empty($validation) && $validation->hasError('last_name'))? $validation->showError('last_name') : ''; ?>
            
        </div>
    </div>
 </div>

 <!-- Second Form Row -->
 <div class="row  mt-2">
    <div class="col-md-6">
        <div class="form-group">

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= isset($emp_obj['email'])? $emp_obj['email'] : set_value('email')?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="abc@gmail.com" required>

            <span class="error"> <?= (!empty($validation) && $validation->hasError('email'))? $validation->showError('email') : ''; ?>
        
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="contry_code" required>
                        <option value=""> Country Code </option>
                        <?php
                          for($i=1; $i<=100; $i++) { ?>

                             <option value="<?= $i; ?>" <?= ((isset($emp_obj['country_code']) && $emp_obj['country_code'] == $i) || set_value('country_code') == $i) ? 'selected' : '' ?>> +<?= $i;?> </option>
                            
                         <?php } ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" name="mobile" value="<?= isset($emp_obj['mobile'])? $emp_obj['mobile'] :  set_value('mobile')?>" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="xxxxxxxxxx" required>
                </div>
            </div>
            <span class="error"> <?= (!empty($validation) && $validation->hasError('contry_code'))? $validation->showError('contry_code') : ''; ?>
            <span class="error"> <?= (!empty($validation) && $validation->hasError('mobile'))? $validation->showError('mobile') : ''; ?>
        </div>
    </div>
 </div>

 <!-- Third Form Row -->
 <div class="row  mt-3">
    <div class="col-md-12">
        <div class="form-group">

            <label for="address">Address</label>
            <textarea name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address" required><?= isset($emp_obj['address'])? $emp_obj['email'] :  set_value('address')?></textarea>

            <span class="error"> <?= (!empty($validation) && $validation->hasError('address'))? $validation->showError('address') : '';?>
        
        </div>
    </div>
    
 </div>

 <!-- Fourth Form Row -->
 <div class="row  mt-3">
    <div class="col-md-6">
        <div class="form-group">

            <label for="gender">Gender</label>
            <div class="container">
                <input type="radio" name="gender"<?= ((isset($emp_obj['gender']) && $emp_obj['gender'] == 1) || (set_value('gender') == '1'))? 'checked' : ''?> class="radio mr-2 gender" id="gender" value="1" required> Male &nbsp;
                <input type="radio" name="gender" <?= ((isset($emp_obj['gender']) && $emp_obj['gender'] == 2) || (set_value('gender') == 2))? 'checked' : ''?> class="radio mr-2 gender" id="gender" value="2" required> Female
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="hobby">Hobby</label>
            <div class="container">
              <?php foreach (Hobbies as $key => $value) { ?>
                <input type="checkbox" name="hobby" class="checkbox mr-2" value="<?=$value;?>" <?= ((isset($emp_obj['hobby']) && $emp_obj['hobby'] == $value) || (set_value('hobby') == $value))? 'checked' : ''?>> <?=$value;?>
              <?php } ?>
            </div>
        </div>
    </div>
 </div>

<!-- Sixth Form Row -->
 <div class="row  mt-3">
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="image">Profile Picture  
                <?php if(isset($emp_obj['image'])) { ?>

                    <img src="<?=WRITEPATH.'uploads/'.$emp_obj['image'];?>">

                <?php } ?>
            </label>
            <input type="file" name="image" class="form-control" id="image">

            <span class="error"> <?= (!empty($validation) && $validation->hasError('image'))? $validation->showError('image') : '';?>
        </div>
    </div>
 </div>

 <!-- Form Submit Button -->
 <div class="row  mt-3">
    
    <div class="col-md-12">
        <div class="form-group">
             <?= csrf_field() ?>
             <input type="hidden" name="id" value="<?= isset($emp_obj['id'])? $emp_obj['id']: '';?>">
            <input type="submit" class="btn btn-primary form-control" value="Submit">
        </div>
    </div>
 </div>
</div>
</form>