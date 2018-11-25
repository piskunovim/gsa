<?php
if($_SESSION["permission"] == "admin"){
?>
<br><br><br>
<main id="app">


	<div class="container">
		<h1>Admin panel</h1>
		<!-- Nav tabs -->
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab" aria-controls="nav-users" aria-selected="true">Users</a>
				<a class="nav-item nav-link" id="nav-children-tab" data-toggle="tab" href="#nav-children" role="tab" aria-controls="nav-children" aria-selected="false">Children</a>
				<a class="nav-item nav-link" id="nav-guardians-tab" data-toggle="tab" href="#nav-guardians" role="tab" aria-controls="nav-guardians" aria-selected="false">Guardians</a>
				<a class="nav-item nav-link" id="nav-schedule-tab" data-toggle="tab" href="#nav-schedule" role="tab" aria-controls="nav-schedule" aria-selected="false">Schedule</a>
				<a class="nav-item nav-link" id="nav-invoice-tab" data-toggle="tab" href="#nav-invoice" role="tab" aria-controls="nav-invoice" aria-selected="false">Invoices</a>
			</div>
		</nav>
		<!-- Tab panes -->
		<div class="tab-content" id="nav-tabContent">
			<!-- Users -->
			<div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
				<br>
				<div v-if="users.length > 0">
					<label>User Search:</label>
					<input type="text" v-model="userFilter" v-on:change="filterUsers">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newUserModal" style="float:right;" v-on:click="showAddUserModal">
						Add user
					</button>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Email</th>
								<th scope="col">Permissions</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="u in users">
								<td>{{ u.username }}</td>
								<td>{{ u.firstName }}</td>
								<td>{{ u.lastName }}</td>
								<td>{{ u.email }}</td>
								<td>{{ u.permission }}</td>
								<td><a href="#!" class="action" v-on:click="showEditUserModal(u)">Edit</a> | <a href="#!" class="action" v-on:click="deleteUser(u.id)">Remove</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
					<label>User Search:</label>
					<input type="text" v-model="userFilter" v-on:change="filterUsers">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newUserModal" style="float:right;" v-on:click="showAddUserModal">
						Add user
					</button>
					<p>No users</p>
				</div>

			</div>


			<!--  Modal for Users --> 
			<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="editUser==0" class="modal-title" id="userModalLabel">Add user</h5>
							<h5 v-else class="modal-title" id="userModalLabel">Edit user</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearUserModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="username">Username</label> 
								<input type="text" class="form-control" id="username"  v-model="newUser.username" placeholder="johnDoe">
							</div>
							<div class="form-group">
								<label for="userFirstName">First Name</label> 
								<input type="text" class="form-control" id="userFirstName"  v-model="newUser.firstName" placeholder="John">
							</div>
							<div class="form-group">
								<label for="userLastName">Last Name</label> 
								<input type="text" class="form-control" id="userLastName"  v-model="newUser.lastName" placeholder="Doe">
							</div>
							<div class="form-group">
								<label for="userEmail">Email</label> 
								<input type="text" class="form-control" id="userEmail"  v-model="newUser.email" placeholder="your@email.com">
							</div>
							<div class="form-group">
								<label for="userAddressLine1">Address Line 1</label> 
								<input type="text" class="form-control" id="userAddressLine1"  v-model="newUser.addressLine1" placeholder="445 Mount Eden Road, Mount Eden, Auckland">
							</div>
							<div class="form-group">
								<label for="userAddressLine2">Address Line 2</label> 
								<input type="text" class="form-control" id="userAddressLine2"  v-model="newUser.addressLine2">
							</div>
							<div class="form-group">
								<label for="userPhoneNumber">Phone Number</label> 
								<input type="text" class="form-control" id="userPhoneNumber"  v-model="newUser.phoneNumber">
							</div>
							<div class="form-group dropdown">
								<label for="userChildDropDown">Child</label>
								<input type="text" class="form-control" placeholder="Start searching for a child..." v-on:keyup="showUserChildHints" v-on:change="showUserChildHints" id="searchUserChildrenInput" data-toggle="dropdown">
		      			        <ul id="userChildDropDown" class="dropdown-menu" data-input="searchUserChildrenInput"></ul>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" id="userChildId"  v-model="newUser.childId">
							</div>
							<div class="form-group">
								<label for="userFamilyType">Family Type</label> 
								<input type="text" class="form-control" id="userFamilyType"  v-model="newUser.familyType">
							</div>
							<div class="form-group">
								<label for="userGroup">User Group</label>
								<select class="custom-select" id="userGroup" v-model="newUser.categoryId" >
									<option disabled value="">Please select one</option>
									<option value="2">Guest</option>
									<option value="1">Admin</option>
								</select>
							</div>
							<div class="form-group">
								<label for="userPassword">Password</label> 
								<input type="password" class="form-control" id="userPassword"  v-model="newUser.newPassword">
							</div>



						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearUserModal">Close</button>
							<button v-if="editUser==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addUser">Submit</button>
							<!-- editUser hidden by default -->
							<button v-if="editUser>0" type="button" class="btn btn-primary" v-on:click="updateUser">Update User</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Users ends -->


			<!-- Children -->
			<div class="tab-pane fade" id="nav-children" role="tabpanel" aria-labelledby="nav-children-tab">
				<br>
				<div v-if="children.length > 0">
					<label>Children Search:</label>
					<input type="text" v-model="childFilter" v-on:change="filterChildren">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newChildModal" style="float:right;" v-on:click="showAddChildModal">
						Add child
					</button>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Phone Number</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="c in children">
								<td>{{ c.id }}</td>
								<td>{{ c.firstName }}</td>
								<td>{{ c.lastName }}</td>
								<td>{{ c.phoneNumber }}</td>
								<td><a href="#!" class="action" v-on:click="showEditChildModal(c)">Edit</a> | <a href="#!" class="action" v-on:click="deleteChild(c.id)">Remove</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
					<label>Child Search:</label>
					<input type="text" v-model="childFilter" v-on:change="filterChildren">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newChildModal" style="float:right;" v-on:click="showAddChildModal">
						Add child
					</button>
					<p>No children</p>
				</div>
			</div>

			<!-- Modal For Children  -->
			<div class="modal fade" id="newChildModal" tabindex="-1" role="dialog" aria-labelledby="newChildModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="editChild==0" class="modal-title" id="childModalLabel">Add child</h5>
							<h5 v-else class="modal-title" id="childModalLabel">Edit child</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearChildModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="childFirstName">First Name</label> 
								<input type="text" class="form-control" id="childFirstName"  v-model="newChild.firstName" placeholder="John">
							</div>
							<div class="form-group">
								<label for="childLastName">Last Name</label> 
								<input type="text" class="form-control" id="childLastName"  v-model="newChild.lastName" placeholder="Doe">
							</div>
							<div class="form-group">
								<label for="childGender">Gender</label>
								<select class="custom-select" id="childGender" v-model="newChild.gender" >
									<option disabled value="">Please select gender</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
							<div class="form-group">
								<label for="childDateOfBirth">Date of birth</label> 
								<input type="text" class="form-control datepicker" id="childDateOfBirth"  v-model="newChild.dateOfBirth">
							</div>
							<div class="form-group">
								<label for="childDateOfEntry">Date of entry</label> 
								<input type="text" class="form-control datepicker" id="childDateOfEntry"  v-model="newChild.dateOfEntry">
							</div>
							<div class="form-group">
								<label for="childPhoneNumber">Phone Number</label> 
								<input type="text" class="form-control" id="childPhoneNumber"  v-model="newChild.phoneNumber">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearChildModal">Close</button>
							<button v-if="editChild==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addChild">Submit</button>
							<!-- editChild hidden by default -->
							<button v-if="editChild>0" type="button" class="btn btn-primary" v-on:click="updateChild">Update Child</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Children ends -->


			<!-- Guardians -->
			<div class="tab-pane fade" id="nav-guardians" role="tabpanel" aria-labelledby="nav-guardians-tab">
				<br>
				<div v-if="guardians.length > 0">
					<label>Guardian Search:</label>
					<input type="text" v-model="guardianFilter" v-on:change="filterGuardian">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newGuardianModal" style="float:right;" v-on:click="showAddGuardianModal">
						Add guardian
					</button>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Phone Number</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="g in guardians">
								<td>{{ g.firstName }}</td>
								<td>{{ g.lastName }}</td>
								<td>{{ g.phoneNumber }}</td>
								<td><a href="#!" class="action" v-on:click="showEditGuardianModal(g)">Edit</a> | <a href="#!" class="action" v-on:click="deleteGuardian(g.id)">Remove</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
					<label>Guardian Search:</label>
					<input type="text" v-model="guardianFilter" v-on:change="filterGuardian">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newGuardianModal" style="float:right;" v-on:click="showAddGuardianModal">
						Add guardian
					</button>
					<p>No guardians</p>
				</div>
			</div>

			<!-- Modal For Guardians  -->
			<div class="modal fade" id="newGuardianModal" tabindex="-1" role="dialog" aria-labelledby="newGuardianModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="editGuardian==0" class="modal-title" id="guardianModalLabel">Add guardian</h5>
							<h5 v-else class="modal-title" id="guardianModalLabel">Edit guardian</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearGuardianModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="guardianFirstName">First Name</label> 
								<input type="text" class="form-control" id="guardianFirstName"  v-model="newGuardian.firstName" placeholder="John">
							</div>
							<div class="form-group">
								<label for="guardianLastName">Last Name</label> 
								<input type="text" class="form-control" id="guardianLastName"  v-model="newGuardian.lastName" placeholder="Doe">
							</div>
							<div class="form-group">
								<label for="guardianAddressLine1">Address Line 1</label> 
								<input type="text" class="form-control" id="guardianAddressLine1"  v-model="newGuardian.addressLine1" placeholder="445 Mount Eden Road, Mount Eden, Auckland">
							</div>
							<div class="form-group">
								<label for="guardianAddressLine2">Address Line 2</label> 
								<input type="text" class="form-control" id="guardianAddressLine2"  v-model="newGuardian.addressLine2">
							</div>
							<div class="form-group">
								<label for="guardianPhoneNumber">Phone Number</label> 
								<input type="text" class="form-control" id="guardianPhoneNumber"  v-model="newGuardian.phoneNumber">
							</div>
							<div class="form-group">
								<label for="guardianFamilyType">Family Type</label> 
								<input type="text" class="form-control" id="guardianFamilyType"  v-model="newGuardian.familyType">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearGuardianModal">Close</button>
							<button v-if="editGuardian==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addGuardian">Submit</button>
							<!-- editChild hidden by default -->
							<button v-if="editGuardian>0" type="button" class="btn btn-primary" v-on:click="updateGuardian">Update Guardian</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Guardians ends -->

			<!-- Schedule -->
			<div class="tab-pane fade" id="nav-schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
				<br>
				<label>Сhild's ID:</label>
				<input type="text"  id="scheduleChildId"  v-model="scheduleChildId" v-on:change="getChildSheet" size="7">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newChildSheetModal" style="float:right;" v-on:click="showAddChildSheetModal" v-if="childSheetName">
						Add child sheet instance
					</button>
				<div class="child-sheet" v-if="childSheet.length > 0">
				<h3>{{ childSheetName }}</h3>
				<table class="table">
					<thead>
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Period</th>
						<th scope="col">Presence</th>
					</tr>
					</thead>
					<tbody>
					<tr v-for="cs in childSheet">
						<td v-if="cs.date">{{ cs.date || "Not set" }}</td>
						<td v-if="cs.date">{{ cs.period || "Not set" }}</td>
						<td v-if="cs.date">{{ cs.presence || "Not set" }}</td>
						<td><a href="#!" class="action" v-on:click="showEditChildSheetModal(cs)">Edit</a> | <a href="#!" class="action" v-on:click="deleteChildSheetInstance(cs.id)">Remove</a></td>
					</tr>
					</tbody>
					</table>
				</div>
				<div v-else>
					<br>
					<h3 v-if="childSheetName">{{ childSheetName }} - No data for this child</h3>
					Nothing to show yet. Please, specify child id and press Enter to load sheet.
				</div>
			</div>
			<!-- Modal For Schedule  -->
			<div class="modal fade" id="newChildSheetModal" tabindex="-1" role="dialog" aria-labelledby="newChildSheetModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="editChildSheet==0" class="modal-title" id="childSheetModalLabel">Add child sheet instance - {{ childSheetName }}</h5>
							<h5 v-else class="modal-title" id="childSheetModalLabel">Edit child sheet instance</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearChildSheetModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="childSheetDate">Date</label> 
								<input type="text" class="form-control datepicker" id="childSheetDate"  v-model="newChildSheetInstance.date" placeholder="Date">
							</div>
							<div class="form-group">
								<label for="childSheetPeriod">Period</label> 
								<input type="text" class="form-control" id="childSheetPeriod"  v-model="newChildSheetInstance.period" placeholder="Text">
							</div>
							<div class="form-group">
								<label for="childSheetPresence">Presence</label> 
								<input type="text" class="form-control" id="childSheetPresence"  v-model="newChildSheetInstance.presence" placeholder="Text">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearChildSheetModal">Close</button>
							<button v-if="editChildSheet==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addChildSheetInstance">Submit</button>
							<!-- editChild hidden by default -->
							<button v-if="editChildSheet>0" type="button" class="btn btn-primary" v-on:click="updateChildSheetInstance">Update Child Sheet Instance</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Schedule ends -->

			<!-- Invoice information  -->
			<div class="tab-pane fade" id="nav-invoice" role="tabpanel" aria-labelledby="nav-invoice-tab">
				<br>
				<label>Сhild's ID:</label>
				<input type="text"  id="invoiceChildId"  v-model="invoiceChildId" v-on:change="getInvoice" size="7">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newInvoiceModal" style="float:right;" v-on:click="showAddInvoiceModal" v-if="invoiceName">
						Add invoice
					</button>
				<div class="invoice" v-if="invoices.length > 0">
					<h3>{{ invoiceName }}</h3>

					<div v-for="i in invoices">
						<p>{{ i.years }}</p>
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col" class="bg-warning">Term 1</th>
						      <th scope="col" class="bg-warning">Term 2</th>
						      <th scope="col" class="bg-warning">Term 3</th>
						      <th><a href="#!" class="action" v-on:click="showEditInvoiceModal(i)">Edit</a> | <a href="#!" class="action" v-on:click="deleteInvoice(i.id)">Remove</a></th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <td>{{ i.paymentTerm1 || "Not Set" }}</td>
						      <td>{{ i.paymentTerm2 || "Not Set" }}</td>
						      <td>{{ i.paymentTerm3 || "Not Set" }}</td>
						    </tr>
						    <tr>
						      <td><span v-bind:class="{ 'text-success' : i.statusTerm1 == 1, 'text-warning' : i.statusTerm1 == 2, 'text-danger' : i.statusTerm1 == 3 }">{{ i.statusTextTerm1 || "Not Set" }}</span></td>
						      <td><span v-bind:class="{ 'text-success' : i.statusTerm2 == 1, 'text-warning' : i.statusTerm2 == 2, 'text-danger' : i.statusTerm2 == 3 }">{{ i.statusTextTerm2 || "Not Set" }}</span></td>
						      <td><span v-bind:class="{ 'text-success' : i.statusTerm3 == 1, 'text-warning' : i.statusTerm3 == 2, 'text-danger' : i.statusTerm3 == 3 }">{{ i.statusTextTerm3 || "Not Set" }}</span></td>
						    </tr>
						    <tr>
						      <td><a v-bind:href="i.invoiceLinkTerm1">View Invoice</a></td>
						      <td><a v-bind:href="i.invoiceLinkTerm2">View Invoice</a></td>
						      <td><a v-bind:href="i.invoiceLinkTerm3">View Invoice</a></td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<div v-else>
					<br>
					<h3 v-if="invoiceName">{{ invoiceName }} - No data for this child</h3>
					Nothing to show yet. Please, specify child id and press Enter to load financial information.
				</div>
			</div>

			<!-- Modal For Invoice  -->
			<div class="modal fade" id="newInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="newInvoiceModal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="editInvoice==0" class="modal-title" id="invoiceModalLabel">Add invoice - {{ invoiceName }}</h5>
							<h5 v-else class="modal-title" id="invoiceModalLabel">Edit invoice</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearInvoiceModal">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="invoiceYears">Years</label> 
								<input type="text" class="form-control" id="invoiceYears"  v-model="newInvoice.years" placeholder="2017/2018 (Text)">
							</div>
							

							<ul class="nav nav-tabs" id="invoiceTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="term1-tab" data-toggle="tab" href="#term1" role="tab" aria-controls="term1" aria-selected="true">Term 1</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="term2-tab" data-toggle="tab" href="#term2" role="tab" aria-controls="term2" aria-selected="false">Term 2</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="term3-tab" data-toggle="tab" href="#term3" role="tab" aria-controls="term3" aria-selected="false">Term 3</a>
							  </li>
							</ul>
							<div class="tab-content" id="invoiceTabContent">
							  <!-- Term 1 started -->
							  <div class="tab-pane fade show active" id="term1" role="tabpanel" aria-labelledby="term1-tab">
								<div class="form-group">
									<label for="invoicePaymentTerm1">Payment Term 1</label> 
									<input type="text" class="form-control" id="invoicePaymentTerm1"  v-model="newInvoice.paymentTerm1">
								</div>
								<div class="form-group">
									<label for="invoiceStatusTerm1">Status Term 1</label> 
									<select class="custom-select" id="invoiceStatusTerm1" v-model="newInvoice.statusTerm1" >
										<option disabled value="">Please select one</option>
										<option value="1">Paid</option>
										<option value="2">Partially paid</option>
										<option value="3">Unpaid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="invoiceStatusTextTerm1">Status Text Term 1</label> 
									<input type="text" class="form-control" id="invoiceStatusTextTerm1"  v-model="newInvoice.statusTextTerm1">
								</div>
								<div class="form-group">
									<label for="invoiceLinkTerm1">Invoice Link Term 1</label> 
									<input type="text" class="form-control" id="invoiceLinkTerm1"  v-model="newInvoice.invoiceLinkTerm1">
								</div>
							  </div><!-- Term 1 finished -->

							  <!-- Term 2 started -->
							  <div class="tab-pane fade" id="term2" role="tabpanel" aria-labelledby="term2-tab">
								<div class="form-group">
									<label for="invoicePaymentTerm2">Payment Term 2</label> 
									<input type="text" class="form-control" id="invoicePaymentTerm2"  v-model="newInvoice.paymentTerm2">
								</div>
								<div class="form-group">
									<label for="invoiceStatusTerm2">Status Term 2</label> 
									<select class="custom-select" id="invoiceStatusTerm2" v-model="newInvoice.statusTerm2" >
										<option disabled value="">Please select one</option>
										<option value="1">Paid</option>
										<option value="2">Partially paid</option>
										<option value="3">Unpaid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="invoiceStatusTextTerm2">Status Text Term 2</label> 
									<input type="text" class="form-control" id="invoiceStatusTextTerm2"  v-model="newInvoice.statusTextTerm2">
								</div>
								<div class="form-group">
									<label for="invoiceLinkTerm2">Invoice Link Term 2</label> 
									<input type="text" class="form-control" id="invoiceLinkTerm2"  v-model="newInvoice.invoiceLinkTerm2">
								</div>
							  </div><!-- Term 2 finished -->
							  

							  <!-- Term 3 started -->
							  <div class="tab-pane fade" id="term3" role="tabpanel" aria-labelledby="term3-tab">
								<div class="form-group">
									<label for="invoicePaymentTerm3">Payment Term 3</label> 
									<input type="text" class="form-control" id="invoicePaymentTerm3"  v-model="newInvoice.paymentTerm3">
								</div>
								<div class="form-group">
									<label for="invoiceStatusTerm3">Status Term 3</label> 
									<select class="custom-select" id="invoiceStatusTerm3" v-model="newInvoice.statusTerm3" >
										<option disabled value="">Please select one</option>
										<option value="1">Paid</option>
										<option value="2">Partially paid</option>
										<option value="3">Unpaid</option>
									</select>
								</div>
								<div class="form-group">
									<label for="invoiceStatusTextTerm3">Status Text Term 3</label> 
									<input type="text" class="form-control" id="invoiceStatusTextTerm3"  v-model="newInvoice.statusTextTerm3">
								</div>
								<div class="form-group">
									<label for="invoiceLinkTerm3">Invoice Link Term 3</label> 
									<input type="text" class="form-control" id="invoiceLinkTerm3"  v-model="newInvoice.invoiceLinkTerm3">
								</div>
							  </div><!-- Term 3 finished -->

							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearInvoiceModal">Close</button>
							<button v-if="editInvoice==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addInvoice">Submit</button>
							<!-- editChild hidden by default -->
							<button v-if="editInvoice>0" type="button" class="btn btn-primary" v-on:click="updateInvoice">Update Child Sheet Instance</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Invoice ends -->


		</div>

	</div>

	

</main>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="text/javascript">

	function selectUserChildDropDown(childString, childId){
	      		$('#searchUserChildrenInput').val(childString.trim());
	      		vue.newUser.childId = childId;
	}

	$(function(){		
		$('.nav-tabs .nav-item a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});

		/* Activate datepickers */
		$(".datepicker").flatpickr({ dateFormat: 'Y-m-d' });
		//$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

		
	});

	let vue = new Vue({
		el: '#app',
		data: {
			users:[],   // <======= USERS
			storedUsers: [],
			userFilter: "",
	        newUser: {}, // used for editing user too
	        editUser: 0,
	        children: [], // <======= CHILDREN
			storedChildren: [],
			childFilter: "",
	        newChild: {}, // used for editing child too
	        editChild: 0,
	        guardians: [], // <======= GUARDIANS
	        storedGuardians: [],
	        guardianFilter: "",
	        newGuardian: {}, // used for editing guardians too
	        editGuardian: 0,
	        scheduleChildId: "",  // <======= SCHEDULE (CHILD SHEET)
	        childSheetName: "",
	        childSheet: [],
	        storedChildSheet: [],
	        newChildSheetInstance: {}, // used for editing child sheet too
	        editChildSheet: 0,
	        invoiceChildId: "",  // <======= INVOICE
	        invoiceName: "",
	        invoices: [],
	        storedInvoices: [],
	        newInvoice: {}, // used for editing invoice too
	        editInvoice: 0,
	    },
	    methods: {
	      	updateUserList: ()=>{
	      		$.get('/api/user/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.users = JSON.parse(data);
	      				vue.storedUsers = JSON.parse(data);
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		});
	      	},
	      	/* To add user*/
	      	addUser: () =>{

	      		if(!vue.newUser.username || !vue.newUser.username.replace(/ /g,"")){
	      			alert("Username field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newUser.email || !vue.newUser.email.replace(/ /g,"")){
	      			alert("Email field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newUser.newPassword || !vue.newUser.newPassword.replace(/ /g,"")){
	      			alert("Password field cannot be empty.")
	      			return;
	      		}
	      		$.post('/api/user/create.php',{ ...vue.newUser }).done(function(response) {
	      			$("#newUserModal").modal("hide");
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearUserModal();  
	      			vue.updateUserList();
	      			/*if(JSON.parse(response).status !== "error"){
	      				console.log(response.status);
	      			}*/
	      		}).fail(function(){
	      			alert("Failed to send your data. Please, try again.")
	      		});
	      		
	      	},
	      	/* To update user*/
	      	updateUser: ()=>{
	      		if(!vue.newUser.username || !vue.newUser.username.replace(/ /g,"")){
	      			alert("Username cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newUser.id){
	      			alert("User id is not set. Please, reload page and try again.")
	      			return;
	      		}
	      		const user = { 
	      			...vue.newUser
	      		};
	      		$.ajax({
	      			url: '/api/user/update.php',
	      			type: 'POST',
	      			data: user,
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearUserModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update user. Please, try again.");
	      		});
	      		$("#newUserModal").modal("hide");
	      		vue.updateUserList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditUserModal: (user) =>{
	      		vue.clearUserModal();
	      		vue.editUser = 1;
	      		vue.newUser = JSON.parse(JSON.stringify(user));
	      		if(vue.newUser.childId){
	      			let found = false;
	      			for(let c of vue.children){
	      				if(c.id == vue.newUser.childId){
	      					$('#searchUserChildrenInput').val(c.firstName + " " + c.lastName);
	      					found = true;
	      					break;
	      				}
	      			}
	      			if(!found){
	      				$('#searchUserChildrenInput').val("Attached child not found");
	      			}
	      		}

	      		$("#newUserModal").modal("show");
	      	},
	      	showAddUserModal: () =>{
	      		// TODO: make clearUserModal somewhere in one place
	      		vue.clearUserModal();
	      		vue.editUser = 0;
	      	},
	      	/* To remove user from the database */
	      	deleteUser: (id) => {
	      		$.ajax({
	      			url: '/api/user/delete.php?id='+id,
	      			type: 'GET',
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.updateUserList();
	      		})
	      		.fail(function() {
	      			alert("Failed to remove user. Please, try again.");
	      		});
	      	},
	      	/* To clear modal form when on closing */
	      	clearUserModal: ()=>{
	      		vue.newUser= {};
	      		$('#searchUserChildrenInput').val("");
	      		$('#userChildDropDown').html("");
	      	},
	      	filterUsers: ()=>{
	      		let users = vue.storedUsers;
	      		if(vue.userFilter === ""){
	      			vue.users = users;
	      		} else {
	      			let userFilterString = vue.userFilter;
	      			vue.users = users.filter(u => { 
	      				u.firstName = u.firstName ? u.firstName : "";
	      				u.lastName = u.lastName ? u.lastName : "";

	      				if(u.username.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1 || 
	      				u.firstName.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1 ||  
	      				u.lastName.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1){
	      					return 1;
	      				} else {
	      					return 0;
	      				}
	      			});
	      		}
	      	},
	      	showUserChildHints: () => {
			    const searchUserChildString = $('#searchUserChildrenInput').val().toLowerCase();
			    $('#userChildDropDown').html("");
			    if (typeof searchUserChildString != "undefined" && searchUserChildString !== "" ) {
			    	let limit =  10;
			      	for (let c of vue.children) {
			      		if(limit === -1){
			      			break;
			      		}
			            let firstName = c.firstName.toLowerCase();
			            if(firstName.indexOf(searchUserChildString) !== -1 ){
			                $('#userChildDropDown').append('<li onclick="selectUserChildDropDown(\''+c.firstName+' '+c.lastName+'\', '+ c.id +')">'+c.firstName+' '+c.lastName+'</li>');
			            }
			            limit--;
			        }
			        $('.dropdown').dropdown();
			    }
	      	},
	      	
	      	/*==================================== CHILDREN ===========================================*/
	      	updateChildList: ()=>{
	      		$.get('/api/children/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.children = JSON.parse(data);
	      				vue.storedChildren = JSON.parse(data);
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		});
	      	},
	      	/* To add child*/
	      	addChild: () =>{

	      		if(!vue.newChild.firstName || !vue.newChild.firstName.replace(/ /g,"")){
	      			alert("First name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newChild.lastName || !vue.newChild.lastName.replace(/ /g,"")){
	      			alert("Last name field cannot be empty.")
	      			return;
	      		}

	      		$.post('/api/children/create.php',{ ...vue.newChild }).done(function(response) {
	      			$("#newChildModal").modal("hide");
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearChildModal();  
	      			vue.updateChildList();
	      			/*if(JSON.parse(response).status !== "error"){
	      				console.log(response.status);
	      			}*/
	      		}).fail(function(){
	      			alert("Failed to send your data. Please, try again.")
	      		});
	      		
	      	},
	      	/* To update child */
	      	updateChild: ()=>{
	      		if(!vue.newChild.firstName || !vue.newChild.firstName.replace(/ /g,"")){
	      			alert("First name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newChild.lastName || !vue.newChild.lastName.replace(/ /g,"")){
	      			alert("Last name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newChild.id){
	      			alert("Child id is not set. Please, reload page and try again.")
	      			return;
	      		}
	      		const child = { 
	      			...vue.newChild
	      		};
	      		$.ajax({
	      			url: '/api/children/update.php',
	      			type: 'POST',
	      			data: child,
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearChildModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update child. Please, try again.");
	      		});
	      		$("#newChildModal").modal("hide");
	      		vue.updateChildList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditChildModal: (child) =>{
	      		vue.clearChildModal();
	      		vue.editChild = 1;
	      		vue.newChild = JSON.parse(JSON.stringify(child));

	      		$("#newChildModal").modal("show");
	      	},
	      	showAddChildModal: () =>{
	      		vue.clearChildModal();
	      		vue.editChild = 0;
	      	},
	      	/* To remove child from the database */
	      	deleteChild: (id) => {
	      		$.ajax({
	      			url: '/api/children/delete.php?id='+id,
	      			type: 'GET',
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.updateChildList();
	      		})
	      		.fail(function() {
	      			alert("Failed to remove child. Please, try again.");
	      		});
	      	},

	      	/* To clear modal form when on closing */
	      	clearChildModal: ()=>{
	      		vue.newChild = {};
	      		$(".datepicker").flatpickr({ dateFormat: 'Y-m-d' });
	      	},
	      	filterChildren: ()=>{
	      		let children = vue.storedChildren;
	      		if(vue.childFilter === ""){
	      			vue.children = children;
	      		} else {
	      			let childFilterString = vue.childFilter;
	      			vue.children = children.filter(c => c.firstName.toLowerCase().indexOf(childFilterString.toLowerCase()) !== -1 ||  c.lastName.toLowerCase().indexOf(childFilterString.toLowerCase()) !== -1);
	      		}
	      	},



	      	/*==================================== GUARDIANS ===========================================*/
	      	updateGuardianList: ()=>{
	      		$.get('/api/guardian/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.guardians = JSON.parse(data);
	      				vue.storedGuardians = JSON.parse(data);
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		});
	      	},
	      	/* To add guardian */
	      	addGuardian: () =>{

	      		if(!vue.newGuardian.firstName || !vue.newGuardian.firstName.replace(/ /g,"")){
	      			alert("First name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newGuardian.lastName || !vue.newGuardian.lastName.replace(/ /g,"")){
	      			alert("Last name field cannot be empty.")
	      			return;
	      		}

	      		$.post('/api/guardian/create.php',{ ...vue.newGuardian }).done(function(response) {
	      			$("#newGuardianModal").modal("hide");
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearGuardianModal();  
	      			vue.updateGuardianList();
	      			/*if(JSON.parse(response).status !== "error"){
	      				console.log(response.status);
	      			}*/
	      		}).fail(function(){
	      			alert("Failed to send your data. Please, try again.")
	      		});
	      		
	      	},
	      	/* To update guardian */
	      	updateGuardian: ()=>{
	      		if(!vue.newGuardian.firstName || !vue.newGuardian.firstName.replace(/ /g,"")){
	      			alert("First name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newGuardian.lastName || !vue.newGuardian.lastName.replace(/ /g,"")){
	      			alert("Last name field cannot be empty.")
	      			return;
	      		}
	      		if(!vue.newGuardian.id){
	      			alert("Guardian id is not set. Please, reload page and try again.")
	      			return;
	      		}
	      		const guardian = { 
	      			...vue.newGuardian
	      		};
	      		$.ajax({
	      			url: '/api/guardian/update.php',
	      			type: 'POST',
	      			data: guardian,
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearGuardianModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update guardian. Please, try again.");
	      		});
	      		$("#newGuardianModal").modal("hide");
	      		vue.updateGuardianList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditGuardianModal: (guardian) =>{
	      		vue.clearGuardianModal();
	      		vue.editGuardian = 1;
	      		vue.newGuardian = JSON.parse(JSON.stringify(guardian));

	      		$("#newGuardianModal").modal("show");
	      	},
	      	showAddGuardianModal: () =>{
	      		vue.clearGuardianModal();
	      		vue.editGuardian = 0;
	      	},
	      	/* To remove guardian from the database */
	      	deleteGuardian: (id) => {
	      		$.ajax({
	      			url: '/api/guardian/delete.php?id='+id,
	      			type: 'GET',
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.updateGuardianList();
	      		})
	      		.fail(function() {
	      			alert("Failed to remove guardian. Please, try again.");
	      		});
	      	},

	      	/* To clear modal form when on closing */
	      	clearGuardianModal: ()=>{
	      		vue.newGuardian = {};
	      	},
	      	filterGuardian: ()=>{
	      		let guardians = vue.storedGuardians;
	      		if(vue.guardianFilter === ""){
	      			vue.guardians = guardians;
	      		} else {
	      			let guardianFilterString = vue.guardianFilter;
	      			vue.guardians = guardians.filter(g => g.firstName.toLowerCase().indexOf(guardianFilterString.toLowerCase()) !== -1 ||  g.lastName.toLowerCase().indexOf(guardianFilterString.toLowerCase()) !== -1);
	      		}
	      	},


	      	/*==================================== CHILD SHEET ===========================================*/
	      	getChildSheet: ()=>{
	      		
	      		vue.updateChildSheetList();

	      		let found = false
	      		for(let c of vue.children){
	      			if(c.id == vue.scheduleChildId){
	      				vue.childSheetName = c.firstName + " " + c.lastName;	
	      				found = true;
	      				break;
	      			}
	      		}
	      		if(!found){
	      			vue.childSheetName	= "Child not found, please clarify child id by using 'Child' tab."	
	      		}
	      	},
	      	updateChildSheetList: ()=>{
	      		$.ajax({
	      			url: '/api/childSheet/read.php?childId='+vue.scheduleChildId,
	      			type: 'GET',
	      		}).done(function(data) {
	      			if(data !== "null"){
		      			if(data.length > 0){
		      				vue.childSheet = JSON.parse(data);
		      				vue.storedChildSheet = JSON.parse(data);
		      			}
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		});
	      	},
	      	/* To add child sheet instance */
	      	addChildSheetInstance: () =>{
	      		if(!vue.scheduleChildId){
	      			alert("Please specify child id");
	      			return;
	      		}

	      		vue.newChildSheetInstance.childId = vue.scheduleChildId;

	      		if(!vue.newChildSheetInstance.date && !vue.newChildSheetInstance.period && !vue.newChildSheetInstance.presence ){
	      			alert("In order to create new child sheet instance you must fill at least one field.")
	      			return;
	      		}

	      		$.post('/api/childSheet/create.php',{ ...vue.newChildSheetInstance }).done(function(response) {
	      			$("#newChildSheetModal").modal("hide");
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					console.log(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearChildSheetModal();  
	      			vue.updateChildSheetList();
	      			/*if(JSON.parse(response).status !== "error"){
	      				console.log(response.status);
	      			}*/
	      		}).fail(function(){
	      			alert("Failed to send your data. Please, try again.")
	      		});
	      		
	      	},
	      	/* To update child sheet instance */
	      	updateChildSheetInstance: ()=>{
	      		
	      		if(!vue.newChildSheetInstance.date && !vue.newChildSheetInstance.period && !vue.newChildSheetInstance.presence ){
	      			alert("In order to update child sheet instance you must fill at least one field.")
	      			return;
	      		}

	      		const childSheetInstance = { 
	      			...vue.newChildSheetInstance
	      		};
	      		$.ajax({
	      			url: '/api/childSheet/update.php',
	      			type: 'POST',
	      			data: childSheetInstance,
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					console.log(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearChildSheetModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update child sheet. Please, try again.");
	      		});
	      		$("#newChildSheetModal").modal("hide");
	      		vue.updateChildSheetList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditChildSheetModal: (childSheetInstance) =>{
	      		vue.clearChildSheetModal();
	      		vue.editChildSheet = 1;
	      		vue.newChildSheetInstance = JSON.parse(JSON.stringify(childSheetInstance));

	      		$("#newChildSheetModal").modal("show");
	      	},
	      	showAddChildSheetModal: () =>{
	      		vue.clearChildSheetModal();
	      		vue.editChildSheet = 0;
	      	},
	      	/* To remove child sheet instance from the database */
	      	deleteChildSheetInstance: (id) => {
	      		$.ajax({
	      			url: '/api/childSheet/delete.php?id='+id,
	      			type: 'GET',
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.updateChildSheetList();
	      		})
	      		.fail(function() {
	      			alert("Failed to remove child sheet instance. Please, try again.");
	      		});
	      	},

	      	/* To clear modal form when on closing */
	      	clearChildSheetModal: ()=>{
	      		vue.newChildSheetInstance = {};
	      	    $(".datepicker").flatpickr({ dateFormat: 'Y-m-d' });
	      	},


	      	/*==================================== INVOICE ===========================================*/
	      	getInvoice: ()=>{
	      		
	      		vue.updateInvoiceList();

	      		let found = false
	      		for(let c of vue.children){
	      			if(c.id == vue.invoiceChildId){
	      				vue.invoiceName = c.firstName + " " + c.lastName;	
	      				found = true;
	      				break;
	      			}
	      		}
	      		if(!found){
	      			vue.invoiceName	= "Child not found, please clarify child id by using 'Child' tab."	
	      		}
	      	},
	      	updateInvoiceList: ()=>{
	      		$.ajax({
	      			url: '/api/invoice/read.php?childId='+vue.invoiceChildId,
	      			type: 'GET',
	      		}).done(function(data) {
	      			if(data !== "null"){
		      			if(data.length > 0){
		      				vue.invoices = JSON.parse(data);
		      				vue.storedInvoices = JSON.parse(data);
		      			}
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		});
	      	},
	      	/* To add invoice instance */
	      	addInvoice: () =>{
	      		if(!vue.invoiceChildId){
	      			alert("Please specify child id");
	      			return;
	      		}

	      		vue.newInvoice.childId = vue.invoiceChildId;

	      		if(!vue.newInvoice.years){
	      			alert("In order to create new instance instance you must fill years field.")
	      			return;
	      		}

	      		$.post('/api/invoice/create.php',{ ...vue.newInvoice }).done(function(response) {
	      			$("#newInvoiceModal").modal("hide");
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					console.log(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearInvoiceModal();  
	      			vue.updateInvoiceList();
	      			/*if(JSON.parse(response).status !== "error"){
	      				console.log(response.status);
	      			}*/
	      		}).fail(function(){
	      			alert("Failed to send your data. Please, try again.")
	      		});
	      		
	      	},
	      	/* To update invoice instance */
	      	updateInvoice: ()=>{
	      		
	      		if(!vue.newInvoice.years){
	      			alert("In order to update invoice instance you must fill at least years field.")
	      			return;
	      		}

	      		const invoice = { 
	      			...vue.newInvoice
	      		};
	      		$.ajax({
	      			url: '/api/invoice/update.php',
	      			type: 'POST',
	      			data: invoice,
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					console.log(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.clearInvoiceModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update invoice. Please, try again.");
	      		});
	      		$("#newInvoiceModal").modal("hide");
	      		vue.updateInvoiceList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditInvoiceModal: (invoice) =>{
	      		vue.clearInvoiceModal();
	      		vue.editInvoice = 1;
	      		vue.newInvoice = JSON.parse(JSON.stringify(invoice));

	      		$("#newInvoiceModal").modal("show");
	      	},
	      	showAddInvoiceModal: () =>{
	      		vue.clearInvoiceModal();
	      		vue.editInvoice = 0;
	      	},
	      	/* To remove invoice instance from the database */
	      	deleteInvoice: (id) => {
	      		$.ajax({
	      			url: '/api/invoice/delete.php?id='+id,
	      			type: 'GET',
	      		}).done(function(response) {
	      			try{
	      				const r = JSON.parse(response);
	      				if(r.msg){
	      					alert(r.msg);
	      				} else {
	      					alert("Failed to parse response data.");
	      				}
	      			} catch(e){
	      				alert(e);
	      			}
	      			vue.updateInvoiceList();
	      		})
	      		.fail(function() {
	      			alert("Failed to remove invoice instance. Please, try again.");
	      		});
	      	},

	      	/* To clear modal form when on closing */
	      	clearInvoiceModal: ()=>{
	      		vue.newInvoice = {};
	      	},


	      },
	      /* Initial loading */
	      created: ()=>{	
	      	// get users
	      	$.get('/api/user/read.php').done(function(data) {
	      		if(data.length > 0){
	      			vue.users = JSON.parse(data);
	      			vue.storedUsers = JSON.parse(data);
	      		}
	      	})
	      	.fail(function(err) {
	      		alert(JSON.stringify(err));
	      	}); 

	      	// get children
	      	$.get('/api/children/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.children = JSON.parse(data);
	      				vue.storedChildren = JSON.parse(data);
	      			}
	      	})
	      	.fail(function(err) {
	      		alert(JSON.stringify(err));
	      	});

	        // get guardians
	      	$.get('/api/guardian/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.guardians = JSON.parse(data);
	      				vue.storedGuardians = JSON.parse(data);
	      			}
	      	})
	      	.fail(function(err) {
	      		alert(JSON.stringify(err));
	      	});
	      }
	  });
	</script>
<?php
} else {
	header("location: /404");
}
?>