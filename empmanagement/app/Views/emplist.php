

<div class="col-md-12 mt-2 mb-5">
    <a href="<?=base_url('add');?>" class="btn btn-primary pull-right float-end"> Add </a>
</div>

<table class="table table-bordered">

    <thead>
        <tr>
            <th> Image </th>
            <th> First name </th>
            <th> Last name </th>
            <th> Email </th>
            <th> Mobile Number </th>
            <th> Address </th>
            <th> Gender </th>
            <th> Hobby </th>
            <th> Action </th>
        </tr>
    <thead>
    <tbody>

    <?php if (!empty($employees)) {

    foreach ($employees as $key => $value) { ?>

        <tr>
            <td> <img src="<?=WRITEPATH.'uploads/'.$value->image;?>" width="100px;"> </td>
            <td> <?=$value->first_name;?> </td>
            <td> <?=$value->last_name;?></td>
            <td> <?=$value->email;?></td>
            <td> <?=$value->country_code.$value->mobile;?> </td>
            <td><?=$value->address;?></td>
            <td> <?=$value->gender;?> </td>
            <td> <?=$value->hobby;?> </td>
            <td> <a href="<?=base_url('/edit/'.$value->id);?>"> Edit </a>
             &nbsp;
            <a href="<?=base_url('/delete/'.$value->id);?>" onclick="return confirm('Are you sure you want to delete this employee')? true : false;"> Delete </a>
            </td>
        </tr>
       <?php } 
          } else { ?>

          <tr>
            <td><b> No Records Found <b></td>
          </tr>
            
        <?php }?>

    </tbody>

</table>