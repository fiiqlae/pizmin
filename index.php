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
$Ztotal = array();
do{
	list ($cube, $Z0) = makeTable($cube, $i);
	for($j = 0; $j < count($Z0); $j++) {
		array_push($Ztotal, $Z0[$j]);
	}
	$i++;
}while(count($cube) != 0);

function subtractCubes($cube1, $cube2, $preserveFlag, $cubeSize) {
	if($preserveFlag) return array($cube1);
	$result = array();
	for($i = 0; $i < $cubeSize; $i++) { // ????? ????, ?????????? ????? ???????? ?? ???-?? ?????? ? ????
		if(( $cube1[$i] == '1' && $cube2[$i] == '0') || ($cube1[$i] == '0' && $cube2[$i] == '1')) return array($cube1); // y
		else if($cube1[$i] == 'x' && $cube2[$i] == '0') { // 1
			if($i == 0) $result[0] = "";
			array_push($result, $cube1);
			$result[count($result) - 1][$i] = '1';
		} else if ($cube1[$i] == 'x' && $cube2[$i] == '1') { // 0
			if($i == 0) $result[0] = "";
			array_push($result, $cube1);
			$result[count($result) - 1][$i] = '0';
		} 
	}
	return $result;
}

function arrsub($a, $bs, $pf, $cs) {
	$res = array();
	foreach($bs as $cube) {
		$res = array_merge($res, subtractCubes($cube, $a, $pf, $cs));
	}
	return $res;
}

function findLExtremes($cubes) {
	$table = array(); 
	for($i = 0; $i < count($cubes); $i++) { //l
		for($j = 0; $j < count($cubes); $j++) { //c
			if($i == 0) $table[$i][$j] = array_unique(subtractCubes($cubes[$j], $cubes[$i], ($i == $j), 5));
			else $table[$i][$j] = array_unique(arrsub($cubes[$i], $table[$i-1][$j], ($i == $j), 5));
		}
	}
	
	return $table;
}

function intersectCubes($cube1, $cube2, $cubeSize) {
	$res = array();
	for($i = 0; $i < $cubeSize; $i++) { 
		if(( $cube1[$i] == '0' && $cube2[$i] == '0') 
			|| ($cube1[$i] == 'x' && $cube2[$i] == '0')
			|| ($cube1[$i] == '0' && $cube2[$i] == 'x')) $res[$i] = "0";
		else if(($cube1[$i] == '1' && $cube2[$i] == '0')
			|| ($cube1[$i] == '0' && $cube2[$i] == '1')) return array("E");
		else if (($cube1[$i] == '1' && $cube2[$i] == '1')
			|| ($cube1[$i] == 'x' && $cube2[$i] == '1')
			|| ($cube1[$i] == '1' && $cube2[$i] == 'x')) $res[$i] = "1";
		else $res[$i] = 'x';
	}
	return $res;
}

function makeSubstractionTable($zSet, $tableTitle) {
	$table = findLExtremes($zSet);
	$result = array();
	echo '<table border="0" bgcolor="#000000">
			<tbody>
			<tr bgcolor="white" align="center" rowspan="1"><td>' . $tableTitle . '</td>';
	for($i = 0; $i < count($zSet); $i++) {
		echo "<td>" . $zSet[$i] . "<br></td>";
	}
	for($i = 0; $i < count($zSet); $i++) {
		echo '<tr bgcolor="white" align="center" rowspan="1">';
		echo "<td>" . $zSet[$i] . "</td>";
		for($j = 0; $j < count($zSet); $j++){
			if($i == count($zSet)-1) {
				array_push($result, array($zSet[$j], $table[$i][$j]));
			}
			echo "<td>";
			if($i == $j){
				echo "-<br></td>";
				continue;
			}
			foreach($table[$i][$j] as $c) {
				echo $c . "<br>";
			}
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
	if($result == array()) return $zSet[0]; // ?????????
	return $result;
}

function detEset($lSet, $zSet) {
	$extr = makeSubstractionTable($zSet, "hui");
//~ 	print_r($extr);
	$table = array();
	$eJoined = array();
	$elems = array();
	$vals = array();
	foreach($extr as $e) $eJoined = array_merge($eJoined, $e[1]);
	foreach($extr as $e) array_push($elems, $e[0]);
	foreach($extr as $e) array_push($vals, $e[1]);
	print_r($vals);
	for($i = 0; $i < count($eJoined); $i++) { // l
		for($j = 0; $j < count($lSet); $j++){ // c
			print_r();
			$table[$i][$j] = array($extr[array_search(array($eJoined[$i]), $vals)], intersectCubes($eJoined[$i], $lSet[$j], 5));
		}
	}
	return array($extr, $table, $eJoined);
}
	
function makeIntersectionTable($lSet, $zSet, $tableTitle) {
	list($exxxtr, $table, $ej) = detEset($lSet, $zSet);
	$result = array();
//~ 	print_r($ej);
	echo '<table border="0" bgcolor="#000000">
			<tbody>
			<tr bgcolor="white" align="center" rowspan="1"><td>' . $tableTitle . '</td>';
	for($i = 0; $i < count($lSet); $i++) {
		echo "<td>" . $lSet[$i] . "<br></td>";
	}
	for($i = 0; $i < count($ej); $i++) {
		echo '<tr bgcolor="white" align="center" rowspan="1">';
		echo "<td>" . $ej[$i] . "</td>";
		for($j = 0; $j < count($lSet); $j++){
			echo "<td>";
			foreach($table[$i][$j][1] as $c) {
				echo $c;
			}
			if(!in_array("E", $table[$i][$j][1])) array_push($result, $table[$i][$j][0]);
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
	print_r($result);
	return $result;
}
function get_combinations($arrays) {
	$result = array(array());
	foreach ($arrays as $property => $property_values) {
		$tmp = array();
		foreach ($result as $result_item) {
			foreach ($property_values as $property_value) {
				$tmp[] = array_merge($result_item, array($property => $property_value));
			}
		}
		$result = $tmp;
	}
	return $result;
}

print_r($cross);
function finalSubtraction($lSet, $eSet, $zSet, $tableTitle) {
	$table = array();
	$lPrime = array();
	$joined = array();
	//print_r($eSet);
	foreach($eSet as $e) array_push($joined, $e[0]);
	for($i = 0; $i < count($eSet); $i++) { //l
		for($j = 0; $j < count($lSet); $j++) { //c
			if($i == 0) $table[$i][$j] = array_unique(subtractCubes($lSet[$j], $eSet[$i][0], ($i == $j), 5));
			else $table[$i][$j] = array_unique(arrsub($lSet[$i], $table[$i-1][$j], ($i == $j), 5));
		}
	}
	echo '<table border="0" bgcolor="#000000">
			<tbody>
			<tr bgcolor="white" align="center" rowspan="1"><td>' . $tableTitle . '</td>';
	for($i = 0; $i < count($lSet); $i++) {
		echo "<td>" . $lSet[$i] . "<br></td>";
	}
	for($i = 0; $i < count($eSet); $i++) {
		echo '<tr bgcolor="white" align="center" rowspan="1">';
		echo "<td>" . $eSet[$i][0] . "</td>";
		for($j = 0; $j < count($lSet); $j++){
			echo "<td>";
			foreach($table[$i][$j] as $c) {
				echo $c;
			}
			if($table[$i][$j] != array()) $lPrime = array_merge($lPrime, $table[$i][$j]);
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
	$zPrime = array_diff($zSet, $joined);	
	echo "<br>";
	$table = array();
	$refZPrime = array();
	foreach($zPrime as $zzz) {
		array_push($refZPrime, $zzz);
	}
	for($i = 0; $i < count($zPrime); $i++) { //l
		for($j = 0; $j < count($lPrime); $j++) { //c
			if($i == 0) $table[$i][$j] = (intersectCubes($refZPrime[$i], $lPrime[$j], 5));
			else $table[$i][$j] = (intersectCubes($refZPrime[$i], $lPrime[$j], 5));
		}
	}
	echo '<table border="0" bgcolor="#000000">
			<tbody>
			<tr bgcolor="white" align="center" rowspan="1"><td>' . $tableTitle . '</td>';
	for($i = 0; $i < count($lPrime); $i++) {
		echo "<td>" . $lPrime[$i] . "<br></td>";
	}
	print_r($zPrime);
	echo "<br>";
	print_r($lPrime);
	$intersections = array();
	for($i = 0; $i < count($refZPrime); $i++) {
		echo '<tr bgcolor="white" align="center" rowspan="1">';
		echo "<td>" . $refZPrime[$i] . "</td>";
		for($j = 0; $j < count($lPrime); $j++){
			echo "<td>";
			if(!in_array("E", $table[$i][$j])) {
				array_push($intersections, array($refZPrime[$i], $j));
			}	
			foreach($table[$i][$j] as $c) {
				echo $c;
			}
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
	$sortedIntersections = array();
	for($i = 0; $i < count(count($lPrime))+1; $i++) {
		array_push($sortedIntersections, array());
	}
	for($i = 0; $i < count($intersections); $i++) {
		array_push($sortedIntersections[($intersections[$i][1])], $intersections[$i][0]);
	}
	
	$functions = array();
	foreach(get_combinations($sortedIntersections) as $f) {
		$res = array_merge($f, $joined);
		$tmp = array();
		for($q = 0; $q < count($res); $q++) {
			for($w = 0; $w < 5; $w++) {
				if($res[$q][$w] == "0") array_push($tmp,"!x" . $w);
				else if($res[$q][$w] == "1") array_push($tmp,"x" . $w);
			}
			if($q != count($res)-1) array_push($tmp, " v ");			
		}
		array_push($functions, implode($tmp));
	}
	print_r($functions);
}
//TODO: add branching to the algorithm
//TODO: refactor that shit
finalSubtraction($L, makeIntersectionTable($L, $Ztotal, "pizda"), $Ztotal, "jebat");


echo '<br> <br> <p style="color:red;font-size:300%;"> done in <p style="color:red;font-size:300%;">FUCK YOU</ seconds </p><br>';
//print_r($f);

//echo print_r($Ztotal);

?>
































