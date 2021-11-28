<?php
class Config {
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $baza;

    function __construct( $dbhost, $dbuser, $dbpass, $baza) {
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->baza = $baza;
	}

    public function connection() {
        $dbase = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->baza);
        if (!$dbase) echo '<b> Błąd połączenia </b>';
        if (!mysqli_select_db($dbase, $this->baza)) echo '<b> Błąd połączenia z bazą </b>';
        return $dbase;
    }
}
?>