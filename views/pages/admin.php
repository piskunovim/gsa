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
			</div>
		</nav>
		<!-- Tab panes -->
		<div class="tab-content" id="nav-tabContent">
			<!-- Users -->
			<div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">

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
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Phone Number</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="c in children">
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
			users:[],
			storedUsers: [],
			userFilter: "",
	        newUser: {}, // used for editing user too
	        editUser: 0,
	        children: [],
			storedChildren: [],
			childFilter: "",
	        newChild: {}, // used for editing child too
	        editChild: 0,
	        guardians: [],
	        storedGuardians: [],
	        guardianFilter: "",
	        newGuardian: {}, // used for editing guardians too
	        editGuardian: 0,
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
	      	},
	      	filterUsers: ()=>{
	      		let users = vue.storedUsers;
	      		if(vue.userFilter === ""){
	      			vue.users = users;
	      		} else {
	      			let userFilterString = vue.userFilter;
	      			vue.users = users.filter(u => u.username.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1 || u.firstName.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1 ||  u.lastName.toLowerCase().indexOf(userFilterString.toLowerCase()) !== -1);
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