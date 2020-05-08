<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calendar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
            include 'celebra.php';
            date_default_timezone_set('Asia/Taipei');
            if(isset($_GET['year'])){
                $year = $_GET['year'];
            }else{
                $year = date('Y');
            }
            if(isset($_GET['mon'])){
                $q = $_GET['mon'];
            }else{
                $q = date('n');
            }
            if($q > 12){
                $year+=1;
                $q=1;
            }
            if($q < 1 ){
             $year-=1;
             $q=12;
            }
           
            $firstDay = date("$year-$q-1");
            $firstDayWeek = date('w',strtotime($firstDay));
            $days = date('t',strtotime($firstDay));
            $monE = date('F',strtotime($firstDay));
            $nextD = 1;
            $preD = date('t',strtotime('-1 month'.$firstDay));
            $between = $firstDayWeek-1;
        ?>
                <div class="cleft">現在:<?=date('Y-m-d')?>、<?=date('H')?>點<?=date('i')?>分</div>
                    <div class="containner">
                        <div class="calendar">
                            <table>
                                <tr>
                                    <td colspan="1">
                                    <a href="index.php?year=<?=$year-1?>&mon=<?=$q?>"><i class="fas fa-arrow-left"></i></a>
                                    </td>
                                    <td colspan="5" class="tyear"><?=$year?>年</td>
                                    <td colspan="1">
                                    <a href="index.php?year=<?=$year+1?>&mon=<?=$q?>"><i class="fas fa-arrow-right"></i></a>
                                    </td>
                                    </tr>
                                    <tr><td colspan="1">
                                    <a href="index.php?year=<?=$year?>&mon=<?=$q-1?>"><i class="fas fa-arrow-left"></i></a>
                                    </td>
                                    <td colspan="5">
                                    <?=$monE?>
                                    </td>
                                    <td colspan="1">
                                    <a href="index.php?year=<?=$year?>&mon=<?=$q+1?>"><i class="fas fa-arrow-right"></i></a>
                                    </td></tr>
                                <tr>
                                    <td style="color:red">SUN</td>
                                    <td>MON</td>
                                    <td>TUE</td>
                                    <td>WED</td>
                                    <td>THU</td>
                                    <td>FRI</td>
                                    <td style="color:red">SAT</td>
                                </tr>
                    <?php
                        for($i=0 ; $i<6 ; $i++){
                            echo "<tr>";
                            for($j=0 ; $j<7 ; $j++){
                                if($i==0 && $j< $firstDayWeek ){
                                    echo "<td class='pass'>".($preD-$between)."</td>";
                                    echo "";
                                    $between--;
                                }else{
                                    $num = $i*7+$j+1-$firstDayWeek;
                                    if($num<=$days){
                                            if($j==6 || $j==0){ 
                                                echo "<td style='color:red'>$num";
                                                if(!empty($cele[$q][$num])){
                                                    echo "<br>";
                                                    print_r($cele[$q][$num]);
                                                    echo "</td>";
                                                }else{
                                                    echo "</td>";
                                                }
                                            }else{
                                                echo "<td>$num";
                                                if(!empty($cele[$q][$num])){
                                                    echo "<br>";
                                                    print_r ($cele[$q][$num]);
                                                    echo "</td>";
                                                }else{
                                                    echo "</td>";
                                                }
                                            }
                                    }else{
                                        echo "<td class='pass'>".$nextD."</>";
                                        $nextD++;
                                    }
                                }   
                            }
                            echo "</tr>";
                        }
                        
                    ?>          
                </table>
            </div>

        </div>
    </body>
</html>