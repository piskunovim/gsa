<?php
if(isset($_SESSION["loggedin"])){
?>
<br><br><br>
<div class="container">
<h1>Child sheet</h1>
<main id="app">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Period</th>
      <th scope="col">Presence</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2018-10-11</td>
      <td>Here I Want To Clarify Data</td>
      <td>How Do You Want To See</td>
    </tr>
    <tr>
      <td>2018-10-11</td>
      <td>10:00am - 10:30am</td>
      <td>History</td>
    </tr>
    <tr>
      <td>2018-10-11</td>
      <td>10:30am - 11:00am</td>
      <td>Art</td>
    </tr>
  </tbody>
</table>
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
        childSheetName: "",
        userId: "<?= $_SESSION["id"] ?>"
      },
      methods: {
        getChildSheet: () =>{
          $.ajax({
              url: '/api/childSheet/read.php?userId='+vue.userId,
              type: 'GET',
            }).done(function(data) {
              if(data !== "null"){
                if(data.length > 0){
                  vue.childSheet = JSON.parse(data);
                }
              }
            })
            .fail(function(err) {
              alert("Something went wrong. Please, reload the page.");
              console.log(JSON.stringify(err))
            });
        }
      },
        /* Initial loading */
        created: ()=>{
          $.ajax({
              url: '/api/childSheet/read.php?userId=<?= $_SESSION["id"] ?>',
              type: 'GET',
            }).done(function(data) {
              console.log(data);
              if(data !== "null"){
                if(data.length > 0){
                  vue.childSheet = JSON.parse(data);
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