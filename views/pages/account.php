<?php
if(isset($_SESSION["loggedin"])){
?>
<br><br><br>
<div class="container">
<h1>Account Info</h1>
<main id="app">


<div v-if="user">
	<h4>User</h4>
	<div v-if="user.username">Your username: {{ user.username}}</div>
	<div v-if="user.firstName">First Name: {{ user.firstName}}</div>
	<div v-if="user.lastName">Last Name: {{ user.lastName}}</div>
	<div v-if="user.addressLine1">Address Line 1: {{ user.addressLine1}}</div>
	<div v-if="user.addressLine2">Address Line 2: {{ user.addressLine2}}</div>
	<div v-if="user.city">City: {{ user.city}}</div>
	<div v-if="user.phoneNumber">Phone Number: {{ user.phoneNumber}}</div>
	<div v-if="user.familyType">Address Line 1: {{ user.familyType}}</div>
	
</div>
<br>
<div v-if="child">
	<h4>Child</h4>
	<div v-if="child.firstName">First Name: {{ child.firstName}}</div>
	<div v-if="child.lastName">Last Name: {{ child.lastName}}</div>
	<div v-if="child.dateOfBirth">Date Of Birth: {{ child.dateOfBirth}}</div>
	<div v-if="child.dateOfEntry">Date of Entry: {{ child.dateOfEntry}}</div>
	<div v-if="child.phoneNumber">Phone Number: {{ child.phoneNumber}}</div>
</div>
<br>
<div v-if="guardians">
	<h4>Guardians</h4>
	<div v-for="g in guardians" style="margin:30px 0px;">
		<div v-if="g.firstName">First Name: {{ g.firstName}}</div>
		<div v-if="g.lastName">Last Name: {{ g.lastName}}</div>
		<div v-if="g.phoneNumber">Phone Number: {{ g.phoneNumber}}</div>
		<div v-if="g.familyType">Family Type: {{ g.familyType}}</div>
	</div>
</div>

<br>
<em>(account support email: <?= CONST_SUPPORT_EMAIL ?> )</em>


</main>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<script>
    let vue = new Vue({
      el: '#app',
      data: {
      	user: "",
      	child: "",
      	guardians: []
      },
      methods: {
        
      },
        /* Initial loading */
        created: ()=>{
          $.ajax({
              url: '/api/user/read.php',
              type: 'GET',
            }).done(function(data) {
              if(data !== "null"){
                if(data.length > 0){
                  vue.user = JSON.parse(data);
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            });

            $.ajax({
              url: '/api/children/read.php',
              type: 'GET',
            }).done(function(data) {
              //console.log(data);
              if(data !== "null"){
                if(data.length > 0){
                  const child = JSON.parse(data);
                  vue.child = child;
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            });

            $.ajax({
              url: '/api/appointment/read.php',
              type: 'GET',
            }).done(function(data) {
              //console.log(data);
              if(data !== "null"){
                if(data.length > 0){
                  const guardians = JSON.parse(data);
                  vue.guardians = guardians;
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            })
        }
    });
</script>
<?php
} else {
  header("location: /404");
}
?>