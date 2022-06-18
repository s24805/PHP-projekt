<?php
/* Powrot do poprzedniej strony
    <div>
        <form style='text-align:left'>
            <input type="button" value="Anuluj" class="button"  onclick="history.back()" >
        </form>
    </div>
*/
//     <embed src="music/wrau.mp3"  loop="2" width="2" height="0">
 function Napisz($napisz)
{
    echo " <font color='#4CAF50'>$napisz</font>";
}
function NapiszPom($napisz)
{
    echo " <font color='#FFA642'>$napisz</font>";
}
function NapiszRoz($napisz)
{
    echo " <font color='#FF8EFB'>$napisz</font>";
}
function NapiszCzerw($napisz)
{
    echo " <font color='#FF5242'>$napisz</font>";
}
function NapiszNieb($napisz)
{
    echo " <font color='#8296FF'>$napisz</font>";
}
?>
<script>
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
</script>
<?php
function WszystkieQuizy(){
    $trescpliku = file_get_contents("_lista.txt");
    $arraylini = explode("\n", $trescpliku);
    return $arraylini;
}
function WypiszDanyQuiz($nazwaQuizuBezTXT){
     $stringiWszystkieQuizy=WszystkieQuizy();
     $szukany="nie znaleziono podanego quizu";
     foreach ($stringiWszystkieQuizy as $string){
         $arraylinijki = explode(" ", $string);
         if($arraylinijki[0]==$nazwaQuizuBezTXT){
             $szukany=$string;
         }
     }
     if($szukany!="nie znaleziono podanego quizu"){
         $quiz = new Quiz;
         $quiz->Stworz($szukany);
         $szukany=$quiz->Wypisz();
     }
      Napisz($szukany);
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
        if($this->getNazwa()!="") {
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
    public function PytanieWString(){
        $typ=$this->getTyp();
        $punkty=$this->getPunkty();
        $pytanie=$this->getPytanie();
        $odpowiedzi=$this->getOdpowiedzi();
        $poprawnaOdp=$this->getPoprawnaodpowiedz();
        $wynik="$typ]$punkty]$pytanie]";
        //do zrobienia jeszcze zapisywanie odpowiedz w zaleznosci od typu pytania (jesli bedzie potrzebne)
    }
     public function stworz($linia){
         $odpowiedzi = array();
         $arraylini = explode("]", $linia);
         $this->typ=$arraylini[0];
         $this->punkty=$arraylini[1];
         $this->pytanie=$arraylini[2];
         switch ($arraylini[0]) {
             case "jednokrotne":
             case "lista":
                 for ($i = 3; $i < 7; $i++) {
                     $odpowiedzi[] = $arraylini[$i];
                 }
                 $this->poprawnaodpowiedz = $arraylini[count($arraylini) - 1];
                 $this->odpowiedzi=$odpowiedzi;
                 break;
             case "wielokrotne":
                 $poprawneOdp=str_split($arraylini[count($arraylini) - 1]);
                 foreach ($poprawneOdp as $litera){
                     $litera=intval($litera);
                 }
                 $PoprawneOdpowiedzi = array();
                 for($i=3;$i<7;$i++){
                     if (in_array($i, $poprawneOdp)) {
                         $PoprawneOdpowiedzi[] = $arraylini[$i];
                     }
                     $odpowiedzi[] = $arraylini[$i];
                 }
                 $this->odpowiedzi=$odpowiedzi;
                 $this->poprawnaodpowiedz =$PoprawneOdpowiedzi;
                 break;
             case "wpisz":
                 $this->poprawnaodpowiedz = $arraylini[count($arraylini) - 1];
                 break;
             case "dziury":
                 $this->odpowiedzi=$arraylini[3];//dostaje cala odpowiedz
                 $this->poprawnaodpowiedz =$arraylini[count($arraylini) - 1];//dostaje string liczb w ktorych miejscach ma usunac literke
                 break;
             case "sortuj":
                 for($i=3;$i<count($arraylini);$i++){
                     $odpowiedzi[] = $arraylini[$i];
                     $PoprawneOdpowiedzi[] = $arraylini[$i];
                 }
                 $this->odpowiedzi=$odpowiedzi;
                 $this->poprawnaodpowiedz =$PoprawneOdpowiedzi;
                 break;
             case "polacz":
                 //dziele 8 dopasowan na array 4 czesci do ktorych bedzie dopasowywane i array 4 czesci ktore beda do tamtych dopasowywane
             for($i=3;$i<count($arraylini);$i++){
                 if($i%2==0)
                     $odpowiedziPierwszaCZesc[]=$arraylini[$i];
                 else
                     $odpowiedzDoDopasowania[]=$arraylini[$i];
                }
                 $this->odpowiedzi=$odpowiedzDoDopasowania;
                 $this->poprawnaodpowiedz =$odpowiedziPierwszaCZesc;
             break;
             case "prawda":
                 $this->poprawnaodpowiedz=$arraylini[3];
                 break;
         }
     }
}

function sqlConnect(){
    $servername = "localhost";
    $username = "s24805";
    $password  = 'Daw.Popl';
    $dbname  = "s24805";

    $db = new mysqli($servername, $username, $password, $dbname);
    return $db;
}
?>