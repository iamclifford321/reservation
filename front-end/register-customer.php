
<!doctype html>
<html lang="en">
    
    <?php include 'head.php'; ?>
    <body>
        <!--================Header Area =================-->
        <?php include 'header.php'; ?>
        <!--================Header Area =================-->
        
        <!--================Breadcrumb Area =================-->
        <!-- <section class="breadcrumb_area">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" style="background:none"></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Facilities</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Facilities</li>
                    </ol>
                </div>
            </div>
        </section> -->
        <!--================Breadcrumb Area =================-->
        
        <!--================Contact Area =================-->
        <style>
            .card-content-divider{
                display: flex;
                align-content: center;
                align-items: center;
            }
            .card-content-divider .card-image{
                width: 120px; flex: 1;
            }
            .card-content-divider .card-content{
                flex: 3;
            }

            .card-content-divider .card-content a, .card-content-divider .card-content label{
                font-size: 16px;
            }
        </style>
        
        <section class="contact_area section_gap">
            <div class="container">
                <div class="row" style="justify-content:center;">
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <form action="../customerAction.php" method="POST" name="booking-form">
                                <div class="card-header">
                                    <h4 class="modal-title">Register</h4>
                                  </div>
                                  <div class="card-body">
                                      <div class="customer-details">
                                          <div class="row">
                                              <div class="col-sm-6 col-md-6">
                                                  <div class="form-group">
                                                      <label for="firstname">Firstname</label><small>(Required)</small>
                                                      <input type="text" name="firstname" id="firstname" class="form-control" required>
                                                  </div>
                                              </div>
                          
                                              <div class="col-sm-6 col-md-6">
                                                  <div class="form-group">
                                                      <label for="middlename">Middlename</label>
                                                      <input type="text" name="middlename" id="middlename" class="form-control">
                                                  </div>
                                              </div>
                          
                                              <div class="col-sm-6 col-md-6">
                                                  <div class="form-group">
                                                      <label for="lastname">Lastname</label><small>(Required)</small>
                                                      <input type="text" name="lastname" id="lastname" class="form-control" required>
                                                  </div>
                                              </div>
                                              
                                              <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" id="age" class="form-control">
                                                </div>
                                            </div>

                                              <div class="col-sm-6 col-md-8">
                                                  <div class="form-group">
                                                      <label for="phone">Phone</label><small>(Required)</small>
                                                      <input type="number" name="phone" id="phone" class="form-control" required>
                                                  </div>
                                              </div>
                          

                          
                                              <div class="col-sm-6 col-md-4">
                                                  <div class="form-group">
                                                    <label for="" class="d-block">Gender</label>
                                                    <select name="gender" id="">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                  </div>
                                              </div>
                          
                                              <div class="col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <label for="email">Email</label>
                                                      <input type="email" name="email" id="email" class="form-control">
                                                  </div>
                                              </div>
                          
                                              <div class="col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <label for="address">Address</label>
                                                      <textarea name="address" id="address" class="form-control"></textarea>
                                                  </div>
                                              </div>

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input name="username" id="username" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input name="password" id="password" type="password" class="form-control" required>
                                                    </div>
                                                </div>

                                          </div>
                                      </div>
                                  </div>
                                  <input type="hidden" id="sunmitButtonIndicator" value="customer-details">
                                  <div class="card-footer justify-content-between">
                                    <button type="submit" class="btn btn-secondary" name="action" value="registerCustomer" id="submitBook">submit</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================ start footer Area  =================-->	
        <?php include 'footer-links.php'; ?>
        
    </body>

    <script>
        $(document).ready(function(){
            
            $('[name=date]').daterangepicker({
                locale : {
                    format : 'YYYY/MM/DD'
                },
                isInvalidDate: function(ele) {
                    var currDate = moment(ele._d).format('YY-MM-DD');
                    console.log('currDate', currDate);
                    return ["22-09-09", "22-09-10", "22-09-11"].indexOf(currDate) != -1;
                }
            });

        })
    </script>
</html>