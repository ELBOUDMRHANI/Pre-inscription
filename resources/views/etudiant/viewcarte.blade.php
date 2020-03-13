<?php use App\Arch; use Milon\Barcode\DNS2D;?>
<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-32"/>

    <style>
        body { font-family: DejaVu Sans,  sans-serif;font-size: 8px }

        @page { size: 5.4cm 8.6cm landscape  ;margin: 0px;padding: 0px; }


    </style>
</head>


<?php
$img = file_get_contents('assets/img/user.png');

// Encode the image string data into base64
$data = base64_encode($img);
$img2=file_get_contents('assets/img/tempp.png');
$data2=base64_encode($img2);

?>
<body background="data:image/png;base64,{{$data2}}" style="background-repeat: no-repeat">
@foreach($etudiant as $etud)

    <div  class="card border-dark mb-3" >

        <!--  <div class="card-header"></div>-->

        <div class="card-body text-dark">
            <p style="margin-top: 20px">

            <div style="color:#7698c0 ;font-weight: bold; font-size: 15px;margin-top: 100px;margin-left:100px " class="card-title" > {{$etud->nom_etudiant_fr}} {{$etud->prenom_etudiant_fr}}</div>
            <div style=" color:#7698c0 ;font-size: 8px;margin-top: 5px;margin-left:100px " > Ne le {{$etud->date_naissance_etud}} a {{$etud->ville_naissance_etud}}</div>

            @foreach($filiere as $fil)
                <div style="color :#c08530;font-weight: bold; font-size: 8px;margin-left:90px;margin-top: 8px " > LICENCE D'ETUDES FONDAMENTLES</div>

                <div style="color :#40b1c0;font-weight: bold; font-size: 8px;margin-left:90px;margin-top: 5px;margin-bottom: -40px " > {{$fil->libelle_filiere}}</div>

            @endforeach

            <img src="data:image/png;base64,{{$data}}" class="card-img" style="width: 60px;height: 60px;margin-left: 15px;margin-bottom: 2px ;margin-top: -20px;">


            <!--<img src="https://i.ibb.co/31GyyYN/user.png" class="card-img" style="width: 60px;height: 60px;margin-left: 15px;margin-bottom: 2px">-->
            <?php
            /* function rome($N){
                if($N=='٥') echo 3 ;

             }
             function number2farsi($srting)
             {
                 $Persian_Number = str_replace(
                         array('۰','۱','۲','۳','٤','۵','۶','۷','۸','۹'),
                         array('0','1','2','3','4','5','6','7','8','9'),
                         $srting);
                 return $Persian_Number;
             }*/

            // $code = preg_split('//',$etud->cne);
            ?>

            <div style="margin-left: 10px;margin-top: -30px;margin-bottom: 2px;font-size: 7px">

                <br style="margin-top:-20px;margin-bottom: 5px;">CODE <span style="font-weight: bold">{{$etud->code_massar}}</span>
                <br style=";margin-top:0px;"> CIN <span style="font-weight: bold">{{$etud->cni_etudiant}}</span>
                <br style="margin-top:0px;">N D <span style="font-weight: bold">{{$etud->code_massar}}</span></div>
            <div style="padding-left: 170px;padding-top: 5px"> PREMIERE iNSCRIPTION 2018/2019</div>


            <img src="data:image/png;base64,' . {{DNS2D::getBarcodePNG("4", "PDF417")}} . '" alt="barcode"  width="150px" height="26px" style="margin-left: 5px;margin-top: -6px" />

            <div style="margin-left: 25px;margin-top:-5px;font-size: 12px;">  {{$etud->code_massar}}</div>
            </p>
        </div>
    </div>

    </div>
@endforeach
</body>

</html>