<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formread
 *
 * @author Dawid
 */
class formread {
    
   public function getForm(){
   $sheet = new Sheet();
   
   $name = $_POST['name'];
   $race = $_POST['race'];
   $appearance = $_POST['appearance'];
   $archetype = $_POST['archetype'];
   $description = $_POST['description'];
   $edges = $_POST['edges'];
   $hindrances = $_POST['hindrances'];
   $powers = $_POST['powers'];
   $skills = $_POST['skills'];
   $attributes = $_POST['attributes'];
   $user = 'test';
   $exp = $_POST['exp'];
   
   
   
   
   
        $sheet->setName($name);
        $sheet->setRace()->setId($race);
        $sheet->setAppearance($appearance);
        $sheet->setArchetype($archetype);
        $sheet->setDescription($description);
        $sheet->setEdges($edges);
        $sheet->setHindrances($hindrances);
        $sheet->setPowers($powers);
        $sheet->setExp($exp);
        $sheet->setUser(new User(2, 'test'));
        $sheet->setSkills($skills);
        $sheet->setAttributes($attributes);
        
        return $sheet;
   

   
    
   }
}

?>
