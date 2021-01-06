<?php
abstract class Person
{
    private int $age;
    private string $name;
    protected static $genders =  array("Мужской","Женский");
    private string $gender;
    
    public function getAge()
    {
        echo $this->age.'</br>';
    }
    public function setAge(int $Age)
    {
        $Age<=0?$this->age=1:$this->age=$Age;
    }
    public function getGender()
    {
        echo 'Пол='.$this->gender.'</br>';;
    }
    public function setGender(string $Gender)
    {
        mb_strtoupper($Gender)===mb_strtoupper(Person::$genders[0])|| mb_strtoupper($Gender)===mb_strtoupper(Person::$genders[1])?$this->gender=$Gender:$this->gender=Person::$genders[0];
    }
    public function getName()
    {
        echo $this->name.'</br>';;
    }
    public function setName(string $Name)
    {
        strlen($Name)>0?$this->name=$Name:$this->name="Пусто";
    }
    public function __construct(int $Age, string $Gender, string $Name)    
    {       
        $this->setAge($Age);
        $this->setGender($Gender);
        $this->setName($Name);       
    }
}

class Father extends Person{
    private Mother $wife;

    function __construct(int $Age, string $Name, Mother $Wife=null) {
        $this->setAge($Age);
        $this->setName($Name);          
        $this->setGender(Person::$genders[0]);
        if (!is_null($Wife)){
            $this->$this->wife = $Wife;
        }     
    }
    public function getWifeName(){
        if(isset($this->wife)&&!is_null($this->wife)){
            echo 'Жена=';
            $this->wife->getName();
        }
    }
    public function getWife():?Mother{
        if(!isset($this->wife)) return null;
        return $this->wife;
    }
    public function setWife(Mother $Wife){
        if(!isset($this->wife)) $this->wife = $Wife;
        else{
            $currentWife = $wife->getHusband();
            if($currentWife!=$this){
                echo 'У этой жены уже есть муж';
            } else $this->wife = $Wife;
        }
    }    
}

class Mother extends Person{
    private Father $husband;

    function __construct(int $Age, string $Name, Father $Husband=null) {
        $this->setAge($Age);
        $this->setName($Name);     
        echo "Пол жены".(Person::$genders[1]);    
        $this->setGender(Person::$genders[1]);
        if (!is_null($Husband)){
            $this->setHusband($Husband);
        }
    }

    public function getHusbandName(){
        if(isset($this->husband)&&!is_null($this->husband)){
            echo 'Муж=';
            $this->husband->getName();
        }
    }
    public function getHusband():?Father{
        if(!isset($this->husband)) return null;
        return $this->husband;
    }    
    public function setHusband(Father $Husband){
        if(!isset($this->husband)) $this->husband = $Husband;
        else{
            $currentHusband = $Husband->getWife();
            if($currentHusband!=$this){
                echo 'У этого мужа уже есть жена';
            } else $this->husband = $Husband;
        }
    }   
}

class Child extends Person{
    private Mother $mother; 
    private Father $father; 

    function __construct(int $Age, string $Name, Mother $Mother=null, Father $Father=null)
    {
        $this->setAge($Age);
        $this->setName($Name);          
        $this->setGender(Person::$genders[random_int(0,1)]);   
        $this->setParents($Mother, $Father);
    }   
        
    public function getParentsNames()
    {
            if(isset($this->mother)&&!is_null($this->mother))
            {
                echo 'Мать=';
                $this->mother->getName();
            }
            if(isset($this->father)&&!is_null($this->father))
            {
                echo 'Отец=';
                $this->father->getName();
            }
    }    

    public function setParents(Mother $Mother=null, Father $Father=null)
    {
        if (!is_null($Mother)) $this->mother=$Mother;
        if (!is_null($Father)) $this->father=$Father;
    }  
}

class Family{
    private string $familySurame;
    static int $totalPersons=0;
    private int $totalPersonsInFamilies=0;
    private Father $father;
    private Mother $mother;
    private $childs = array();

    function __construct(string $familySurame, Father $Father, Mother $Mother, array $Childs=null)
    {
        $this->familyName=$familySurame;
        $this->father = $Father;
        $this->father->setWife($Mother);
        $this->mother = $Mother;
        $this->mother->setHusband($Father);        
        static::$totalPersons++;
        $this->$totalPersonsInFamilies++;       
        foreach($Childs as $child)
        {
            if($child instanceof Child){
                $child->setParents($Mother,$Father);
                static::$totalPersons++;
                $this->$totalPersonsInFamilies++;
            } else echo "Вы пытались добавить не ребёнка";  
        } 
    }

    function getFamilyCounter(){
        echo "Всего членов семьи {$this->familyName}:".$this->$totalPersonsInFamilies.'</br>'; 
    }

    static function getAllFamiliesCounter(){
        echo "Во всех семьях:".static::$totalPersons;        
    }
}