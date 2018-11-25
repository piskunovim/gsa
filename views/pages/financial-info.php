<?php
if(isset($_SESSION["loggedin"])){
?>
<br><br><br>
<main id="app">
<div class="container">
<h1>Financial info</h1>
<h4 v-if="invoiceName">Child: {{ invoiceName }}</h4>
<div class="invoice" v-if="invoices.length > 0">
	<div v-for="i in invoicesShow">
		<p>{{ i.years }}</p>
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
<div v-if="pageCount>0">
	<button @click="prevPage" :disabled="pageNumber==0" v-on:click="paginatedData">
		Previous
	</button>
	<button @click="nextPage" :disabled="pageNumber >= pageCount -1" v-on:click="paginatedData">
	    Next
	</button>
</div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<script>
    let vue = new Vue({
      el: '#app',
      data: {
        invoices:[],
        invoicesShow: [],
        invoiceName: "",
        childId: "<?= $_SESSION["childId"] ?>",
        size: 5,
        pageNumber: 0,
        pageCount: 0
      },
      methods: {
        nextPage: ()=>{
          vue.pageNumber++;
        },
        prevPage: ()=>{
          vue.pageNumber--;
        },
        getPageCount: ()=>{
          let ch = vue.invoices.length,
              s = vue.size;
          return Math.floor(ch/s);
        },
        paginatedData: ()=>{
          const start = vue.pageNumber * vue.size,
                end = start + vue.size;
          vue.invoicesShow = vue.invoices.slice(start, end);
        }
      },
        /* Initial loading */
        created: ()=>{
          $.ajax({
              url: '/api/invoice/read.php?childId=<?= $_SESSION["childId"] ?>',
              type: 'GET',
            }).done(function(data) {
              if(data !== "null"){
                if(data.length > 0){
                  vue.invoices = JSON.parse(data);
                  vue.paginatedData();
                  vue.pageCount = vue.getPageCount();
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            });

            $.ajax({
              url: '/api/children/read.php?childId=<?= $_SESSION["childId"] ?>',
              type: 'GET',
            }).done(function(data) {
              //console.log(data);
              if(data !== "null"){
                if(data.length > 0){
                  const child = JSON.parse(data);
                  vue.invoiceName = child.firstName + " " + child.lastName;
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            });
        }
    });
</script>


<?php
} else {
  header("location: /404");
}
?>