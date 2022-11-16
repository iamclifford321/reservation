<?php

	require_once 'Config/Config.php';
	require_once 'Model/Model.php';
	require_once 'Controller/Controller.php';
	$controller = new Controller(); 
	$getReservations = $controller->getReservation();

	$totalUnpaid = 0;
	$totalCancelled = 0;
	foreach ($getReservations as $key => $getReservation) {
		if($getReservation['status'] == 'Cancelled'){
			$totalCancelled ++;
		}
		if($getReservation['status'] == 'Unpaid'){
			$totalUnpaid ++;
		}
	}

	$getEarningsMonth = $controller->getEarnings('Monthly');
	$thisMonth = 0;
	foreach ($getEarningsMonth as $key => $getEarning) {
		$thisMonth  += $getEarning['TotalBill'];
	}

	$getEarningsYear = $controller->getEarnings('Annualy');
	$thisYear = 0;
	foreach ($getEarningsYear as $key => $getEarning) {
		$thisYear  += $getEarning['TotalBill'];
	}

	$getEarningsWeek = $controller->getEarnings('Weekly');
	$thisWeek = 0;
	foreach ($getEarningsWeek as $key => $getEarning) {
		$thisWeek  += $getEarning['TotalBill'];
	}

?>
<div class="container-fluid" style="">

	<!-- <div class="banner-container">
		<div class="container-xl px-4 mt-n10">
			<div class="row dashboaard-container">
				<h1>Dashboard</h1>
			</div>
		</div>
	</div> -->
	<div class="container">
		<div class="pt-3">

			<div class="row">
				<div class="col-lg-6 col-xl-3 mb-4">
					<div class="card bg-primary text-white h-100">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="me-3">
									<div class="text-white-75 small">Earnings (Monthly)</div>
									<div class="text-lg fw-bold">₱<?php echo number_format($thisMonth, 2); ?></div>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar feather-xl text-white-50"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							</div>
						</div>
						<div class="card-footer d-flex align-items-center justify-content-between small">
							<a class="text-white stretched-link" href="?page=SalesReport&type=Monthly&value=This Month">View</a>
							<div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
						</div>
					</div>
				</div>
				<!-- <div class="col-lg-6 col-xl-3 mb-4">
					<div class="card bg-warning text-white h-100">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="me-3">
									<div class="text-white-75 small">Earnings (Annual)</div>
									<div class="text-lg fw-bold">₱<?php echo number_format($thisYear, 2); ?></div>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign feather-xl text-white-50"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
							</div>
						</div>
						<div class="card-footer d-flex align-items-center justify-content-between small">
							<a class="text-white stretched-link" href="?page=SalesReport&type=Yearly&value=This Year">View</a>
							<div class="text-white"><svg class="svg-inline-fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg> <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com</div>
						</div>
					</div>
				</div> -->

				<div class="col-lg-6 col-xl-3 mb-4">
					<div class="card bg-warning text-white h-100">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="me-3">
									<div class="text-white-75 small">Earnings (Weekly)</div>
									<div class="text-lg fw-bold">₱<?php echo number_format($thisWeek, 2); ?></div>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign feather-xl text-white-50"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
							</div>
						</div>
						<div class="card-footer d-flex align-items-center justify-content-between small">
							<a class="text-white stretched-link" href="?page=SalesReport&type=Weekly&value=This Week">View</a>
							<div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-3 mb-4">
					<div class="card bg-info text-white h-100">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="me-3">
									<div class="text-white-75 small">Unpaid Reservation</div>
									<div class="text-lg fw-bold"><?php echo $totalUnpaid; ?></div>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square feather-xl text-white-50"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
							</div>
						</div>
						<div class="card-footer d-flex align-items-center justify-content-between small">
							<a class="text-white stretched-link" href="?page=reservations&filterBy=Unpaid">View</a>
							<div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-3 mb-4">
					<div class="card bg-danger text-white h-100">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div class="me-3">
									<div class="text-white-75 small">Canceled Reservations</div>
									<div class="text-lg fw-bold"><?php echo $totalCancelled; ?></div>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle feather-xl text-white-50"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
							</div>
						</div>
						<div class="card-footer d-flex align-items-center justify-content-between small">
							<a class="text-white stretched-link" href="?page=reservations&filterBy=Cancelled">View</a>
							<div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="card">
			<div class="card-header">
				<h5>Requests for Cancellation</h5>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Reservation #</th>
							
							<th>Customer</th>
							<th>Number of Guest</th>
							<th>Facility</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php foreach($getReservations as $keyRes => $getReservation) : ?>
						<?php if($getReservation['status'] == 'Pending Cancel'): ?>
						<tr>
							<td>Reservation No. <?php echo $getReservation['reservationId'] ?></td>
							<td><?php echo $getReservation['customer'] ?></td>
							

							
							<td><?php echo $getReservation['numberOfCustomer'] ?></td>
							<td>

								<?php
									foreach ($getReservation['facilities'] as $keyFac => $facility) {
										?>
											<ul>
												<li>
													<p><?php echo $facility['faclityName'] . ' <b>(' . $facility['facilityDate'] . ')</b>'; ?></p>
												</li>
											</ul>
										<?php
									}
								?>

							</td>
							<td><?php echo $getReservation['status']; ?></td>
							<td>
								<a href="?page=approveCancelation&reservationId=<?php echo $getReservation['reservationId']; ?>&customerId=<?php echo $getReservation['customerId']; ?>">Cancel</a>
							</td>
						</tr>
						<?php endif; ?>
						<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>
			
		</div>


		<div class="card">
			<div class="card-header">
				<h5>Pending Reservation</h5>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Reservation #</th>
							<th>Reservation Date</th>
							<th>Customer</th>
							<th>Number of Guest</th>
							<th>Facility</th>
							<th>Payment Status</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php foreach($getReservations as $keyRes => $getReservation) : ?>
						<?php if($getReservation['status'] == 'Pending'): ?>
						<tr>
							<td>Reservation No. <?php echo $getReservation['reservationId'] ?></td>
							<td><?php echo $getReservation['date'] ?></td>
							<td><?php echo $getReservation['customer'] ?></td>
							<td><?php echo $getReservation['numberOfCustomer'] ?></td>
							<td>
								<?php
									foreach ($getReservation['facilities'] as $keyFac => $facility) {
										?>
											<ul>
												<li>
													<p><?php echo $facility['faclityName'] . ' <b>(' . $facility['facilityDate'] . ')</b>'; ?></p>
												</li>
											</ul>
										<?php
									}
								?>
							</td>
							<td><?php echo $getReservation['paymentStatus']; ?></td>
							<td><?php echo $getReservation['status']; ?></td>
							<td>

								<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a href="?page=paymentHistory&reservationId=<?php echo $getReservation['reservationId']; ?>&customerId=<?php echo $getReservation['customerId']; ?>&totalAmountFac=<?php echo $getReservation['totalAmountFac']; ?>&status=<?php echo $getReservation['paymentStatus']; ?>" class="dropdown-item make-payment">Payment history</a>
                                            <a href="?page=approveCancelation&reservationId=<?php echo $getReservation['reservationId']; ?>&customerId=<?php echo $getReservation['customerId']; ?>" class="dropdown-item cancel-payment">Cancel</a>
                                            <a href="?page=approve&reservationId=<?php echo $getReservation['reservationId']; ?>&customerId=<?php echo $getReservation['customerId']; ?>" class="dropdown-item cancel-payment">Approve</a>
                                            <a class="dropdown-item make-payment" href="?page=reservationDetails&reservationId=<?php echo $getReservation['reservationId']; ?>">Details</a>
                                        </div>
                                    </div>
                                </div>
							</td>
						</tr>
						<?php endif; ?>
						<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>
			
		</div>

	</div>
	<div class="pt-3"></div>
</div>
<style type="text/css">
	.container-fluid {
		padding-left: 0;
		padding-right: 0;
	}
	.banner-container {
		background-color: #0061f2;
	    width: 100%;
	    height: 200px;
	}
	.dashboaard-container {
		vertical-align: bottom;
    	display: unset;
    	position: relative;
    	top: 30px;
	}
	.table-container {
		position: relative;
    	top: -55px;
	}
	.card-main-container {
		position: relative;
	}
	.card-container {
		position: relative;
    	top: -110px;
	}
	h1{
		color: #FFFFFF;
	}
	.svg-inline--fa {
		width: 10px;
	}

	@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

	body {
	  background-color: #3e94ec;
	  font-family: "Roboto", helvetica, arial, sans-serif;
	  font-size: 16px;
	  font-weight: 400;
	  text-rendering: optimizeLegibility;
	}

	div.table-title {
	   display: block;
	  /*margin: auto;
	  max-width: 600px;*/
	  text-align: right;
	  padding:5px;
	  width: 100%;
	}

	.table-title h3 {
	   color: #fafafa;
	   font-size: 30px;
	   font-weight: 400;
	   font-style:normal;
	   font-family: "Roboto", helvetica, arial, sans-serif;
	   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
	   text-transform:uppercase;
	}


	/*** Table Styles **/

	/* .table-fill {
	  background: white;
	  border-radius:3px;
	  border-collapse: collapse;
	  height: 320px;
	  margin: auto;
	  max-width: 600px;
	  padding:5px;
	  width: 100%;
	  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
	  animation: float 5s infinite;
	}
	  */
	/* th {
	      color: #D5DDE5;
	    background: #17A2B8;
	    border-bottom: 4px solid #9ea7af;
	    border-right: 1px solid #9ea7af;
	    font-size: 23px;
	    font-weight: 100;
	    padding: 24px;
	    text-align: left;
	    text-shadow: 0 1px 1px rgb(0 0 0 / 10%);
	    vertical-align: middle;
	}

	th:first-child {
	  border-top-left-radius:3px;
	}
	 
	th:last-child {
	  border-top-right-radius:3px;
	  border-right:none;
	} */
	  
	/* tr {
	  border-top: 1px solid #C1C3D1;
	  border-bottom-: 1px solid #C1C3D1;
	  color:#666B85;
	  font-size:16px;
	  font-weight:normal;
	  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
	} */
	 
	/* tr:hover td {
	  background:#4E5066;
	  color:#FFFFFF;
	  border-top: 1px solid #22262e;
	} */
	 
	/* tr:first-child {
	  border-top:none;
	}

	tr:last-child {
	  border-bottom:none;
	}
	 
	tr:nth-child(odd) td {
	  background:#EBEBEB;
	} */
	 
	/* tr:nth-child(odd):hover td {
	  background:#4E5066;
	} */

	/* tr:last-child td:first-child {
	  border-bottom-left-radius:3px;
	}
	 
	tr:last-child td:last-child {
	  border-bottom-right-radius:3px;
	} */
	 
	/* td {
	  background:#FFFFFF;
	  padding:20px;
	  text-align:left;
	  vertical-align:middle;
	  font-weight:300;
	  font-size:18px;
	  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
	  border-right: 1px solid #C1C3D1;
	} */

	/* td:last-child {
	  border-right: 0px;
	}

	th.text-left {
	  text-align: left;
	}

	th.text-center {
	  text-align: center;
	}

	th.text-right {
	  text-align: right;
	}

	td.text-left {
	  text-align: left;
	}

	td.text-center {
	  text-align: center;
	}

	td.text-right {
	  text-align: right;
	} */

</style>
<script>
	$(document).ready(function(){
		$('.table').DataTable();
	})
</script>