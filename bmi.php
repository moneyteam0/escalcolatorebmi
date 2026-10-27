<?php

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: form.html");
}



// Recupero e sanificazione dei dati inviati via POST
$nome = isset($_POST['nome']) ? htmlspecialchars(trim($_POST['nome'])) : 'Utente';
$peso = isset($_POST['peso']) ? floatval($_POST['peso']) : 0;
$altezza_cm = isset($_POST['altezza']) ? floatval($_POST['altezza']) : 0;

// Validazione di sicurezza dati
if ($peso <= 0 || $altezza_cm <= 0) {
    header("Location: form.html");
    exit;
}

// Calcolo del BMI: peso (kg) / (altezza (m))^2
$altezza_m = $altezza_cm / 100;
$bmi = $peso / ($altezza_m * $altezza_m);

// Formattazione del valore a 2 cifre decimali
$bmi_formattato = number_format($bmi, 2, '.', '');

// Determinazione della fascia di peso, della classe CSS e della descrizione
if ($bmi < 18.5) {
    $classe = "sottopeso";
    $fascia = "SOTTOPESO";
} elseif ($bmi >= 18.5 && $bmi < 25.0) {
    $classe = "normopeso";
    $fascia = "NORMOPESO";
} elseif ($bmi >= 25.0 && $bmi < 30.0) {
    $classe = "sovrappeso";
    $fascia = "SOVRAPPESO";
} else { // $bmi >= 30.0
    $classe = "obesita";
    $fascia = "OBESITÀ";
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato BMI</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>

    <!-- Card con classe ".card" affiancata alla classe della fascia corrispondente -->
    <div class="card <?php echo $classe; ?>">
        <div class="user-name"><?php echo $nome; ?></div>
        <div class="user-data">Peso <?php echo $peso; ?> kg - Altezza <?php echo $altezza_cm; ?> cm</div>
        <div class="bmi-value"><?php echo $bmi_formattato; ?></div>
        <div class="fascia-name"><?php echo $fascia; ?></div>
    </div>

    <!-- Sotto la card: link "Calcola di nuovo" collegato a form.html -->
    <a href="form.html" class="back-link">Calcola di nuovo</a>

</body>
</html>