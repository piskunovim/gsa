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

			  </div><!-- Users ends -->
			  <div class="tab-pane fade" id="nav-children" role="tabpanel" aria-labelledby="nav-children-tab">
			  	<h3>Children admin panel comming soon</h3>
			  </div>
			  <div class="tab-pane fade" id="nav-guardians" role="tabpanel" aria-labelledby="nav-guardians-tab">
			  	<h3>Guardians admin panel comming soon</h3>
			  </div>
			</div>

		</div>

		<!-- Modals -->
		<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 v-if="editUser==0" class="modal-title" id="userModalLabel">Добавить страницу</h5>
		        <h5 v-else class="modal-title" id="userModalLabel">Редактировать страницу</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearModal">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	 <div class="form-group">
			      	 <label for="username">Username</label> 
			         <input type="text" class="form-control" id="username"  v-model="newUser.username" placeholder="johnDoe">
			     </div>
		      	 <div class="form-group">
			      	 <label for="firstName">First Name</label> 
			         <input type="text" class="form-control" id="firstName"  v-model="newUser.firstName" placeholder="John">
			     </div>
			     <div class="form-group">
			      	 <label for="lastName">Last Name</label> 
			         <input type="text" class="form-control" id="lastName"  v-model="newUser.lastName" placeholder="Doe">
			     </div>
			     <div class="form-group">
			      	 <label for="email">Email</label> 
			         <input type="text" class="form-control" id="email"  v-model="newUser.email" placeholder="your@email.com">
			     </div>
			     <div class="form-group">
			      	 <label for="addressLine1">Address Line 1</label> 
			         <input type="text" class="form-control" id="addressLine1"  v-model="newUser.addressLine1" placeholder="445 Mount Eden Road, Mount Eden, Auckland">
			     </div>
			     <div class="form-group">
			      	 <label for="addressLine2">Address Line 2</label> 
			         <input type="text" class="form-control" id="addressLine2"  v-model="newUser.addressLine2">
			     </div>
			     <div class="form-group">
			      	 <label for="phoneNumber">Phone Number</label> 
			         <input type="text" class="form-control" id="phoneNumber"  v-model="newUser.phoneNumber">
			     </div>
			     <div class="form-group">
			      	 <label for="familyType">Family Type</label> 
			         <input type="text" class="form-control" id="familyType"  v-model="newUser.familyType">
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
			      	 <label for="password">Password</label> 
			         <input type="password" class="form-control" id="password"  v-model="newUser.newPassword">
			     </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearModal">Close</button>
		        <button v-if="editUser==0" type="button" class="btn btn-primary add-vacancy" v-on:click="addUser">Submit</button>
		        <!-- editUser hidden by default -->
		        <button v-if="editUser>0" type="button" class="btn btn-primary" v-on:click="updateUser">Update User</button>
		      </div>
		    </div>
		  </div>
		</div>

	</main>
	
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<script type="text/javascript">

		$(function(){		
			$('.nav-tabs .nav-item a').click(function (e) {
				e.preventDefault()
				$(this).tab('show')
			});
		});
		
	    let vue = new Vue({
	      el: '#app',
	      data: {
	          users:[],
	          storedUsers: [],
	          userFilter: "",
	          newUser: {}, // used for editing too
	          editUser: 0
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
	      			vue.clearModal();  
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
	      			vue.clearModal();
	      		})
	      		.fail(function() {
	      			alert("Failed to update user. Please, try again.");
	      		});
	      		$("#newUserModal").modal("hide");
	      		vue.updateUserList();
	      		
	      	},
	      	/* Two methods to show correct button in the modal form */
	      	showEditUserModal: (user) =>{
	      		vue.clearModal();
	      		vue.editUser = 1;
	      		vue.newUser = JSON.parse(JSON.stringify(user));

	      		$("#newUserModal").modal("show");
	      	},
	      	showAddUserModal: () =>{
	      		// TODO: make clearModal somewhere in one place
	      		vue.clearModal();
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
	      	clearModal: ()=>{
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
	      	}
	      },
	      /* Initial loading */
	      created: ()=>{	
	      		$.get('/api/user/read.php').done(function(data) {
	      			if(data.length > 0){
	      				vue.users = JSON.parse(data);
	      				vue.storedUsers = JSON.parse(data);
	      			}
	      		})
	      		.fail(function(err) {
	      			alert(JSON.stringify(err));
	      		}); 
	      }
	    });
	</script>