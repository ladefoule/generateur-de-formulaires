<?php
/*
   Initialisation du formaulaire. Ici on ouvre juste la balise <form> avec l'action, la méthode et les classes
*/
function headerFormulaire($action, $method, $class)
{
   $formulaire = "<form action=\"$action\" method=\"$method\" class=\"$class\">";

   return $formulaire;
}

/*
   On crée un Input avec les données saisies en paramètre.
   Seul $required est booléen, les autres sont sous forme de chaine de caractère (String)
*/
function genererInputFormulaire(Array $parametresInput)//(['type' => 'text', 'name' => 'nom', 'value' => 'moussa'], ...)
{
   foreach ($parametresInput as $parametre => $value) {
      $$parametre = $value;
   }

   $type = (isset($type)) ? "type=\"$type\"" : "";
   $name = (isset($name)) ? "name=\"$name\"" : "";
   $class = (isset($class)) ? "class=\"form-control $class\"" : "form-control";
   $value = ($value != "") ? "value=\"$value\"" : "";
   $placeholder = (isset($placeholder)) ? "placeholder=\"$placeholder\"" : "";
   $id = (isset($id)) ? "id=\"$id\"" : "";
   $required = (isset($required) && $required == 1) ? "required" : "";
   
   if($type == "type=\"textarea\"")
      return "<textarea cols=\"40\" rows=\"3\" $name $class $id $placeholder $required>". $value."</textarea>";
   else if($type == "type=\"checkbox\"")
      return "<input $type $name $class $id $required>";
   else
      return "<input $type $name $value $class $id $placeholder $required>";
}

/*
   On crée un label qui va pointer vers $name et qui aura le $texte rentré en paramètre
*/
function genererLabelFormulaire($texteDuLabel, $name)
{
   return "<label for=\"$name\">$texteDuLabel</label>";
}

/*
   On génère une DIV qui sera afficher si l'élement n'est pas correctement renseigné 
   Renvoie "" si $texte = "" c'est à dire pas de création de DIV
*/
function genererInvalidInput($texte)
{
   if($texte  == "")
      return "";
   else
      return "<div class=\"invalid-feedback\">$texte</div>";
}

/*
   On récupère les Inputs/Labels/DivInvalid et on les insère à la suite dans notre varibale $formulaire
   Grace à la variable $class (class bootstrap), on découpe parfaitement la ligne en parts égales.
*/
function corpsFormulaireBootsrap($formulaire, $tableauInputEtLabel, $nombreInputParLigne)
{
   $compteur = 0;
   $class = "col-". (12 / $nombreInputParLigne);
   foreach ($tableauInputEtLabel as $donnees) {
      // Tous les $nombreInputParLigne élements, je commence une autre ligne.
      if($compteur % $nombreInputParLigne == 0)
         $formulaire = $formulaire . "\n<div class=\"form-row justify-content-center pb-3\">\n";

      $formulaire = $formulaire . "<div class=\"$class mb-3\">\n";
         $formulaire = $formulaire . $donnees['label'] . "\n";
         $formulaire = $formulaire . $donnees['input'] . "\n";
         $formulaire = $formulaire . $donnees['invalid'] . "\n";
      $formulaire = $formulaire . "</div>\n";

      // Dès que j'ai récupéré $nombreInputParLigne élements je ferme la balise de la ligne
      if($compteur % $nombreInputParLigne == ($nombreInputParLigne-1))
         $formulaire = $formulaire . "</div>\n";

      $compteur++;
   }

   // SI j'ai moins de (<) $nombreInputParLigne élements dans la dernière ligne, je ferme malgré tout ma div
   if($compteur != $nombreInputParLigne)
         $formulaire = $formulaire . "</div>\n";
      
   return $formulaire;
}

/*
   On ferme notre balise <form> ici. Mais avant on n'oublie pas le bouton Submit
*/
function footerFormulaire($formulaire, $nomBouton)
{
   $formulaire = $formulaire . "<div class=\"centre mt-4\"><button class=\"btn btn-primary px-5\" type=\"submit\">$nomBouton</button></div>";
   $formulaire = $formulaire . "</form>";
   return $formulaire;
}

/*
<input type="number" class="d-none" name="nombreElements" value="<?= $nombreElements ?>">
<input type="number" class="d-none" name="nombreElementsParLigne" value="<?= $nombreElementsParLigne ?>">
<input type="text" class="d-none" name="actionDuFormulaire" value="<?= $actionDuFormulaire ?>">
<input type="text" class="d-none" name="classDuFormulaire" value="<?= $classDuFormulaire ?>">
<input type="text" class="d-none" name="methodDuFormulaire" value="<?= $methodDuFormulaire ?>">
*/