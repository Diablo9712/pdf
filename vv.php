<?php 


$x = 3; 

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
         $sql = "select users.id,users.fullname,users.address,users.phone,users.email,reservations.date_debut,reservations.date_fin,rooms.number,tarifs.prix,categories.libelle ,datediff(reservations.date_fin,reservations.date_debut)as jours from users,reservations,saisons,categories,tarifs,rooms where users.id = reservations.clientId and reservations.RoomId = rooms.id and rooms.CatId = categories.id and saisons.id=tarifs.saisonId and tarifs.CatId= categories.id and reservations.clientId=users.id and reservations.id  = $x";
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
    $room =     $row['number'];
    $tarifs= $row['prix'];
    $categories = $row['libelle'];
    $jours = $row['jours'];


            }
         } else {
            echo "0 results";
         }
         mysqli_close($conn);


  
 
   
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';
      $content .= '<style>'.file_get_contents(_BASE_PATH.'style.css').'</style>';
  
      $content .= '  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br /> 
      <div class="container"> 
                         <br />
                    
                         <br />
                    
                         <br />
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
                                                                 <strong> ';echo $name .'</strong>
                                                                 </div>
                                                                 <div>Addresse : '; echo $adresse.'</div>
                                                                 <div>Email :  ';echo $mail.'</div>
                                                                 <div>Phone:   ';echo $phone.'</div>
                                                                 </div>



                                                                 </div>
                                        '; $v = 1; echo '
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
                                                       <td class="center">'; echo $v; $v++; echo '</td>
                                                       <td class="left strong">'; echo $debut . '</td>
                                                       <td class="left">'; echo $fin .'</td>
                                                       <th class="left">'; echo $room .'</th>
                                                       <th class="left">'; echo $categories .'</th>
                                                       <th class="left">'; echo $jours .'</th>
                                                       <td class="center">'; echo $tarifs .' DH</td>
                                                       <td class="right">'; echo $tarifs * $jours;  $total = $tarifs * $jours; echo ' DH</td>

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

                                                            </tr>'; echo $b=1 .'

                                                            </thead>


                                                            <tbody>



                                                            ';

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

                                                            echo '
                                                            <tr>
                                                            <td class="center">';  echo $b; $b++; echo '</td>
                                                            <td class="left strong">';  echo $libelle . '</td>
                                                            <td class="left">';  echo $prix .'  DH</td>


                                                            </tr>
                                                            ';

                                                            }
                                                            } else {
                                                            echo "0 results";
                                                            }
                                                            mysqli_close($conn);

                                                            echo '

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
                                                                      <td class="right">';  echo $total .' DH</td>
                                                                      </tr>

                                                                      <tr>
                                                                      <td class="left">
                                                                      <strong>TVA (20%)</strong>
                                                                      </td>
                                                                      ';  $tva = $total * 0.2; echo ' 
                                                                      <td class="right">'; echo $tva .' DH</td>
                                                                      </tr>
                                                                      <tr>
                                                                      <td class="left">
                                                                      <strong>Total</strong>
                                                                      </td>
                                                                      <td class="right">
                                                                      <strong>';  echo $tva + $total .' DH</strong>
                                                                      '; $sfl = $tva + $total; echo '
                                                                      <input type="hidden" id="sfl" value="'; echo $sfl .'">
                                                                      </td>
                                                                      </tr>
                                                                      </tbody>
                                                                      </table>

                                                                      </div>


                                                            </div>

                                        </div>

</div>
                                        ';
                                        echo '
                                       
                                             
                                             ';  
                         $content .= '</div>
      </div>
      ';  
      $obj_pdf->file_get_contents('style.css');
     // $obj_pdf->WriteHTML($stylesheet,1)
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Export HTML Table data to PDF using TCPDF in PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <div class="table-responsive">  
                
                   
                     <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  