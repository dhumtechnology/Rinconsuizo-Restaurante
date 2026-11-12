<?php
class ClientesData {
	public static $tablename = "clientes";

	public function ClientesData(){
	}

	private static function restaurantId()
	{
		if (function_exists('web_tenant_id')) {
			$id = (int) web_tenant_id();
			if ($id > 0) {
				return $id;
			}
		}
		if (function_exists('tenantId')) {
			$id = (int) tenantId();
			if ($id > 0) {
				return $id;
			}
		}
		return 1;
	}

	private static function esc($value)
	{
		$con = Database::getCon();
		if ($con) {
			return $con->real_escape_string((string) $value);
		}
		return addslashes((string) $value);
	}

	private static function oneFromQuery($query)
	{
		if (!$query || empty($query[0])) {
			return null;
		}
		return Model::one($query[0], new ClientesData());
	}

	private static function passwordsMatch($stored, $plain)
	{
		$stored = (string) $stored;
		$plain = (string) $plain;
		if ($stored === '' || $plain === '') {
			return false;
		}
		if (strlen($stored) === strlen($plain)) {
			return hash_equals($stored, $plain);
		}
		return $stored === $plain;
	}

	public function add(){
		$tid = isset($this->id_restaurante) ? (int) $this->id_restaurante : self::restaurantId();
		if ($tid <= 0) {
			$tid = 1;
		}
		$ced = self::esc($this->cedcliente);
		$nom = self::esc($this->nomcliente);
		$dir = self::esc($this->direccliente);
		$tlf = self::esc($this->tlfcliente);
		$email = self::esc($this->emailcliente);
		$pass = self::esc($this->password);
		$sql = "insert into clientes (`cedcliente`,`nomcliente`,`direccliente`,`tlfcliente`,`emailcliente`,`password`,`documento`,`id_restaurante`) ";
		$sql .= "values (\"$ced\",\"$nom\",\"$dir\",\"$tlf\",\"$email\",\"$pass\",1,$tid)";
		return Executor::doit($sql);
	}

	public function addCliente(){
		$tid = isset($this->id_restaurante) ? (int) $this->id_restaurante : self::restaurantId();
		if ($tid <= 0) {
			$tid = 1;
		}
		$this->id_restaurante = $tid;
		$ced = self::esc($this->cedcliente);
		$nom = self::esc($this->nomcliente);
		$dir = self::esc($this->direccliente);
		$tlf = self::esc($this->tlfcliente);
		$email = self::esc($this->emailcliente);
		$pass = self::esc($this->password);
		$estado = self::esc($this->estado);
		$codigo = self::esc($this->codigo);
		$sql = "insert into clientes (`cedcliente`,`nomcliente`,`direccliente`,`tlfcliente`,`emailcliente`,`password`,`documento`,`estado`,`codigo`,`id_restaurante`) ";
		$sql .= "values (\"$ced\",\"$nom\",\"$dir\",\"$tlf\",\"$email\",\"$pass\",1,\"$estado\",\"$codigo\",$tid)";
		$ret = Executor::doit($sql);
		if ($ret && !empty($ret[1])) {
			$this->codcliente = $ret[1];
		}
		return $ret;
	}

	public function updateCantidad(){
		$sql = "update ".self::$tablename." set estado=\"$this->estado\" where codcliente=$this->codcliente";
		Executor::doit($sql);
	}

	public function updateTelefono(){
		$cod = (int) $this->codcliente;
		$tlf = self::esc($this->tlfcliente);
		$sql = "update ".self::$tablename." set tlfcliente=\"$tlf\" where codcliente=$cod";
		Executor::doit($sql);
	}

	public function updateEmail(){
		$cod = (int) $this->codcliente;
		$email = self::esc($this->emailcliente);
		$sql = "update ".self::$tablename." set emailcliente=\"$email\" where codcliente=$cod";
		Executor::doit($sql);
	}

	public static function getById($id){
		$id = (int) $id;
		if ($id <= 0) {
			return null;
		}
		$sql = "select * from ".self::$tablename." where codcliente=$id";
		$query = Executor::doit($sql);
		return self::oneFromQuery($query);
	}

	public static function getByEmail($email, $tenantScoped = true){
		$email = trim((string) $email);
		if ($email === '') {
			return null;
		}
		$emailEsc = self::esc($email);
		$sql = "select * from ".self::$tablename." where LOWER(emailcliente)=LOWER(\"$emailEsc\")";
		if ($tenantScoped) {
			$tid = self::restaurantId();
			$sql .= " AND id_restaurante=".(int) $tid;
		}
		$sql .= " LIMIT 1";
		$query = Executor::doit($sql);
		return self::oneFromQuery($query);
	}

	public static function authenticate($email, $password)
	{
		$email = trim((string) $email);
		$password = (string) $password;
		if ($email === '' || $password === '') {
			return null;
		}

		$tid = self::restaurantId();
		$cli = self::getByEmail($email, true);
		if ($cli && self::passwordsMatch(isset($cli->password) ? $cli->password : '', $password)) {
			return $cli;
		}

		$emailEsc = self::esc($email);
		$sql = "select * from ".self::$tablename." where LOWER(emailcliente)=LOWER(\"$emailEsc\") ORDER BY codcliente DESC LIMIT 20";
		$query = Executor::doit($sql);
		if (!$query || empty($query[0])) {
			return null;
		}
		$rows = Model::many($query[0], new ClientesData());
		if (!$rows) {
			return null;
		}

		foreach ($rows as $row) {
			if (!self::passwordsMatch(isset($row->password) ? $row->password : '', $password)) {
				continue;
			}
			$rid = isset($row->id_restaurante) ? (int) $row->id_restaurante : 0;
			if ($tid > 0 && $rid === $tid) {
				return $row;
			}
			// Cuentas creadas en la web antes de guardar el restaurante (DEFAULT 1 / 0)
			if ($tid > 0 && ($rid <= 1) && $rid !== $tid) {
				$cod = (int) $row->codcliente;
				Executor::doit("update ".self::$tablename." set id_restaurante=".(int) $tid." where codcliente=".$cod);
				$row->id_restaurante = $tid;
				return $row;
			}
			if ($tid <= 1 && $rid <= 1) {
				return $row;
			}
		}

		return null;
	}

	public static function startWebSession($cli)
	{
		if (!$cli || empty($cli->codcliente)) {
			return;
		}
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = isset($cli->emailcliente) ? $cli->emailcliente : '';
		$_SESSION['id_cliente'] = $cli->codcliente;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (8 * 3600);
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		if (!$query || empty($query[0])) {
			return array();
		}
		return Model::many($query[0], new ClientesData());
	}
}
?>
