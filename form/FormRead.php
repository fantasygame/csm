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
class FormRead {

    public function getForm() {
        $sheet = new Sheet();

        $name = $_POST['name'];
        $sheet->setName($name); //imię postaci

        $raceRep = new RaceRepository();
        $race = $raceRep->getById($_POST['race']);
        $sheet->setRace($race);

//id rasy
        $appearance = $_POST['appearance'];
        $sheet->setAppearance($appearance);
        $archetype = $_POST['archetype'];
        $sheet->setArchetype($archetype);
        $description = $_POST['description'];
        $sheet->setDescription($description);

        $edges = array();
        foreach ($_POST['edges'] as $value) {
            $rep = new EdgeRepository();
            $edges[] = $rep->getById($value);
        }
        $sheet->setEdges($edges);


        $hindrances = array();
        foreach ($_POST['hindrances'] as $value) {
            $rep = new HindranceRepository();
            $hindrances[] = $rep->getById($value);
        }
        $sheet->setHindrances($hindrances);


        $powers = array();
        foreach ($_POST['powers'] as $value) {
            $rep = new PowerRepository();
            $powers[] = $rep->getById($value);
        }
        $sheet->setPowers($powers);

        $attributes = array();
        foreach ($_POST['attributes'] as $key => $value) {
            $rep = new AttributeRepository();
            $attributes[] = $rep->getById($key, $value);
        }
        $sheet->setAttributes($attributes);

        $skills = array();
        foreach ($_POST['skills'] as $key => $value) {
            $rep = new SkillRepository();
            $skills[] = $rep->getById($key, $value, $sheet);
        }
        $sheet->setSkills($skills);



        $usRep = new UserRepository();
        $user = $usRep->getById($_POST['user']);
        $sheet->setUser($user);

        $exp = $_POST['exp'];
        $sheet->setExp($exp);





        return $sheet;
    }

}

?>