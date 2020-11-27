<?php  
 global $x ;
 global $id ;
 global $total ;
 global $prix ;
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
 function fetch_data()  
 {  $x = 3;
    $d = 0;
    $total =0;
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "test-hotel");  
      $sql = "select users.id,users.fullname,users.address,users.phone,users.email,reservations.date_debut,reservations.date_fin,rooms.number,tarifs.prix,categories.libelle ,datediff(reservations.date_fin,reservations.date_debut)as jours from users,reservations,saisons,categories,tarifs,rooms where users.id = reservations.clientId and reservations.RoomId = rooms.id and rooms.CatId = categories.id and saisons.id=tarifs.saisonId and tarifs.CatId= categories.id and reservations.clientId=users.id and reservations.id  = $x";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
          $id =$row['id'];
          $prix = $row['prix'];
          $name = $row['fullname'];
          $adresse= $row['address'];
          $mail = $row['email'];
          $phone = $row['phone'];
         

      $output .= '<tr>  
                          <td>'.$row["id"].'</td>  
                          <td>'.$row["fullname"].'</td>  
                         
                        
                        
                          <td>'.$row["date_debut"].'</td>  
                          <td>'.$row["date_fin"].'</td>  
                          <td>'.$row["number"].'</td>  
                          <td>'.$row["prix"].'</td>  
                          <td>'.$row["libelle"].'</td>
                          <td>'.$row["jours"].'</td> 
                     </tr>  
                          ';  
      }  

      $output .= '</table>';

      $x = 3;
    
     
      $sqll = "SELECT services.description,Services.prix FROM `service__demandes`,services,users WHERE services.id = service__demandes.ServiceId and users.id= service__demandes.clientId and users.id= 5";  
      $resultt = mysqli_query($connect, $sqll); 
      $output .= '
      <h3 style="color:red">Services Demander</h3>
      <div class="container" style="width:500px;">
      
      <table class="table" style="width:300px;margin-left:250px" border="1" cellspacing="0" cellpadding="5"> 
      <thead class="thead-dark"> 
           <tr>  
                <th width="10%">ID</th>  
                <th width="40%">Service</th>  
               
              
               
                <th width="50%">Prix</th>  
               
           </tr>
           </thead><tbody>
           ';
      while($rowt = mysqli_fetch_array($resultt))  
      {       
          $d++;
          $prix=$rowt['prix'];
          $total = $total + $prix;
      $output .= '<tr>  
                         <td width="10%">'.$d.'</td>
                          <td width="40%">'.$rowt["description"].'</td>  
                          <td width="50%">'.$rowt["prix"].'</td>  
                         
                        
                        
                          
                     </tr>  
                          ';  
      } 

      $output .= '</tbody></table>
      
      <div style="margin-left:500px;">
      <h4 style="color:red">Total :'.  $total. ' DH</h4>
      </div>
      </div>';

      return $output;  
 }  

 function fetch_data_service()  
 {   
      return $output;  
 }  
 
$x = 3;
 $connect = mysqli_connect("localhost", "root", "", "test-hotel");  
 $sql = "select users.id,users.fullname,users.address,users.phone,users.email,reservations.date_debut,reservations.date_fin,rooms.number,tarifs.prix,categories.libelle ,datediff(reservations.date_fin,reservations.date_debut)as jours from users,reservations,saisons,categories,tarifs,rooms where users.id = reservations.clientId and reservations.RoomId = rooms.id and rooms.CatId = categories.id and saisons.id=tarifs.saisonId and tarifs.CatId= categories.id and reservations.clientId=users.id and reservations.id  = $x";  
 $result = mysqli_query($connect, $sql);  
 while($row = mysqli_fetch_array($result))  
 {       
     $id =$row['id'];
     $prix = $row['prix'];
     $name = $row['fullname'];
     $adresse= $row['address'];
     $mail = $row['email'];
     $phone = $row['phone'];
    
 
 }
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Facture ");  
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
      $obj_pdf->SetAutoPageBreak(TRUE, 0);
      $content = '';  
      $content .= '  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


      <style type="text/css">
      h4 {
          margin-left: 250px;
          padding:0
      }
      </style>

      <h3 align="center">Hotel Mirage - Invoice</h3><br /><br />  


      <div class="col-sm-6">
      <h6 class="mb-3">To:</h6>
      <div>
      <strong>Fullname : ' .$name .'</strong>
      </div>
      <div>Addresse : ' .$adresse.'</div>
      <div>Email :  ' .$mail.'</div>
      <div>Phone:   '. $phone.'</div>
      </div>

      <table class="table" border="1" cellspacing="0" cellpadding="5"> 
      <thead class="thead-dark"> 
           <tr>  
                <th width="5%">ID</th>  
                <th width="20%">name</th>  
               
              
               
                <th width="15%">Debut</th>  
                <th width="15%">fin</th>  
                <th width="10%">Room</th>  
                <th width="10%">Prix</th>  
                <th width="15%">Category</th> 
                <th width="10%">Days</th> 
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= ''; 
     
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
           
      </body>  
 </html>  