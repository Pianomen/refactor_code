<?php declare(strict_types=1);
      require_once(dirname(__FILE__) . "/../sec.php"); pathcheck(MYPATH);
      require_once(dirname(__FILE__) . "/../config.php");

class User {

    protected static $db;

    public function __construct() {
        global $conn;
        self::$db = &$conn;
    }

    private $algo = "sdjfhksjdfhbjzbcvjnzbvbdf354321321";

    private static function encrypt_id($id) {
        return crypt($id, self::$algo);
    }

    private static function decrypt_id($id) {
    }

    public static function create(array $db_array = null){

        if(!is_null($db_array)){

            array_walk($db_array, function(&$item) {
                return($item = "'{$item}'");
            });

            $db_data = implode(", ", $db_array);

            $query = "INSERT INTO workers (`name_surname`, `address`, `phone`, `state`, `password`, `email`) VALUES ({$db_data})";

            (self::$db)->exec($query);

            $db_id = (self::$db)->lastInsertId();

            return $db_id;

        }

    }


    public static function read( $id = null ){
        $query = "SELECT * FROM `workers`" . ( ($id > 0)?  " WHERE id={$id}" : " ORDER BY id DESC" ); $response_array = [];

        $request = (self::$db)->prepare($query);
        $request->execute();

        while($response = $request->fetch(PDO::FETCH_ASSOC)){
            array_push($response_array, $response);
        }

        return $response_array;

    }

    public static function update($data){
        try{

            if(!is_null($data)){

                $sql = "UPDATE `workers` SET name_surname=:name, address=:address, phone=:phone, state=:state, password=:password, email=:email WHERE id=:id";

                (self::$db)->prepare($sql)->execute($data);
            }


        }catch(PDOException $e){
            print_r("<pre>");
            echo $e->getMessage();
        }

    }

    public static function delete($id){

        try{

           $sql = "DELETE FROM `workers` WHERE id=$id";
           (self::$db)->exec($sql);

        }catch(PDOException $e){
            print_r("<pre>");
            echo $e->getMessage();
       }

    }

    public static function query($q){
        (self::$db)->exec($q);
    }

    # user exists
    public static function usr_exists($usr_e){

        if( empty($usr_e) ){
           echo "user name or user password is empty";
        }

        $sql = "SELECT * FROM `workers` WHERE email=:email";

        $query = (self::$db)->prepare($sql);
        $query->execute(
            array(
                ':email'=> $usr_e
            )
        );

        if( $query ){

            $que = "SELECT id FROM `workers` WHERE email=:m";
            $q = (self::$db)->prepare($que);
            $q->execute(array( ':m' => $usr_e ));

            while($result = $q->fetch(PDO::FETCH_ASSOC)){
                return $result;
            }

        }else{
            return false;
        }

    }

    public static function email_exists($email){

        try {

            $query = "SELECT * FROM `workers` WHERE email=:email";
            $q = (self::$db)->prepare($query);
            $q->execute( array( 'email' => $email ) );
            $count_row = $q->rowCount();

            if( $count_row ){
                return true;
            }else{
                return false;
            }

        } catch(PDOException $e){
            print_r("<pre>");
            echo $e->getMessage();
       }

    }

    public function __destruct() {
        global $conn;
        $conn = null;
    }
}
$User = new User();

