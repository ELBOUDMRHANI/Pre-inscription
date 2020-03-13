
<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        body { font-family: Courier;}

        @page { size: 19cm 15cm landscape  ;margin: 0px;padding: 0px; }


    </style>
</head>


<?php


//$img=file_get_contents('assets/img/bgrecu.png');
//$img3=file_get_contents('assets/img/lef.png');
//$data=base64_encode($img);

//$data3=base64_encode($img3);
$code_etab=0;
        if($cach==true){
switch ($nom_etab) {
    case "Faculté des Sciences et Techniques Errachidia":
        $img="Faculté Polydisciplinaire Errachidia";
        break;
    case "Faculté Polydisciplinaire Errachidia":
        $img=file_get_contents('assets/img/bgrecu fpe.png');;
        break;
    case "Faculté des Sciences Juridiques, Economiques et Sociales Meknès":
        $img=file_get_contents('assets/img/bgrecu fsjes.png');;
        break;
    case "Faculté des Lettres et des Sciences Humaines Meknès":
        $img=file_get_contents('assets/img/bgrecu flsh.png');;
        break;
    case "Faculté des Sciences Meknès":
        $img=file_get_contents('assets/img/bgrecu fs.png');;
        break;
    case "Ecole Supérieure de Technologie Meknès":
        $img=file_get_contents('assets/img/bgrecu estm.png');;
        break;
    case "Ecole Nationale Supérieure des Arts et Métiers Meknès":
        $img=file_get_contents('assets/img/bgrecu ensam.png');;
        break;
    case "Ecole Normale Supérieure de Meknès":
        $img=file_get_contents('assets/img/bgrecu ens.png');;
        break;
    default:
        $nom_etab=file_get_contents('assets/img/bgrecu.png');;
        break;
        }
            $data=base64_encode($img);
        }
        else{
switch ($nom_etab) {
    case "Faculté des Sciences et Techniques Errachidia":
        $img2="Faculté Polydisciplinaire Errachidia";
        break;
    case "Faculté Polydisciplinaire Errachidia":
        $img2=file_get_contents('assets/img/bgrecu fpe ch.png');;
        break;
    case "Faculté des Sciences Juridiques, Economiques et Sociales Meknès":
        $img2=file_get_contents('assets/img/bgrecu fsjes ch.png');;
        break;
    case "Faculté des Lettres et des Sciences Humaines Meknès":
        $img2=file_get_contents('assets/img/bgrecu flsh ch.png');;
        break;
    case "Faculté des Sciences Meknès":
        $img2=file_get_contents('assets/img/bgrecu fs ch.png');;
        break;
    case "Ecole Supérieure de Technologie Meknès":
        $img2=file_get_contents('assets/img/bgrecu estm ch.png');;
        break;
    case "Ecole Nationale Supérieure des Arts et Métiers Meknès":
        $img2=file_get_contents('assets/img/bgrecu ensam ch.png');;
        break;
    case "Ecole Normale Supérieure de Meknès":
        $img2=file_get_contents('assets/img/bgrecu ens ch.png');;
        break;
    default:
        $nom_etab=file_get_contents('assets/img/bgrecu.png');;
        break;
            }

        }
        if($cach==true){
            $data=base64_encode($img);
            }else{
            $data=base64_encode($img2);
        }



?>
<body background="data:image/png;base64,{{$data}}" style="background-repeat: no-repeat;margin-top: 0px;margin-bottom: 0px;">

@foreach($etudiant as $etud)

    <!--<div><img style="margin-left: 300px" src="data:image/png;base64,{{--$data--3}}" style="background-repeat: no-repeat">-->
    <!--<div > <img style="width: 150px;" src="data:image/png;base64,{{--$data2--}}" style="background-repeat: no-repeat"></div>-->

    <div style="padding-top: 100px;padding-right: 40px">
   <h3 style="margin-left: 130px;font-weight: bold"> Certificat d'inscription </h3>
        <div style="margin-left: 35px;font-size: 12px;">
    <div style="margin-top: 20px;" >     <?php if($etud->id==72 || $etud->id==203 || $etud->id==145){?>  L'Administrateur <?php } else{ ?> Le Directeur <?php }?>de l' <span style="font-weight: bold">{{$nom_etab}}</span>, soussigne,</div>
      <div style="margin-top: 20px;">  certifie que: </div>
            <?php if($etud->nom_prenom==true){ ?>  <div style="margin-top: 20px;">M. )Mlle(  <span style="font-weight: bold"> {{$etud->nom_prenom_etud_fr}}</span></div> <?php }?>
            <?php if($etud->cne==true){ ?> <div style="margin-top: 20px;">C.N.E/MASSAR: {{$etud->code_massar}}</div><?php }?>
            <?php if($etud->date_naiss==true){?> <div style="margin-top: 20px;">nÈ )e( le  <span style="font-weight: bold">{{$etud->date_naissance_etud}} </span>  à  <span style="font-weight: bold"> {{$etud->ville_naissance_etud}}</span></div> <?php }?>
            <?php if($etud->diplome==true){?><div style="margin-top: 20px;">est inscrit )e( en  <span style="font-weight: bold">{{$nom_dip}}</span></div><?php }?>
            <?php if($etud->filiere==true){?><div style="margin-top: 20px;">filière:  <span style="font-weight: bold"> {{$filiere[0]->libelle_filiere}}</span>  </div><?php }?>
            <?php if($etud->annee_univ==true){?> <div style="margin-top: 20px;">au titre de l'annèe universitaire:  <span style="font-weight: bold"> 2017/2018 </span> </div><?php }?>
            <div style="margin-left: 310px;">
    <div style="margin-top: 20px;">Meknès, le  <?=date('d/m/Y') ?>  </div>
            </div>

            <div style="font-weight: bold;padding-top:120px; "><?php if($etud->num_dossier==true){?> ND: {{$etud->numero_dossier_inscription}} </div><?php }?>
        <p> <span style="font-weight: bold;" >N.B.</span> Le prèsent certificat n'est dèlivrè qu'en un seul exemplaire.Il appartient à
            l'Ètudiant d'en faire des copies certifiÈes conformes.
        </p>
    </div>



@endforeach
</body>

</html>