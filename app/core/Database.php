<?php
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // Last Insert Id
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    // Helper: Convert Associative Array to Object (Legacy Support for Models)
    public function toObjects($array)
    {
        $objects = [];
        foreach ($array as $key => $value) {
            $objects[$key] = (object) $value;
        }
        return $objects;
    }

    /**
     * Legacy adapter methods to support existing codebase that was built for JSON DB
     * These map the old JSON-style method calls to the new PDO implementation
     */

    public function findAll($table)
    {
        $this->query("SELECT * FROM " . $table);
        return $this->resultSet(); // Returns array of objects, which is standard
    }

    public function findWhere($table, $conditions)
    {
        $sql = "SELECT * FROM " . $table;
        $where = [];
        foreach ($conditions as $key => $value) {
            $where[] = "$key = :$key";
        }
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $this->query($sql);
        foreach ($conditions as $key => $value) {
            $this->bind(':' . $key, $value);
        }

        // The old system returned arrays, but controllers expect objects mostly
        // Converting to array to match exact behavior of the JSON class if needed,
        // but typically PDO FETCH_OBJ is preferred in MVC. 
        // Let's stick to FETCH_OBJ standard and output array of objects.
        return $this->resultSet();
    }

    public function findOne($table, $conditions)
    {
        $res = $this->findWhere($table, $conditions);
        return !empty($res) ? $res[0] : false;
    }

    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $placeholders . ")";
        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }

        if ($this->execute()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }

    public function update($table, $id, $data)
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $setSql = implode(', ', $set);

        $sql = "UPDATE " . $table . " SET " . $setSql . " WHERE id = :id";
        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        $this->bind(':id', $id);

        return $this->execute();
    }

    public function delete($table, $id)
    {
        $this->query("DELETE FROM " . $table . " WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute();
    }
}
