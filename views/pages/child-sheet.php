<?php
if(isset($_SESSION["loggedin"])){
?>
<br><br><br>
<div class="container">
<h1>Child sheet</h1>
<main id="app">
<h4 v-if="childSheetName">Child: {{ childSheetName }}</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Period</th>
      <th scope="col">Presence</th>
    </tr>
  </thead>
  <tbody>
    <tr  v-for="ch in childSheetShow">
      <td>{{ ch.date || "Not set" }}</td>
      <td>{{ ch.period || "Not set" }}</td>
      <td>{{ ch.presence || "Not set" }}</td>
    </tr>
  </tbody>
</table>
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
        childSheet:[],
        childSheetShow: [],
        childSheetName: "",
        childId: "<?= $_SESSION["childId"] ?>",
        size: 20,
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
          let ch = vue.childSheet.length,
              s = vue.size;
          return Math.floor(ch/s);
        },
        paginatedData: ()=>{
          const start = vue.pageNumber * vue.size,
                end = start + vue.size;
          vue.childSheetShow = vue.childSheet.slice(start, end);
        }
      },
        /* Initial loading */
        created: ()=>{
          $.ajax({
              url: '/api/childSheet/read.php?childId=<?= $_SESSION["childId"] ?>',
              type: 'GET',
            }).done(function(data) {
              if(data !== "null"){
                if(data.length > 0){
                  vue.childSheet = JSON.parse(data);
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
                  vue.childSheetName = child.firstName + " " + child.lastName;
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