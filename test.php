
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<div class="container">    
     <br />
    
     <br />
   
     <br />
     
     <?php $x = 3; 

     ?>
     <br>
   <div class="table-responsive">









   <div class="container">
  <div class="card">
<div class="card-header">
Invoice
<strong><?php $d=strtotime("today");
echo date("Y-m-d ", $d);?> </strong> 
  <span class="float-right"> <strong>Status:</strong> Pending</span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>
<strong>HOTEL MIRAGE</strong>
</div>
<div>QUARTIER ADARISSA </div>
<div>RUE 1 N 91, BENI MELLAL</div>
<div>Email: hotelmirage@gmail.com</div>
<div>Phone: +212 6.15.17.51.74</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>

<?php
$total = 0;
$name=null;
$adresse=null;
$mail=null;
$phone=null;
$debut=null;
$fin=null;
$room=null;
$tarifs=null;
$categories=null;
$jours = null;
$id=null;
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'test-hotel';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }
         $sql = "select users.id,users.fullname,users.address,users.phone,users.email,reservations.date_debut,reservations.date_fin,reservations.RoomId,tarifs.prix,categories.libelle ,datediff(reservations.date_fin,reservations.date_debut)as jours from users,reservations,saisons,categories,tarifs,rooms where users.id = reservations.clientId and reservations.RoomId = rooms.id and rooms.CatId = categories.id and saisons.id=tarifs.saisonId and tarifs.CatId= categories.id and reservations.clientId=users.id and reservations.id  = $x";
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id=$row['id'];
                $name=$row['fullname'];
    $addresse=$row['address'];
    $mail=$row['email'];
    $phone=$row['phone'];
    $debut =     $row['date_debut'];
    $fin =     $row['date_fin'];
    $room =     $row['RoomId'];
    $tarifs= $row['prix'];
    $categories = $row['libelle'];
    $jours = $row['jours'];


            }
         } else {
            echo "0 results";
         }
         mysqli_close($conn);
      ?>

<strong><?php echo $name;?></strong>
</div>
<div>Addresse : <?php echo $adresse;?></div>
<div>Email : <?php echo $mail;?></div>
<div>Phone:  <?php echo $phone;?></div>
</div>



</div>
<?php $v = 1;?>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Date Debut </th>
<th>Date Fin</th>

<th class="right">Chambre</th>
<th class="right">Categorie</th>
<th class="right">Jours</th>
  <th class="center">Prix</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
<tr>
<td class="center"><?php echo $v; $v++;?></td>
<td class="left strong"><?php echo $debut;?></td>
<td class="left"><?php echo $fin;?></td>
<th class="left"><?php echo $room;?></th>
<th class="left"><?php echo $categories;?></th>
<th class="left"><?php echo $jours;?></th>
<td class="center"><?php echo $tarifs;?>DH</td>
  <td class="right"><?php echo $tarifs * $jours;  $total = $tarifs * $jours;?> DH</td>

</tr>

</tbody>
</table>
</div>
<h3>Service Demander</>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Service </th>
<th>Prix</th>

</tr><?php $b=1;?>
</thead>
<tbody>
<?php
//$total = 0;
$libelle=null;
$prix=null;

         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'test-hotel';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }
         $sql = "SELECT services.description,Services.prix FROM `service__demandes`,services,users WHERE services.id = service__demandes.ServiceId and users.id= service__demandes.clientId and users.id= $id";
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                //$id=$row['id'];
                $libelle=$row['description'];
    $prix=$row['prix'];
  
$total = $total + $prix;

       
      ?>

<tr>
<td class="center"><?php echo $b; $b++;?></td>
<td class="left strong"><?php echo $libelle;?></td>
<td class="left"><?php echo $prix;?> DH</td>


</tr>
<?php      }
         } else {
            echo "0 results";
         }
         mysqli_close($conn);?>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right"><?php echo $total;?> DH</td>
</tr>

<tr>
<td class="left">
 <strong>TVA (20%)</strong>
</td>
<?php $tva = $total * 0.2; ?> 
<td class="right"><?php echo $tva;?> DH</td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong><?php echo $tva + $total;?> DH</strong>
<?php $sfl = $tva + $total;?>
<input type="hidden" id="sfl" value="<?=$sfl?>">
</td>
</tr>
</tbody>
</table>

</div>


</div>

</div>
</div>
</div>
