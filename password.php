<!-- Ripetere l'esercizio del controllo password visto a lezione. -->
<!-- Implementare un metodo che faccia reinserire la password qualora anche una delle regole non fosse rispettata e che, invece, lo interrompa in caso di password acettata. -->
<!-- visualizzare in console quale regola non è stata rispettata -->


<?php

$password = '';  // stringa vuota 
$password_is_valid = false; 

// password con 8 caratteri 
function firstCheck($password){ 
return strlen($password) >= 8; 
} 

// la password deve contenere un numero 
function secondCheck($password){ 
$numbers = '0123456789'; 
for($i = 0; $i < strlen($password); $i++){ 
if(in_array($password[$i], str_split($numbers))){ 
return true; 
} 
} 
return false; 
} 

// funzione per controllare se contiene almeno una lettera UPPERCASE 
function thirdCheck($password){ 
$uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 

for($i = 0; $i < strlen($password); $i++){ 
if(in_array($password[$i], str_split($uppercase))){ 
return true; 
} 
} 
return false; 
} 

// funzione per controllare se contiene almeno un carattere speciale 
function fourthCheck($password){ 
$special_chars = '!@#$^&*()_+-={}|[];:,.<>?/'; 

for($i = 0; $i < strlen($password); $i++){ 
if(in_array($password[$i], str_split($special_chars))){ 
return true; 
} 
} 
return false; 
} 

// controllo delle regole e restituisce un array con lo stato di ogni regola. 
function checkPassword ($password){ 
return [ 
'rule1' => firstCheck($password), 
'rule2' => secondCheck($password), 
'rule3' => thirdCheck($password), 
'rule4' => fourthCheck($password), 
]; 
} 

// controlliamo se tutte le regole sono rispettate 
function isPasswordValid($password){ 
$rules = checkPassword($password); 
return array_reduce($rules, function ($acc, $curr){ 
return $acc && $curr; 
}, true); 
} 

// mostriamo le regole che non sono state rispettate 
function showErrors($rules){ 
echo "La password non rispetta le seguenti regole: \n"; 
foreach ($rules as $rule => $value){ 
if(!$value){ 
echo $rule . "\n"; 
} 
} 
} 


$attempts = 0; 
$max_attempts = 5; 

// cicliamo per chiedere l'inserimento della password finché non viene inserita una password valida o finché il numero massimo di tentativi non è stato raggiunto 

while (!$password_is_valid && $attempts < $max_attempts){ 

$password = readline("Inserisci la password:"); 
$password_is_valid = isPasswordValid($password); 
$attempts++; 

if(!$password_is_valid){ 
$rules = checkPassword($password); 
showErrors($rules); 
echo "Tentativo numero $attempts di $max_attempts.\n"; 
} 
} 

// se la password è valida la mostriamo all'utente altrimenti si blocca per 30 minuti 
if($password_is_valid){ 
echo "La password rispetta tutti i criteri.\n"; 

} else { 
echo "Hai superato il numero massimo di tentativi consentiti o inserito una password non valida. Riprova tra 30 minuti.\n"; 
} 

?> 