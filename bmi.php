<?php
// Legge nome, peso, altezza dalla pagina precedente
$nome = $_POST['nome'] ?? '';
$peso = floatval($_POST['peso'] ?? 0);
$altezza_cm = floatval($_POST['altezza'] ?? 0);

// Calcolo del BMI: peso / (altezza in m)^2
$altezza_m = $altezza_cm / 100;
$bmi = ($altezza_m > 0) ? $peso / ($altezza_m * $altezza_m) : 0;
$bmi_formatted = number_format($bmi, 2, '.', '');

// Determinazione della classe e della fascia
if ($bmi < 18.5) {
    $classe = 'sottopeso';
    $fascia = 'SOTTOPESO';
} elseif ($bmi < 25) {
    $classe = 'normopeso';
    $fascia = 'NORMOPESO';
} elseif ($bmi < 30) {
    $classe = 'sovrappeso';
    $fascia = 'SOVRAPPESO';
} else {
    $classe = 'obesita';
    $fascia = 'OBESITÀ';
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo BMI</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>

    <div class="box-container">
        <h1>Il tuo BMI</h1>

        <div class="card <?php echo $classe; ?>">
            <div class="nome-utente"><?php echo htmlspecialchars($nome); ?></div>
            <div class="dati-utente">Peso <?php echo $peso; ?> kg - Altezza <?php echo $altezza_cm; ?> cm</div>
            <div class="bmi-number"><?php echo $bmi_formatted; ?></div>
            <div class="fascia"><?php echo $fascia; ?></div>
        </div>

        <div style="text-align: center;">
            <a href="form.html" class="link-riprova">Calcola di nuovo</a>
        </div>
    </div>

</body>
</html>