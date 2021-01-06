<?php
declare(strict_types=1);
include 'family.php';
$father1 = new Father(45, "Валера");
$mother1 = new Mother(33, "Валерия", $father1);  
$child1 = new Child(11, "Валериян", $mother1, $father1);
$child2 = new Child(13, "Валерияна");
$family1 = new Family("Петровы", $father1, $mother1, array($child1,$child2));
echo "Данные по отцу из первой семьи:</br>";
$father1->getName();
$father1->getGender();
$father1-> getWifeName();
echo "Данные по матери из первой семьи:</br>";
$mother1->getName();
$mother1->getGender();
$mother1->getHusbandName();
echo "Данные по первому ребёнку из первой семьи:</br>";
$child1->getParentsNames();
$child1->getGender();
echo "Данные по второму ребёнку из первой семьи:</br>";
$child2->getParentsNames();
$child2->getGender();
$family2 = new Family("Сидоровы", new Father(32, "Петя"), new Mother(33, "Алина"), array(new Child(5, "Афанасий")));
echo "Данные первой семьи:</br>";
$family1->getFamilyCounter();
echo "Данные второй семьи:</br>";
$family2->getFamilyCounter();
Family::getAllFamiliesCounter();
?>