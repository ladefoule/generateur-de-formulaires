<?php

$titre = "Votre formulaire Bootsrap";
require('entete.php');
require('outils.php');

$nombreElements = $_POST['nombreElements'];
$nombreElementsParLigne = $_POST['nombreElementsParLigne'];
$methodDuFormulaire = $_POST['methodDuFormulaire'];
$actionDuFormulaire = $_POST['actionDuFormulaire'];
$classDuFormulaire = $_POST['classDuFormulaire'];

$name = $value = $label = $type = $placeholder = $id = $required = $invalid = $class = [];
$i = 0;
while(isset($_POST['name'.$i])) // On récupère les infos et on les insère dans des tableaux
{
   $name[$i] = $_POST['name'.$i];
   $value[$i] = $_POST['value'.$i];
   $label[$i] = $_POST['label'.$i];
   $type[$i] = $_POST['type'.$i];
   $class[$i] = $_POST['class'.$i];
   $placeholder[$i] = $_POST['placeholder'.$i];
   $id[$i] = $_POST['id'.$i];
   $required[$i] = $_POST['required'.$i];
   $invalid[$i] = $_POST['invalid'.$i];
   $i++;
}

// La variable qui va contenir tout le HTML de mon formulaire
$monFormulaire = headerFormulaire($actionDuFormulaire, $methodDuFormulaire, $classDuFormulaire);

$tableau = []; // Ce tableau va contenir toutes mes balises Label/Input/InvalidDiv

// Je crée mes Labels/Inputs et InvalidDiv
for ($i = 0; $i < $nombreElements; $i++) {
   // Si un champ est vide alors qu'il contient une div Invalid, on lui insère alors la class 'is-invalid'
   
   $tableau[$i]['label'] = genererLabelFormulaire($label[$i], $name[$i]);
   $tableau[$i]['input'] = genererInputFormulaire(['type' => $type[$i], 'name' => $name[$i], 'value' => $value[$i], 'class' => $class[$i],
                              'placeholder' => $placeholder[$i], 'required' => $required[$i], 'id' => $id[$i]]);
   $tableau[$i]['invalid'] = genererInvalidInput($invalid[$i]);
}

//function corpsFormulaireBootsrap($formulaire, $tableauInputEtLabel) : le modèle de ma fonction
$monFormulaire = corpsFormulaireBootsrap($monFormulaire, $tableau, $nombreElementsParLigne); // j'insère toutes les infos de $tableau dans $monFormulaire

//function footerFormulaire($formulaire, $nomBouton) : le modèle de ma fonction
$monFormulaire = footerFormulaire($monFormulaire, 'Valider'); // Je finalise le HTMl de mon formulaire

?>

<div class="container">
   <div class="row flex-wrap centre p-4">
      <h1><?= $titre ?></h1>
      <div class="col-12 centre p-1">
         <?php
         echo $monFormulaire; // J'affiche mon formulaire
         ?>
      </div>
   </div>
</div>

<?php
require 'footer.php';