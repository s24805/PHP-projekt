<?php

 function Napisz($napisz)
{
    echo "<p> <font color='#0000cd''>$napisz</font> </p>";
}
function WszystkieQuizy(){
    $trescpliku = file_get_contents("_lista.txt");
    $arraylini = explode("\n", $trescpliku);
    return $arraylini;
}
class Quiz{
    private $nazwa;
    private $czyujemne;
    private $czas;
    private $czylospytania;
    private $czylosodp;
    private $czymoznacofac;
    private $iloscpytan;
    private $maxpkty;
    private $nick;


    public function Stworz($linijkazTXT){
        $array = explode(" ", $linijkazTXT);
        if(count($array)!=9)
            echo "w pliku _lista.txt $array[0] jest zle zapisany";
        else {
            $this->nazwa = $array[0];
            $this->czyujemne = $array[1];
            $this->czas = $array[2];
            $this->czylospytania = $array[3];
            $this->czylosodp = $array[4];
            $this->czymoznacofac = $array[5];
            $this->iloscpytan = $array[6];
            $this->maxpkty = $array[7];
            $this->nick = $array[8];
        }
    }
    public function Wypisz(){
        if($nazwa=$this->getNazwa()!="") {
            $nazwa = $this->getNazwa();
            $nick = $this->getNick();
            $wynik = "Nazwa Quizu: $nazwa. Quiz został stworzony przez $nick.<br> Cechy tego Quizu:<br>";
            $iloscpytan = $this->getIloscpytan();
            $maxpkty = $this->getMaxpkty();
            $wynik .= "-Ilość pytań: $iloscpytan<br>";
            $wynik .= "-Ilość punktów do zdobycia: $maxpkty<br>";
            $czyujemne = $this->getCzyujemne();
            if ($czyujemne == "saujemne")
                $wynik .= "-Są ujemne punkty za zła odpowiedź<br>";
            else
                $wynik .= "-Nie ma ujemnuch punktów za złą odpowiedź<br>";
            $czas = $this->getCzas();
            if ($czas == "0")
                $wynik .= "-Czas na odpowiedź jest nieograniczony<br>";
            else
                $wynik .= "-Czas na odpowiedź wynosi $czas s<br>";
            $czylospytania = $this->getCzylospytania();
            if ($czylospytania == "losowepyt")
                $wynik .= "-Pytania są ułożone losowo<br>";
            else
                $wynik .= "-Pytaniania nie są ułożone losowo<br>";
            $czylosodp = $this->getCzylosodp();
            if ($czylosodp == "losoweodp")
                $wynik .= "-Odpowiedzi są ułożone losowo<br>";
            else
                $wynik .= "-Odpowiedzi nie są ułożone losowo<br>";
            $czymoznacofac = $this->getCzymoznacofac();
            if ($czymoznacofac == "moznacofac")
                $wynik .= "-Można cofać do poprzedniego pytania";
            else
                $wynik .= "-Nie można cofać do poprzedniego pytania";

        }
        else
            $wynik="Linijka, z której powstał podany plik jest zapisana błednie";

            return $wynik;
    }
    public function getNick()
    {
        return $this->nick;
    }
    public function getNazwa()
    {
        return $this->nazwa;
    }
    public function getCzyujemne()
    {
        return $this->czyujemne;
    }
    public function getCzas()
    {
        return $this->czas;
    }
    public function getCzylospytania()
    {
        return $this->czylospytania;
    }
    public function getCzylosodp()
    {
        return $this->czylosodp;
    }
    public function getCzymoznacofac()
    {
        return $this->czymoznacofac;
    }
    public function getIloscpytan()
    {
        return $this->iloscpytan;
    }
    public function getMaxpkty()
    {
        return $this->maxpkty;
    }
}
class Pytanie{
     private $typ;
     private $punkty;
     private $pytanie;
     private $odpowiedzi;
     private $poprawnaodpowiedz;
    public function getTyp()
    {
        return $this->typ;
    }
    public function getPunkty()
    {
        return $this->punkty;
    }
    public function getPytanie()
    {
        return $this->pytanie;
    }
    public function getOdpowiedzi()
    {
        return $this->odpowiedzi;
    }
    public function getPoprawnaodpowiedz()
    {
        return $this->poprawnaodpowiedz;
    }
     public function stworz($linia){
         $arraylini = explode("]", $linia);
         $this->typ=$arraylini[0];
         $this->punkty=$arraylini[1];
         $this->pytanie=$arraylini[2];
         for($i=3;$i<count($arraylini)-2;$i++)
             array_push($odpowiedzi, $arraylini[$i]);
         $this->odpowiedzi=$odpowiedzi;
         $this->poprawnaodpowiedz=$arraylini[count($arraylini)-1];
     }
}
?>