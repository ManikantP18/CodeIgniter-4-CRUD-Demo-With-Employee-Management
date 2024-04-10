<div class="container mt-3">
    <?php if (isset($success)) : ?>
        <div class="alert <?php echo ($success == true)? 'alert-success' : 'alert-warning';?> alert-dismissible fade show" role="alert">
            <?php echo $messages; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>
    
    <form id="registerForm" action="<?= base_url('/save');?>" method="post" enctype="multipart/form-data">
     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
    
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" maxlength="20" id="first_name" aria-describedby="emailHelp" value="<?=set_value('first_name')?>" placeholder="Enter First Name" required>
                <span class="error"> <?= (!empty($validation) && $validation->hasError('first_name'))? $validation->showError('first_name') : ''; ?>
            
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" maxlength="20" id="first_name" aria-describedby="emailHelp" value="<?=set_value('last_name')?>" placeholder="Enter Last Name" required>
    
                <span class="error"> <?= (!empty($validation) && $validation->hasError('last_name'))? $validation->showError('last_name') : ''; ?>
                
            </div>
        </div>
     </div>
    
     <!-- Second Form Row -->
     <div class="row  mt-2">
        <div class="col-md-6">
            <div class="form-group">
    
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?=set_value('email')?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="abc@gmail.com" required>
    
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
    
                                 <option value="<?= $i; ?>" <?= (set_value('contry_code') == $i) ? 'selected' : '' ?>> +<?= $i;?> </option>
                                
                             <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="mobile" value="<?=set_value('mobile')?>" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="xxxxxxxxxx" required>
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
                <textarea name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter Address" required><?=set_value('address')?></textarea>
    
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
                    <input type="radio" name="gender"<?= (set_value('gender') == '1')? 'checked' : 'checked'?> class="radio mr-2 gender" id="gender" value="1" required> Male &nbsp;
                    <input type="radio" name="gender" <?= (set_value('gender') == '2')? 'checked' : ''?> class="radio mr-2 gender" id="gender" value="2" required> Female
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hobby">Hobby</label>
                <div class="container">
                  <?php foreach (Hobbies as $key => $value) { ?>
                    <input type="checkbox" name="hobby" class="checkbox mr-2" value="<?=$value;?>"> <?=$value;?>
                  <?php } ?>
                </div>
            </div>
        </div>
     </div>
    
    <!-- Sixth Form Row -->
     <div class="row  mt-3">
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Profile Picture</label>
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
                <input type="submit" class="btn btn-primary form-control" value="Submit">
            </div>
        </div>
     </div>
    </div>
    </form>