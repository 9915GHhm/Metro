<?php 
class Algorithm extends UsersModels{

	private $date;
	private $table;
	private $result;

	public function __construct($date, $table)
	{
		$this->date = $date;
		$this->table = $table;
	}

	public function algorithm()
	{
		$fr = explode("-", $this->date); // Divide la fecha que viene en "$this->date" en 3 partes.
		@$fer = $fr[0]."/".$fr[1]."/".$fr[2]; // Zetea el arreglo "$fr" en (d/m/Y).
		$days = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
		$num = @$days[date('N', strtotime($fer))]; // Según la fecha, le da el valor de la semana a "$num".
		$see = ($num !== NULL)?$num:"Domingo"; // Sí "$num" viene con valor nulo, este le da el "domingo".

		if (!isset($this->date)) {

			require_once('../metro/views/welcome.php');

		}elseif($fer === '//' or $this->table === 'Selección'){

            header('Location: ./?error4');

		}else{
			switch ($this->table){ // Con el "switch" se obtiene la fecha, sgún la tabla.
				case '1': // Se usa "explode()" para zetear la fecha a (Y-m-d) pora que lo entieda 
				$ele = '30/06/2017';  // el sistema.
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '2':
				$ele = '02/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '3':
				$ele = '04/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '4':
				$ele = '06/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '5':
				$ele = '08/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '6':
				$ele = '10/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '7':
				$ele = '12/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '8':
				$ele = '14/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '9':
				$ele = '16/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '10':
				$ele = '18/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '11':
				$ele = '20/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '12':
				$ele = '22/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '13':
				$ele = '24/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '14':
				$ele = '26/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				case '15':
				$ele = '28/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;

				default:
				$ele = '30/07/2017';
				$fe = explode("/", $ele);
				$fech = $fe[2]."-".$fe[1]."-".$fe[0];
				break;
			}
			$dia = $this->date;
			$f = explode("-", $dia);  // Se zetea la fecha nuevamente al formato (d/m/Y)
			@$fecha = $f[0]."/".$f[1]."/".$f[2];

			$V = array(
				'Es tu 1er. día de trabajo para la noche.',
				'Es tu 2do. día de trabajo para la noche.',
				'Es tu 3er. día de trabajo para la noche.',
				'Es tu 4to. día de trabajo para la noche.',
				'Es tu 5to. día de trabajo para la noche.',
				'Estás de noche!',
				'Es tu 1er. día libre de la noche.',
				'Es tu 2do. día libre de la noche.',
				'Es tu 1er. día de trabajo para los 3.',
				'Es tu 2do. día de trabajo para los 3.',
				'Es tu 3er. día de trabajo para los 3.',
				'Es tu 4to. día de trabajo para los 3.',
				'Es tu 5to. día de trabajo para los 3.',
				'Es tu 1er. día libre de los 3.',
				'Es tu 2do. día libre de los 3.',
				'Es tu 3er. día libre de los 3.'
			);

			$segundos=strtotime($fecha) - $pe=strtotime($fech); // Se usa esto para que en la fecha inicial
			$N=intval($segundos/60/60/24, $pe/60/60/24) % 16;   // y final se obtenga número en un ciclo 
                                                                // del 1 al 16, por tal motivo se usa el
			$dia2 = $this->date;                                // módul "%16".
			$f2 = explode("-", $dia2); // Se zetea la fecha nuevamente al formato (Y/m/d)
			$fecha2 = $f2[2]."/".$f2[1]."/".$f2[0];

			if ($N + $this->table <= 15) {     // Según el número obtenido en "$N", este se complementa con
				$N = ($N + $this->table) % 16; // el arreglo "$V", dando la condición del arreglo señalado
				if ($N < 0) {                  // según tabla, fecha y día de la semana.
					$N = $N * (-1);
					$this->result = $V[$N]; 
					if(isset($this->date)){
						require_once('../metro/views/condition.php');

					}
				}else{
					$this->result = $V[$N];
					if(isset($this->date)){
						require_once('../metro/views/condition.php');

					}
				}
				if ($N == 3) {
					exit();
				}
			}else{
				$N = ($N + $this->table) % 16;
				$this->result = $V[$N];
				if(isset($this->date)){
					require_once('../metro/views/condition.php');
				}
			}
		}
	}
} 
?>