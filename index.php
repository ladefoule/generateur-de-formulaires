<?php
$lesTypesInput = ["text","number","date","password","textarea","button","checkbox","color","datetime-local","email","file","hidden","image","month","radio","range","reset","search","submit","tel","time","url","week"];
$titre = "Génération de formulaire Bootstrap";
require('entete.php');
require('outils.php');
?>


<div class="container">
   <div class="row flex-wrap centre p-2">
      <h1>Préparation du formulaire</h1>
      <div class="col-12 centre p-1">
         <?php 
         if(isset($_GET['nombreElements'])){
            $nombreElements = ($_GET['nombreElements'] >= 1) ? $_GET['nombreElements'] : 1;
            ?>
            <form action="./crea-form.php" method="POST" class="needs-validation">
               <?php
               $i = 0;
               while($i < $nombreElements){
                  print '<div class="form-row justify-content-center flex-wrap pb-3">';
                     print "<input type='text' name='name$i' placeholder='name $i' class=\"w-25 form-control\" required>";
                     print "<input type='text' name='label$i' placeholder='label $i' class=\"w-25 form-control\">";
                     print "<input type='text' name='value$i' placeholder='value $i' class=\"w-25 form-control\">";
                     ?>
                     <select name="<?= "type" . $i ?>" class="w-25 form-control">
                     <?php
                     foreach ($lesTypesInput as $type) {
                        echo "<option value=\"$type\">$type</option>";
                     }
                     ?>
                     </select>
                     <?php
                     print "<input type='text' name='class$i' placeholder='class $i' class=\"w-25 form-control\">";
                     print "<input type='text' name='placeholder$i' placeholder='placeholder $i' class=\"w-25 form-control\">";
                     print "<input type='text' name='id$i' placeholder='id $i' class=\"w-25 form-control\">";                     ?>
                     <select name="<?= "required" . $i ?>" class="w-25 form-control">
                        <option value="0">no required</option>
                        <option value="1">required</option>
                     </select>
                     <?php
                     print "<input type='text' name='invalid$i' placeholder=\"message en cas d'erreur $i\" class=\"w-25 form-control\">";
                  print '</div>';
                  $i++;
               }
               ?>
               <input type="number" style="display:none" name="nombreElements" value="<?= $nombreElements ?>">
               <div class="centre p-2"><label for="nombreInputParLigne" class="pr-2">Nombre d'élements par ligne</label><input type="number" name="nombreElementsParLigne" required></div>
               <div class="centre p-2"><label for="actionDuFormulaire" class="pr-2">Action du formulaire (lien)</label><input type="text" name="actionDuFormulaire"></div>
               <div class="centre p-2"><label for="classDuFormulaire" class="pr-2">Les 'class' du formulaires</label><input type="text" name="classDuFormulaire" value="needs-validation p-3" required></div>
               <div class="centre p-2"><label for="methodDuFormulaire" class="pr-2">La method du formulaire</label><select name="methodDuFormulaire"><option value="GET">GET</option><option value="POST">POST</option></select></div>
               <div class="centre p-2"><button class="btn btn-primary px-5" type="submit">Envoyer</button></div>
            </form>
         <?php
         }else{
         ?>
            <form action="" method="GET" class="needs-validation">
               <input type="number" name="nombreElements" required placeholder="Nombre d'élements">
               <div class="centre p-3"><button class="btn btn-primary px-5\" type="submit">Valider</button></div>
            </form>
         <?php
         }
         ?>
      </div>
   </div>
</div>

<?php
require 'footer.php';