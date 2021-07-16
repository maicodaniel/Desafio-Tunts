<?php
include '../vendor/autoload.php';

$stud = array();
$sit;
$situation;
$spreadsheetId = "1J-Uq9uECSjjNztaQ5OUltkcI7QLc3_0qv0LhLIWyYtc";
$sheet = new Control\ClientSpread();
$qtd = $sheet->readSheet($spreadsheetId,"engenharia_de_software","A2:H2");
$data = $sheet->readSheet($spreadsheetId,"engenharia_de_software","A4:H");
$g = 4;
$h = 4;  
$qtd_lessons =  substr($qtd[0][0], -2);    
$qtd_lessons = intval($qtd_lessons);
$max_faults = $qtd_lessons/4;


    foreach ($data as $datas ) {
    
    $sit = ($datas[3] + $datas[4] + $datas[5])/3;
    
    $faults = intval($datas[2]);

        if ($faults > $max_faults) {
            $situation= "Reprovado por falta"; 
            $naf =0;
        }else{
            if ($sit < 50) {
                $situation= "Reprovado por nota"; 
                $naf =0;
            }elseif ($sit >= 50 && $sit< 70) {
                $situation = "Exame final";
                $naf = 100 - (ceil($sit)) ;
            }elseif ($sit > 70) {
                $situation = "Aprovado";
                $naf =0;
            }
        }
    
        $range ="G".$g.":H".$h;
        $att = $sheet->updateSheet($spreadsheetId, $range, [$situation, $naf] );
        $g++;
        $h++;    
    }
    $data = $sheet->readSheet($spreadsheetId,"engenharia_de_software","A4:H");
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
    <h1>Engenharia de Software</h1><hr>
    <div class="col-8 m-auto text-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Matricula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Faltas</th>
                    <th scope="col">P1</th>
                    <th scope="col">P2</th>
                    <th scope="col">P3</th>
                    <th scope="col">Situacão</th>
                    <th scope="col">Nota para aprovação final</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $datas) {
            ?>
            <tr>
                    <th scope="row"><?php echo $datas[0]; ?></th>
                    <td><?php echo $datas[1]; ?></td>
                    <td><?php echo $datas[2]; ?></td>
                    <td><?php echo $datas[3]; ?></td>
                    <td><?php echo $datas[4]; ?></td>
                    <td><?php echo $datas[5]; ?></td>
                    <td><?php echo $datas[6]; ?></td>
                    <td><?php echo $datas[7]; ?></td>
                    
                </tr>
            <?php
                
            }
            ?>
            </tbody>
        </table>
        <div>
            <a href=#><button onclick="window.location.reload()">Atualizar</button></a>
            <a href="../index.php"><button>Voltar</button></a>
        </div>
    </div>
</body>
</html>



