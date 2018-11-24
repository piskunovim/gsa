<?php
if(isset($_SESSION["loggedin"])){
?>
<br><br><br>
<div class="container">
<h1>Financial info</h1>


<h3>Child: Samantha Shaw</h3>

<div>
	<p>2017/2018</p>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col" class="bg-warning">Term 1</th>
	      <th scope="col" class="bg-warning">Term 2</th>
	      <th scope="col" class="bg-warning">Term 3</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	    </tr>
	    <tr>
	      <td><span class="text-success">Paid</span></td>
	      <td><span class="text-warning">Partialy Paid (47,000)</span></td>
	      <td><span class="text-danger">Unpaid</span></td>
	    </tr>
	    <tr>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	    </tr>
	  </tbody>
	</table>
</div>

<div>
	<p>2016/2017</p>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col" class="bg-warning">Term 1</th>
	      <th scope="col" class="bg-warning">Term 2</th>
	      <th scope="col" class="bg-warning">Term 3</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	    </tr>
	    <tr>
	      <td><span class="text-success">Paid</span></td>
	      <td><span class="text-success">Paid</span></td>
	      <td><span class="text-success">Paid</span></td>
	    </tr>
	    <tr>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	    </tr>
	  </tbody>
	</table>
</div>

<div>
	<p>2015/2016</p>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col" class="bg-warning">Term 1</th>
	      <th scope="col" class="bg-warning">Term 2</th>
	      <th scope="col" class="bg-warning">Term 3</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	      <td>GYD 60,000</td>
	    </tr>
	    <tr>
	      <td><span class="text-success">Paid</span></td>
	      <td><span class="text-success">Paid</span></td>
	      <td><span class="text-success">Paid</span></td>
	    </tr>
	    <tr>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	      <td><a href="#">View Invoice</a></td>
	    </tr>
	  </tbody>
	</table>
</div>



</div>

<?php
} else {
  header("location: /404");
}
?>