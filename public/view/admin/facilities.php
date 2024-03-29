<?php

    require_once 'Config/Config.php';
	require_once 'Model/Model.php';
	require_once 'Controller/Controller.php';
	$controller = new Controller();
    $cats = $controller->getCategoriesFac();
    $categories = $cats['data']->fetchAll(PDO::FETCH_ASSOC);

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Facilities</h1>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Name of the tab</li>
                </ol>
            </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">

        <!-- Main content here -->

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-new-facility">New Facility</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="facility-data" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Facility Type</th>
                            <th>Price</th>
                            <th>Category</th>
                            <!-- <th>Image</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.Main content here -->

    </div>
</section>

<!-- Default Modal-->

<div class="modal fade" id="modal-new-facility">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="new-facility-form">

                <div class="modal-header">
                    <h4 class="modal-title">New Facility</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="facility_name">Facility Name</label>
                                <input type="text" name="facility_name" id="facility_name" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="facility_name">Category</label>
                                <a href="?page=categories" style="float: right">New category</a>
                                <select name="category" id="category_name" class="form-control" required>
                                    <?php
                                        foreach ($categories as $key => $category) {
                                            ?>
                                                <option value="<?php echo $category['categoryId']; ?>"><?php echo $category['Name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="decimal" name="price" id="price" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea name="Description" id="Description" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 margin-20px">
                            <div class="form-group custom-file">
                                
                                <input type="file" name="image" id="image" class="custom-file-input form-control" accept="image/png,image/jpeg" required multiple='true'>
                                <label class="custom-file-label" for="image">Choose file</label>

                            </div>
                        </div>

                        
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-update-facility">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" name="modal-update-facility">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Facility</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="existing-facility_name">Facility Name</label>
                                <input type="text" name="existing-facility_name" id="existing-facility_name"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Existing-Description">Description</label>
                                <textarea type="number" name="Existing-Description" id="Existing-Description" class="form-control" required>
                                </textarea>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="existing-price">Price</label>
                                <input type="decimal" name="existing-price" id="existing-price" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 margin-20px">
                            <div class="form-group custom-file image-file-container">

                                <label style="display: inline-block;" for="existing-image" class="image-update-label"
                                    id="image-update-label">
                                    <img id="existing-image-update"
                                        src="/reservation/public/uploads/images/10x-featured-social-media-image-size.png"
                                        width="100%">
                                </label>
                                <input type="file" name="existing-image" id="existing-image"
                                    class="custom-file-input form-control d-none" onchange="readURL(this)">
                            </div>
                        </div>
                        <input type="hidden" id="facilityId">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Default Modal -->

        <!-- Modal -->
        <div class="custom-modal">
            
            <div class="custom-modal-inner">
                <p class="clearfix"><span class="close-button" style="float: right; font-weight:bold; cursor:pointer">Close</span></p>
                <div id="calendar">
                </div>
            </div>
        </div>


        <div class="modal fade" id="InfoModal" tabindex="100" role="dialog" aria-labelledby="InfoModalLabel" aria-hidden="true" style="z-index: 30000">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="InfoModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Customer</label>
                    <input type="text" readonly class="form-control" id="customer">
                  </div>

                  <div class="form-group">
                    <label for="">Phone number</label>
                    <input type="text" readonly class="form-control" id="phoneNum">
                  </div>

                  <div class="form-group">
                    <label for="">Date Reserved</label>
                    <input type="text" readonly class="form-control" id="DateRes">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <!-- / Modal -->

<style>
.image-file-container {
    height: unset;
}

.margin-20px {
    margin: 20px 0;
}

.image-update-label {
    cursor: pointer;
    width: 100%;
}

.image-update-label img {
    height: 275px;
}

div.custom-modal{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10000;
    background-color: #bbbabaa1;
    /* opacity: 0; */
}
div.custom-modal-inner{
    height: auto;
    width: 50em;
    margin: auto;
    background-color: white;
    padding: 5px 30px 30px 30px;
    margin-top: 40px;
}
</style>
<script>
// Some Script Here!
$(document).ready(function() {
    
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl,{
        initialView: 'dayGridMonth',
        eventClick: function(info) {
            $('#InfoModal').modal('show');
            $('input#customer').val(info.event.extendedProps.customer);
            $('input#phoneNum').val(info.event.extendedProps.phone);
            $('input#DateRes').val(info.event.extendedProps.date2);
        }
    });
    
    calendar.render();
    $('.custom-modal').css('display', 'none');

    $('.close-button').on('click', function(){
        window.location.reload();
    })
    $("#image").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    let table = $("#facility-data").DataTable({
        "responsive": true,
        // "lengthChange"  : false, 
        "autoWidth": false,
        "buttons": [
            "csv",
            "excel",
            "pdf",
            "print"
        ]
    });

    getFacilityDetails();

    function getFacilityDetails() {

        //$('#customer').html("");
        $.ajax({
            method: 'POST',
            url: 'adminAction.php',
            dataType: "JSON",
            data: {
                action: 'get-facility',
            },
            success: function(res) {

                if (res.length > 0) {
                    table.clear().draw();
                    for (let index = 0; index < res.length; index++) {
                        var calBtn = ` <button class="btn availability" Facility_id="${res[index]['Facility_id']}"><i class="nav-icon far fa-calendar-alt"></i></button>`
                        // <button class="btn btn-secondary"><i class="nav-icon far fa-calendar-alt"></i></button>
                        var del = `<button type="submit" class="btn btn-danger deleteRecord" Facility_id="${res[index]['Facility_id']}">Delete</button>`;
                        var deac = `<button type="submit" class="btn btn-secondary deactivateRecord" Facility_id="${res[index]['Facility_id']}">Deactivate</button>`;
                        if(res[index]['status'] == 'Deactivated'){
                            deac = `<button type="submit" class="btn btn-primary activateRecord" Facility_id="${res[index]['Facility_id']}">Activate</button>`;
                        }
                        const element = res[index];
                        table.row.add([
                            `<a href="#" img-src="${res[index]['Image']}" class="facilityName" data-target="#modal-update-facility" data-toggle="modal" Facility_id="${res[index]['Facility_id']}">${res[index]['Facility_name']}</a>`,
                            res[index]['Price'],
                            res[index]['Name'],
                            // `<img src="public/uploads/images/${res[index]['Image']}" style="height: 35px;"/>`,
                            res[index]['status'],
                            deac + del + calBtn
                        ]).draw();
                    }
                }
            }
        });

    }
    $(document).on('click', '.availability', function(){
        $('.custom-modal').css('opacity', 1);
        var facId = $(this).attr('facility_id');
        $.ajax({
                url : "adminAction.php",
                method : "POST",
                dataType: 'JSON',
                data : {
                    action : 'getFacilityReservation2',
                    faciltyId : facId
                },
                success: function(res){
                    
                    $('.custom-modal').fadeIn();
                        if(res.length > 0){
                            for (let index = 0; index < res.length; index++) {
                                const element = res[index];
                                console.log(element);
                                var date = new Date(element.date + 'T00:00:00'); // will be in local time
                                
                                calendar.addEvent({
                                    title: 'Reserved - ' + element.customer,
                                    start: date,
                                    customer: element.customer,
                                    phone: element.phone,
                                    date2: element.date,
                                    allDay: true,
                                    backgroundColor: '#ff5b5b'
                                });
                                
                            }
                        }
                }
            });

    })
    $(document).on('click', '.facilityName', function() {

        var facilityId = $(this).attr('Facility_id');
        var imageSrc = $(this).attr('img-src');
        console.log('imageSrc===> ', imageSrc);
        if (imageSrc != '' || imageSrc != null) {

            $('#image-update-label img').attr("src", "public/uploads/images/" + imageSrc);

        }
        getfacility(facilityId, imageSrc);

    });

    function getfacility(Facility_id, Image_src) {
        console.log(Facility_id);
        $.ajax({
            method: 'POST',
            url: 'adminAction.php',
            dataType: "JSON",
            data: {
                action: 'getSpecificFacility',
                facilityId: Facility_id
            },
            success: function(res) {

                $('#existing-facility_name').val(res['Facility_name']);
                $('#existing-price').val(res['Price']);
                $('#facilityId').val(Facility_id);
                $('#Existing-Description').val(res['description']);
                console.log('res', res);
            }
        });
    }
    $('#image').on('change', function(){
        if($(this).prop('files').length > 1){
            $('.custom-file-label').text($(this).prop('files').length + ' files');
        }
    });
    $('[name=new-facility-form]').on('submit', function(e) {
        $('[type=submit]').attr('disabled', 'true');
        let facility_name = $('#facility_name').val();
        let price = $('#price').val();
        let category = $('#category_name').val();
        let Description = $('#Description').val();

        var file_data = $('#image').prop('files');

        
        var form_data = new FormData();
        form_data.append('price', price);
        form_data.append('facility_name', facility_name);

        for (var x = 0; x < file_data.length; x++) {
				form_data.append("files[]", file_data[x]);
        }

        form_data.append('category', category);
        form_data.append('Description', Description);
        form_data.append('action', 'create-facility');
      

        try {
            $.ajax({
                method: 'POST',
                url: 'adminAction.php',
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(res) {

                    if (res['status'] == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: res['message']
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);

                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: res['message']
                        });
                    }

                }
            });
        } catch (error) {
            console.log(error);
        }

        e.preventDefault();

    });

    $('[name=modal-update-facility]').on('submit', function(e) {
        $('[type=submit]').attr('disabled', 'true');

        console.log($('#facilityId').val());
        let facility_name = $('#existing-facility_name').val();
        let price = $('#existing-price').val();

        var file_data = $('#existing-image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('price', price);
        form_data.append('facility_name', facility_name);
        form_data.append('file', file_data);
        form_data.append('facilityId', $('#facilityId').val());
        form_data.append('Description', $('#Existing-Description').val());
        form_data.append('action', 'update-facility');

        try {
            $.ajax({
                method: 'POST',
                url: 'adminAction.php',
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(res) {

                    if (res['status'] == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: res['message']
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);

                        $('#modal-update-facility').modal('hide');
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: res['message']
                        });
                    }

                }
            });
        } catch (error) {
            console.log(error);
        }

        e.preventDefault();

    });
    $(document).on('click', '.activateRecord', function(){
        var Id = $(this).attr('Facility_id');
        $('#facilityId').val(Id);
        $.ajax({
            method: 'POST',
            url: 'adminAction.php',
            dataType: "JSON",
            data: {
                action: 'activate-facility',
                facilityId: Id
            },
            success: function(res) {
                console.log(res);
                if (res['status'] == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully activated the Facility!'
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);

                }

            }
        });
    });

    $(document).on('click', '.deactivateRecord', function(e) {

        var Id = $(this).attr('Facility_id');
        $('#facilityId').val(Id);
        $.ajax({
            method: 'POST',
            url: 'adminAction.php',
            dataType: "JSON",
            data: {
                action: 'deactivate-facility',
                facilityId: Id
            },
            success: function(res) {
                console.log(res);
                if (res['status'] == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully deactivated the record!'
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);

                }
            }
        });
        e.preventDefault();

        });

    $(document).on('click', '.deleteRecord', function(e) {

        var Id = $(this).attr('Facility_id');
        $('#facilityId').val(Id);
        $.ajax({
            method: 'POST',
            url: 'adminAction.php',
            dataType: "JSON",
            data: {
                action: 'delete-facility',
                facilityId: Id
            },
            success: function(res) {
                console.log(res);
                if (res['status'] == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Successfully deleted the record!'
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);

                }else{
                    Swal.fire(
                        'Invalid action',
                        'You can\'t delete a Facility with related Reservation, the Facility has been deactivated instead',
                        'warning'
                    );
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }

            }
        });
        e.preventDefault();

    });

});


function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#existing-image-update')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>