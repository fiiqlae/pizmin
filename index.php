<?php
function makeTable($cube, $num) {
	$z = 0;
	$p;
	echo '<table border="0" bgcolor="#000000">
    	<tbody>
    	<tr bgcolor="white" align="center" rowspan="1">
    	<td>C' . $num . '*C' . $num . '<br></td>';
	for ($i = 0;$i < count($cube);$i++) {
		echo '<td>' . $cube[$i] . '<br></td>';
	}
	echo '</tr>';
	for ($i = 0;$i < count($cube);$i++) {
		echo '<tr bgcolor="white" align="center" rowspan="1">
        	<td>' . $cube[$i] . '<br></td>';
		for ($j = 0;$j < count($cube);$j++) {
			if ($i == $j) {
				echo '<td>-</td>';
				continue;
			}
			if ($j > $i) {
				echo '<td><br></td>';
				continue;
			}
			$r = 0;
			$str = '';
			for ($q = 0;$q < strlen($cube[$i]);$q++) {
				$str[$q] = $cube[$i][$q];
				if (('x' == $cube[$i][$q] || 'x' == $cube[$j][$q]) && $cube[$j][$q] != $cube[$i][$q]) {
					$r = - 1;
					break;
				}
				if ($cube[$j][$q] != $cube[$i][$q]) {
					$r++;
					$str[$q] = 'x';
				}
			}
			if ($r == 1) {
				$p[$j] = 1;
				$p[$i] = 1;
				$b = 1;
				for ($d = 0;$d < count($cube1);$d++) if ($cube1[$d] == $str) {
					$b = 0;
					break;
				}
				if ($b) {
					echo '<td>' . $str . '</td>';
					$cube1[$z] = $str;
					$z++;
				}
				else echo '<td><br></td>';
			}
			else echo '<td><br></td>';
		}
		echo '</tr>';
	}
	echo '</tbody>
	</table>';
	$Zlen = 0;
	for ($i = 0;$i < count($cube);$i++) {
		if ($p[$i] == 0) $Z[$Zlen++] = $cube[$i];
	}
	if ($Zlen > 0){
		echo '?? ???????????:<br>';
		for ($i = 0; $i < $Zlen; $i++)
			echo $Z[$i] . '<br>';
	}
	$ans = array ($cube1, $Z);
	return $ans;
}

function make($code) {
	$L;
	$N;
	$l=0;
	$n=0;
	echo '<table border="0" bgcolor="#000000">
    	<tbody>
    	<tr bgcolor="white" align="center" rowspan="1">
    	<td>a1</td><td>a2</td><td>b1</td><td>b2</td><td>&nbsp;p&nbsp;</td><td>&nbsp;?&nbsp;</td><td>S1</td><td>S2</td><td>???????????</td></tr>';
	for ($i = 0;$i < 16;$i++) {
		for ($p = 0; $p < 2; $p++){
			$s1 = array_search((($i / 8) % 2).(($i / 4) % 2), $code);
			$s2 = array_search((($i / 2) % 2).(($i / 1) % 2), $code);
			$r = $s1 + $s2 + $p;
			if ($s2 < 2) echo '<tr bgcolor="white" align="center" rowspan="1">';
			else echo '<tr bgcolor="gray" align="center" rowspan="1">';
			
			echo '<td>'.(($i / 8) % 2).'<br></td>';
			echo '<td>'.(($i / 4) % 2).'<br></td>';
			echo '<td>'.(($i / 2) % 2).'<br></td>';
			echo '<td>'.(($i / 1) % 2).'<br></td>';	
			echo '<td>'.$p.'<br></td>';
			if ($s2 < 2)echo '<td>'.((int) ($r / 4)).'<br></td>';
			else echo '<td>X<br></td>';
			if ($s2 < 2)echo '<td>'.($code[$r % 4][0]).'<br></td>';
			else echo '<td>X<br></td>';
			if ($s2 < 2)echo '<td>'.($code[$r % 4][1]).'<br></td>';
			else echo '<td>X<br></td>';
			echo '<td>'.$s1.' + '.$s2.' + '.$p.' = '.((int) ($r / 4)).($r % 4).'<br></td>';
			echo '</tr>';	
			if ($s2 < 2) {if((int) ($r / 4) == 1) $L[$l++]=(($i / 8) % 2).(($i / 4) % 2).(($i / 2) % 2).(($i / 1) % 2).$p;}
			else $N[$n++]=(($i / 8) % 2).(($i / 4) % 2).(($i / 2) % 2).(($i / 1) % 2).$p;
		}
	}
		echo '</tbody>
	</table>';
	return array($N,$L);
}

$cube = array(
	'00000',
	'00001',
	'00110',
	'00111',
	'01000',
	'01001',
	'01110',
	'01111',
	'10000',
	'10001',
	'10110',
	'10111',
	'11000',
	'11001',
	'11110',
	'11111',
	'00101',
	'11011',
	'11100',
	'11101'
);
$code[0]='01';
$code[1]='10';
$code[2]='00';
$code[3]='11';
list ($N, $L) = make($code);
echo 'N:<br>';
for ($i = 0;$i < count($L)/ 4;$i++) {
	for ($j = 0 ;$j < 4;$j++) 	
		echo $N[$j].', ';
	echo '<br>';
}
echo '<br>L:<br>';

for ($i = 0;$i < count($L);$i++) {
	echo $L[$i].', ';
}
echo '<br><br>';
$i = 0;
do{
	list ($cube, $Z0) = makeTable($cube, $i);
	$i++;
}while(count($cube) != 0)
?>