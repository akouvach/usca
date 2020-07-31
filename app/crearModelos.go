package main

/* Importamos las dependencias */
import (
	"database/sql"
	"fmt"
	"io/ioutil"
	"log"
	"os"
	"path"
	"strconv"
	"strings"
	"time"

	_ "github.com/go-sql-driver/mysql"
)

/* Declaramos la variable global con la conexión a la BBDD */
var db *sql.DB

//Columna Estructura para almacenar lod datos de una columna de una tabla
type Columna struct {
	columna   string
	tipo      string
	extra     string
	columnkey string
}

//Tabla Estructura para almacenar los datos de una tabla
type Tabla struct {
	nombre   string
	columnas []Columna
}

//Str_DIV Ascii para el símbolo de división
const Str_DIV = 47

// Str_DOUBLE Ascii para las comillas dobles
const Str_DOUBLE = 34

// Str_SIMPLE Ascii para comillas simples
const Str_SIMPLE = 39

// Str_BACK Ascii para backslash
const Str_BACK = 92

func main() {
	var err error

	/* Nos conectamos a la BBDD */
	// "mysql", "username:password@tcp(127.0.0.1:3306)/test"
	db, err = sql.Open("mysql", "root:@tcp(127.0.0.1:3306)/information_schema?charset=utf8")
	check(err)
	defer db.Close()

	stmt := "SELECT  c.TABLE_NAME, c.column_name , c.data_type , c.extra, c.column_key " +
		"FROM TABLES T INNER JOIN columns C on (t.table_name = c.table_name) " +
		"WHERE t.table_type = 'BASE TABLE' AND t.table_schema='participemos' " +
		"ORDER BY c.table_name, c.ordinal_position "

	rows, err := db.Query(stmt)
	check(err)

	/* Bucle para recorrer todos los registros */
	tablaanterior := ""

	// MiTabla := Tabla{
	// 	nombre: "prueba",
	// 	columnas: []Columna{
	// 		Columna{
	// 			columna:"nombre",
	// 			tipo:"int",
	// 		},
	// 		Columna{
	// 			columna:"tipo",
	// 			tipo:"string",
	// 		},
	// 	} ,
	// }

	MiTabla := new(Tabla)

	dirModel := "model"
	dirController := "controller"
	dirAPI := "api"
	dirRoutes := "routes"

	//Borro los archivos del directorio modelos
	RemoveContents(dirModel)
	// borro los archivos del directorio controlador
	RemoveContents(dirController)
	// borro los archivos del directorio api
	RemoveContents(dirAPI)
	// borro los archivos del directorio routes
	RemoveContents(dirRoutes)

	// recorro las columnas y voy armando al estructura de tablas
	for rows.Next() {
		var tabla, columna, datatype, extra, columnkey string

		/* Leemos el registro */
		rows.Scan(&tabla, &columna, &datatype, &extra, &columnkey)
		if tabla != tablaanterior {
			//Estoy disticnta tabla.

			//Voy a crear el archivo con estos datos
			if tablaanterior != "" {
				fmt.Println("-------------------------------------------------------------")
				fmt.Println("Trabajando en la tabla: " + MiTabla.nombre)
				fmt.Println("-------------------------------------------------------------")

				if MiTabla.crearModelo(dirModel) {
					fmt.Println("Modelo Creado exitosamente")
					if MiTabla.crearControlador(dirController) {
						fmt.Println("Controlador creado exitosamente")
						if MiTabla.crearAPI(dirAPI, dirController) {
							fmt.Println("Api generada exitosamente")
							if MiTabla.crearRutas(dirRoutes, dirController) {
								fmt.Println("Ruta generada exitosamente")
							} else {
								fmt.Println("Error en la creación de las Rutas")
							}
						} else {
							fmt.Println("Error en la creación de las API")
						}
					} else {
						fmt.Println("Error en la creación del controlador")
					}
				} else {
					fmt.Println("Error en la creación del modelo")
				}
			}
			// voy a inicializar el objeto
			MiTabla.nombre = tabla
			MiTabla.columnas = []Columna{}
			tablaanterior = tabla
		}
		// le agrego las columnas
		MiTabla.columnas = append(MiTabla.columnas, Columna{
			columna:   columna,
			tipo:      datatype,
			extra:     extra,
			columnkey: columnkey,
		})

		/* Escribimos el título por pantalla */
		// fmt.Printf( "Tabla %v, Columna: %v , tipo: %v \n ", tabla, columna, datatype )
	}
}

func (t *Tabla) crearRutas(dirRoute string, dirController string) bool {
	rdo := true
	var content strings.Builder

	fileName := "./" + dirRoute + "/api_" + t.nombre + "_base.php"

	content.WriteString("<?php\n\n")
	content.WriteString("/*\n")
	content.WriteString("----Creado----" + time.Now().String() + "\n")
	content.WriteString("*/\n")

	content.WriteString("use Illuminate\\Http\\Request;\n")
	content.WriteString("use Illuminate\\Support\\Facades\\Route;\n\n")

	content.WriteString("include_once(app_path().'\\core\\error_core.php');\n")
	content.WriteString("include_once(app_path().'\\core\\jwt_core.php');\n")
	content.WriteString("include_once(app_path().'\\core\\security.php');\n\n")

	content.WriteString("include_once(app_path().'\\" + dirController + "\\" + t.nombre + "Controller.php');\n\n")

	// GET ALL

	content.WriteString("Route::get('" + t.nombre + "', function (Request $request) {\n")
	content.WriteString("\t$json = '';\n")
	content.WriteString("\ttry {\n")

	content.WriteString("\t\t$token = $request->header('authorization');\n")
	content.WriteString("\t\tif(is_null($token)){\n")
	content.WriteString("\t\t\tthrow new Exception('No envio token de autenticacion');\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t\t$token = str_replace('Bearer ','',$token);\n")
	content.WriteString("\t\t$rdo = verificarSeguridad($token);\n")
	content.WriteString("\t\tif(!$rdo->ok){\n")
	content.WriteString("\t\t\tthrow new Exception('Token no autorizado');\n")
	content.WriteString("\t\t}\n")

	content.WriteString("\t\t$" + t.nombre + " = new " + strings.Title(t.nombre) + "Controller();\n")
	content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")
	content.WriteString("\t\t$json =json_encode($" + t.nombre + "->getAll());\n")
	content.WriteString("\t\thttp_response_code(200);\n")

	content.WriteString("\t} catch (Exception $ex){\n")
	content.WriteString("\t\t$json = json_encode([" + strconv.Quote("rta") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\t\thttp_response_code(500);\n")
	content.WriteString("\t} finally {\n")
	content.WriteString("\t\techo $json;\n")
	content.WriteString("\t}\n")
	content.WriteString("});\n\n\n")

	// GET By Prim

	content.WriteString("Route::get('" + t.nombre)

	c := ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			c += "/{" + col.columna + "}"
		}
	}
	content.WriteString(c)

	content.WriteString("', function (Request $request) {\n")
	content.WriteString("\t$json = '';\n")
	content.WriteString("\ttry {\n")

	content.WriteString("\t\t$token = $request->header('authorization');\n")
	content.WriteString("\t\tif(is_null($token)){\n")
	content.WriteString("\t\t\tthrow new Exception('No envio token de autenticacion');\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t\t$token = str_replace('Bearer ','',$token);\n")
	content.WriteString("\t\t$rdo = verificarSeguridad($token);\n")
	content.WriteString("\t\tif(!$rdo->ok){\n")
	content.WriteString("\t\t\tthrow new Exception('Token no autorizado');\n")
	content.WriteString("\t\t}\n")
	// content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")

	content.WriteString("\t\t$" + t.nombre + " = new " + strings.Title(t.nombre) + "Controller();\n")
	content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")

	content.WriteString("\t\t$json = json_encode($" + t.nombre + "->getByPrim(")

	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += "$request->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("));\n")
	content.WriteString("\t\thttp_response_code(200);\n")

	content.WriteString("\t} catch (Exception $ex){\n")
	content.WriteString("\t\t$json = json_encode([" + strconv.Quote("rta") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\t\thttp_response_code(500);\n")
	content.WriteString("\t} finally {\n")
	content.WriteString("\t\techo $json;\n")
	content.WriteString("\t}\n")
	content.WriteString("});\n\n\n")

	// POST

	content.WriteString("Route::post('" + t.nombre + "', function (Request $request) {\n")
	content.WriteString("\t$json = '';\n")
	content.WriteString("\ttry {\n")

	content.WriteString("\t\t$token = $request->header('authorization');\n")
	content.WriteString("\t\tif(is_null($token)){\n")
	content.WriteString("\t\t\tthrow new Exception('No envio token de autenticacion');\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t\t$token = str_replace('Bearer ','',$token);\n")
	content.WriteString("\t\t$rdo = verificarSeguridad($token);\n")
	content.WriteString("\t\tif(!$rdo->ok){\n")
	content.WriteString("\t\t\tthrow new Exception('Token no autorizado');\n")
	content.WriteString("\t\t}\n")
	// content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")

	content.WriteString("\t\t$" + t.nombre + " = new " + strings.Title(t.nombre) + "Controller();\n")
	content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")
	content.WriteString("\t\t$json = $" + t.nombre + "->create(")

	c = ""
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			if c != "" {
				c += ","
			}
			c += "$request->" + col.columna
		}
	}
	content.WriteString(c)

	content.WriteString(");")
	content.WriteString("\n\t\thttp_response_code(200);\n")

	content.WriteString("\t} catch (Exception $ex){\n")
	content.WriteString("\t\t$json = json_encode([" + strconv.Quote("rta") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\t\thttp_response_code(500);\n")
	content.WriteString("\t} finally {\n")
	content.WriteString("\t\techo $json;\n")
	content.WriteString("\t}\n")
	content.WriteString("});\n")

	// PUT

	content.WriteString("Route::put('" + t.nombre + "', function (Request $request) {\n")
	content.WriteString("\t$json = '';\n")
	content.WriteString("\ttry {\n")

	content.WriteString("\t\t$token = $request->header('authorization');\n")
	content.WriteString("\t\tif(is_null($token)){\n")
	content.WriteString("\t\t\tthrow new Exception('No envio token de autenticacion');\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t\t$token = str_replace('Bearer ','',$token);\n")
	content.WriteString("\t\t$rdo = verificarSeguridad($token);\n")
	content.WriteString("\t\tif(!$rdo->ok){\n")
	content.WriteString("\t\t\tthrow new Exception('Token no autorizado');\n")
	content.WriteString("\t\t}\n")
	// content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")

	content.WriteString("\t\t$" + t.nombre + " = new " + strings.Title(t.nombre) + "Controller();\n")
	content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")
	content.WriteString("\t\t$json = $" + t.nombre + "->update(")
	c = ""
	for _, col := range t.columnas {
		if c != "" {
			c += ","
		}
		c += "$request->" + col.columna

	}
	content.WriteString(c)
	content.WriteString(");")
	content.WriteString("\n\t\thttp_response_code(200);\n")

	content.WriteString("\t} catch (Exception $ex){\n")
	content.WriteString("\t\t$json = json_encode([" + strconv.Quote("rta") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\t\thttp_response_code(500);\n")
	content.WriteString("\t} finally {\n")
	content.WriteString("\t\techo $json;\n")
	content.WriteString("\t}\n")
	content.WriteString("});\n")

	// DELETE

	content.WriteString("Route::delete('" + t.nombre + "', function (Request $request) {\n")
	content.WriteString("\t$json = '';\n")
	content.WriteString("\ttry {\n")

	content.WriteString("\t\t$token = $request->header('authorization');\n")
	content.WriteString("\t\tif(is_null($token)){\n")
	content.WriteString("\t\t\tthrow new Exception('No envio token de autenticacion');\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t\t$token = str_replace('Bearer ','',$token);\n")
	content.WriteString("\t\t$rdo = verificarSeguridad($token);\n")
	content.WriteString("\t\tif(!$rdo->ok){\n")
	content.WriteString("\t\t\tthrow new Exception('Token no autorizado');\n")
	content.WriteString("\t\t}\n")

	content.WriteString("\t\t$" + t.nombre + " = new " + strings.Title(t.nombre) + "Controller();\n")
	content.WriteString("\t\t$" + t.nombre + "->usuarioConectado=$rdo->payload;\n")

	content.WriteString("\t\t$json = $" + t.nombre + "->delByPrim(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += "$request->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("); \n")

	// content.WriteString("\t\t$res = $" + t.nombre + "->update(")
	// c = ""
	// for _, col := range t.columnas {
	// 	if c != "" {
	// 		c += ","
	// 	}
	// 	c += "$request->" + col.columna

	// }
	// content.WriteString(c)
	// content.WriteString(");")
	content.WriteString("\n\t\thttp_response_code(200);\n")

	content.WriteString("\t} catch (Exception $ex){\n")
	content.WriteString("\t\t$json = json_encode([" + strconv.Quote("rta") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\t\thttp_response_code(500);\n")
	content.WriteString("\t} finally {\n")
	content.WriteString("\t\techo $json;\n")
	content.WriteString("\t}\n")
	content.WriteString("});\n")

	content.WriteString("?>")

	b := []byte(content.String())
	err := ioutil.WriteFile(fileName, b, 0666)
	check(err)

	return rdo
}

func (t *Tabla) crearAPI(dirAPI string, dirController string) bool {
	rdo := true
	var content strings.Builder

	fileName := "./" + dirAPI + "/" + t.nombre + "Api_base.php"

	content.WriteString("<?php\n\n")
	content.WriteString("/*\n")
	content.WriteString("----Creado----" + time.Now().String() + "\n")
	content.WriteString("*/\n")

	content.WriteString("require_once '../core/error_core.php';\n")
	content.WriteString("require_once '../core/security.php';\n")
	content.WriteString("require_once '../core/jwt_core.php';\n")
	content.WriteString("require_once '../core/headers.php';\n")
	content.WriteString("require_once '../" + dirController + "/" + t.nombre + "Controller.php';\n\n")

	content.WriteString("try {\n")
	content.WriteString("\t$json = '{" + strconv.Quote("rdo") + ":" + strconv.Quote("") + "}';\n")
	content.WriteString("\t$data = file_get_contents('php://input');\n")
	content.WriteString("\t$input = json_decode($data);\n")
	content.WriteString("\t$accion = $input->accion;\n")
	content.WriteString("\t$miController = new " + strings.Title(t.nombre) + "Controller;\n")

	content.WriteString("\tswitch ($accion) {\n")
	content.WriteString("\t\tcase " + strconv.Quote("GETALL") + ":\n")
	content.WriteString("\t\t\t$result = $miController->getAll();\n")
	content.WriteString("\t\t\t$json = json_encode([" + strconv.Quote("ok") + "=>true," + strconv.Quote("payload") + "=> $result]);\n")
	content.WriteString("\t\t\tbreak;\n")

	content.WriteString("\t\tcase " + strconv.Quote("GETID") + ":\n")
	content.WriteString("\t\t\t$result = $miController->getByPrim(")
	c := ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += " $input->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString(");\n")
	content.WriteString("\t\t\t$json = json_encode([" + strconv.Quote("ok") + "=>true," + strconv.Quote("payload") + "=> $result]);\n")
	content.WriteString("\t\t\tbreak;\n")

	content.WriteString("\t\tcase " + strconv.Quote("DEL") + ":\n")
	content.WriteString("\t\t\t$result = $miController->delByPrim(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += " $input->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString(");\n")
	content.WriteString("\t\t\t$json = json_encode([" + strconv.Quote("ok") + "=>true," + strconv.Quote("payload") + "=> $result]);\n")
	content.WriteString("\t\t\tbreak;\n")

	content.WriteString("\t}\n")

	content.WriteString("\thttp_response_code(200);\n")

	content.WriteString("} catch (Error $err){\n")
	content.WriteString("\t$json = json_encode([" + strconv.Quote("ok") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($err->getMessage())]);\n")
	content.WriteString("\thttp_response_code(500);\n")
	content.WriteString("} catch (Exception $ex){\n")
	content.WriteString("\t$json = json_encode([" + strconv.Quote("ok") + "=>false," + strconv.Quote("payload") + "=>utf8_encode($ex->getMessage())]);\n")
	content.WriteString("\thttp_response_code(500);\n")
	content.WriteString("} finally {\n")
	content.WriteString("\techo $json;\n")
	content.WriteString("}\n")
	content.WriteString("?>")

	b := []byte(content.String())
	err := ioutil.WriteFile(fileName, b, 0666)
	check(err)

	return rdo
}

func (t *Tabla) crearControlador(dirController string) bool {
	rdo := true
	var content strings.Builder

	fileName := "./" + dirController + "/" + t.nombre + "Controlador_base.php"

	content.WriteString("<?php\n\n")
	content.WriteString("/*\n")
	content.WriteString("----Creado----" + time.Now().String() + "\n")
	content.WriteString("*/\n")

	content.WriteString("include_once(app_path()." + "'\\model\\" +
		t.nombre + ".php');\n\n")
	content.WriteString("include_once(app_path()." + "'\\core\\conexion.php');\n\n")
	content.WriteString("class " + strings.Title(t.nombre) + "Controller_base extends Conexion{\n\n")
	content.WriteString("\tprivate $model; \n")

	content.WriteString("\n\tpublic function __construct(){\n")
	content.WriteString("\t\ttry {\n")
	content.WriteString("\t\t\tparent::__construct();\n")
	content.WriteString("\t\t\t$this->model = new " + strings.Title(t.nombre) + "($this->pdo);\n")
	content.WriteString("\t\t} catch (Exception $ex){\n")
	content.WriteString("\t\t\tthrow $ex;\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t}\n\n")

	content.WriteString("\n\tpublic function __get($name){\n")
	content.WriteString("\t\treturn $this->$name;\n")
	content.WriteString("\t}\n\n")

	content.WriteString("\n\tpublic function __set($name, $value){\n")
	content.WriteString("\t\t$this->$name = $value;\n")
	content.WriteString("\t}\n\n")

	content.WriteString("\n\tpublic function getAll(){\n")
	content.WriteString("\t\treturn $this->model->getAll();\n")
	content.WriteString("\t}\n")

	content.WriteString("\n\tpublic function getByPrim(")
	c := ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += " $" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("){\n")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			// if c != "" {
			// 	c += ","
			// }
			c += "\n\t\t$this->model->" + col.columna + "= $" + col.columna + ";"
		}
	}
	content.WriteString(c)

	content.WriteString("\n\t\treturn $this->model->getByPrim();\n")
	content.WriteString("\t}\n")

	content.WriteString("\n\tpublic function delByPrim(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += " $" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("){\n")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			// if c != "" {
			// 	c += ","
			// }
			c += "\n\t\t$this->model->" + col.columna + "= $" + col.columna + ";"
		}
	}
	content.WriteString(c)

	content.WriteString("\n\t\treturn $this->model->delByPrim();\n")
	content.WriteString("\t}\n\n")

	content.WriteString("\n\tpublic function create(")

	c = ""
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			if c != "" {
				c += ","
			}
			c += "$" + col.columna
		}
	}
	content.WriteString(c)

	content.WriteString("){\n")

	c = "\n"
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			c += "\n\t\t$this->model->" + col.columna + "=$" + col.columna + ";"
		}
	}
	content.WriteString(c)

	content.WriteString("\n\n\t\treturn $this->model->create();\n")
	content.WriteString("\t}\n\n")

	content.WriteString("\n\tpublic function update(")

	c = ""
	for i, col := range t.columnas {
		if i != 0 {
			c += ","
		}
		c += "$" + col.columna
	}
	content.WriteString(c)

	content.WriteString("){\n")

	c = ""
	for _, col := range t.columnas {
		c += "\n\t\t$this->model->" + col.columna + "=$" + col.columna + ";"
	}
	content.WriteString(c)

	content.WriteString("\n\n\t\treturn $this->model->update();\n")
	content.WriteString("\t}\n")
	content.WriteString("}\n\n")

	content.WriteString("?>")

	b := []byte(content.String())
	err := ioutil.WriteFile(fileName, b, 0666)
	check(err)

	return rdo
}

func (t *Tabla) crearModelo(dirModel string) bool {
	rdo := true
	var content strings.Builder

	fileName := "./" + dirModel + "/" + t.nombre + "_base.php"

	content.WriteString("<?php\n\n")
	content.WriteString("/*\n")
	content.WriteString("----Creado----" + time.Now().String() + "\n")
	content.WriteString("*/\n")

	content.WriteString("include_once(app_path().'\\core\\crud.php');\n\n")

	content.WriteString("class " + strings.Title(t.nombre) + "_base extends Crud {\n\n")
	for _, col := range t.columnas {
		content.WriteString("\tprivate $" + col.columna + ";\n")
	}

	content.WriteString("\n\tconst TABLE = '" + t.nombre + "';\n")

	content.WriteString("\n\tpublic function __construct($pdo){\n")
	content.WriteString("\t\tparent::__construct($pdo, self::TABLE);\n")
	content.WriteString("\t}\n")

	content.WriteString("\n\tpublic function __get($name){\n")
	content.WriteString("\t\treturn $this->$name;\n")
	content.WriteString("\t}\n")

	content.WriteString("\n\tpublic function __set($name, $value){\n")
	content.WriteString("\t\t$this->$name = $value;\n")
	content.WriteString("\t}\n")

	//
	// Create
	//
	content.WriteString("\n\tpublic function create(){\n")

	content.WriteString("\n\n\t\ttry {\n")
	content.WriteString("\t\t\t$sql = 'insert into '.self::TABLE.' (")
	c := ""
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			if c != "" {
				c += ","
			}
			c += col.columna
		}
	}
	content.WriteString(c)
	content.WriteString(") values(")
	c = ""
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			if c != "" {
				c += ","
			}
			c += "?"
		}
	}
	content.WriteString(c)
	content.WriteString(")';\n")

	content.WriteString("\t\t\t$stmt = $this->pdo->prepare($sql);\n")
	content.WriteString("\t\t\t$result = $stmt->execute(array(")
	c = ""
	for _, col := range t.columnas {
		if col.extra != "auto_increment" {
			if c != "" {
				c += ","
			}
			c += "$this->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("));\n")

	// Me fijo si tiene id autogenerado

	c = ""
	for _, col := range t.columnas {
		if col.extra == "auto_increment" {
			c += "\t\t\t$this->" + col.columna + " = $this->pdo->lastInsertId();\n"

		}
	}
	content.WriteString(c)

	content.WriteString("\t\t\t$stmt->closeCursor();\n")
	content.WriteString("\t\t\treturn $result;\n")
	content.WriteString("\t\t} catch (PDOException $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Error $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Exception $ex){\n")
	content.WriteString("\t\t\tthrow $ex;\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t}\n")

	//
	// update
	//
	content.WriteString("\tpublic function update(){\n")
	content.WriteString("\t\ttry {\n")
	content.WriteString("\t\t\t$sql = 'update '.self::TABLE.' set ")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey != "PRI" {
			if c != "" {
				c += ","
			}
			c += " " + col.columna + " = ? "
		}
	}
	content.WriteString(c)
	content.WriteString("where ")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += " and "
			}
			c += " " + col.columna + " = ? "
		}
	}
	content.WriteString(c + "';\n")

	content.WriteString("\t\t\t$stmt = $this->pdo->prepare($sql);\n")
	content.WriteString("\t\t\t$result = $stmt->execute(array(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey != "PRI" {
			if c != "" {
				c += ","
			}
			c += " $this->" + col.columna + " "
		}
	}
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += ","
			}
			c += " $this->" + col.columna + " "
		}
	}
	content.WriteString(c)

	content.WriteString("));\n")
	content.WriteString("\t\t\treturn $result;\n")
	content.WriteString("\t\t} catch (PDOException $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Error $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Exception $ex){\n")
	content.WriteString("\t\t\tthrow $ex;\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t}\n")

	//
	// getByPrim
	//
	content.WriteString("\tpublic function getByPrim(){\n")
	content.WriteString("\t\ttry {\n")
	content.WriteString("\t\t\t$sql = 'select * from '.self::TABLE.' where ")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += " and "
			}
			c += " " + col.columna + " = ? "
		}
	}
	content.WriteString(c + "';\n")
	content.WriteString("\t\t\t$stmt = $this->pdo->prepare($sql);\n")
	content.WriteString("\t\t\t$result = $stmt->execute(array(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += " , "
			}
			c += " $this->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("));\n")

	content.WriteString("\t\t\t$result = $stmt->fetchAll(PDO::FETCH_OBJ);\n")
	content.WriteString("\t\t\treturn $result;\n")
	content.WriteString("\t\t} catch (PDOException $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Error $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Exception $ex){\n")
	content.WriteString("\t\t\tthrow $ex;\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t}\n")

	//
	// delByPrim
	//
	content.WriteString("\tpublic function delByPrim(){\n")
	content.WriteString("\t\ttry {\n")
	content.WriteString("\t\t\t$sql = 'delete from '.self::TABLE.' where ")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += " and "
			}
			c += " " + col.columna + " = ? "
		}
	}
	content.WriteString(c + "';\n")
	content.WriteString("\t\t\t$stmt = $this->pdo->prepare($sql);\n")
	content.WriteString("\t\t\t$result = $stmt->execute(array(")
	c = ""
	for _, col := range t.columnas {
		if col.columnkey == "PRI" {
			if c != "" {
				c += " , "
			}
			c += " $this->" + col.columna
		}
	}
	content.WriteString(c)
	content.WriteString("));\n")
	content.WriteString("\t\t\treturn $result;\n")
	content.WriteString("\t\t} catch (PDOException $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Error $err){\n")
	content.WriteString("\t\t\tthrow $err;\n")
	content.WriteString("\t\t} catch (Exception $ex){\n")
	content.WriteString("\t\t\tthrow $ex;\n")
	content.WriteString("\t\t}\n")
	content.WriteString("\t}\n")

	content.WriteString("}\n")
	content.WriteString("?>")

	// dir := "modelos"
	// err:=os.Mkdir(dir, 0777)
	// check(err)

	// fileName = path.Join(dir, fileName)

	//f, err := os.Create(t.nombre)
	b := []byte(content.String())
	err := ioutil.WriteFile(fileName, b, 0666)
	check(err)

	return rdo
}

// RemoveContents borra el contenido de un directorio
func RemoveContents(dir string) error {
	d, err := os.Open(dir)
	check(err)

	defer d.Close()
	names, err := d.Readdirnames(-1)
	check(err)

	for _, name := range names {

		if strings.HasSuffix(name, "_base.php") {
			err = os.RemoveAll(path.Join(dir, name))
			check(err)
		}
	}
	return nil
}

func check(e error) {
	if e != nil {
		log.Fatal(e)
		panic(e)
	}
}
