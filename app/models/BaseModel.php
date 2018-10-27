<?php 

class BaseModel {
    protected $host = "127.0.0.1";
    protected $dbName = "hvcg_demo_db";
    protected $password = "";
    protected $userName = "root";
    //protected $queryBuilder = "";

    public function __construct(){
        $this->connect = new PDO("mysql:host=".$this->host."; dbname=".$this->dbName."; charset=utf8;", $this->userName, $this->password);
    }

    public function insert(){
        $this->queryBuilder = "insert into $this->table (";
        foreach($this->columns as $col){
            if($this->{$col} !== null){
                $this->queryBuilder .= "$col, ";
            }
        }
        $this->queryBuilder = rtrim($this->queryBuilder, ", ");
        $this->queryBuilder .= ") values (";
        foreach($this->columns as $col){
            if($this->{$col} !== null){
                $this->queryBuilder .= "'".$this->{$col}."', ";
            }
        }
        $this->queryBuilder = rtrim($this->queryBuilder, ", ");
        $this->queryBuilder .= ")";
        $stmt = $this->connect->prepare($this->queryBuilder);

        try{
            $stmt->execute();
            return $this;
        }catch (PDOException $e){
            echo $e->getMessage();die;
        }
        
    }

    public static function all(){
        $model = new static();
        $sql = "select * from ".$model->table;
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();

        $rs = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        
        return $rs;
    }

    public static function find($id){
        $model = new static();
        $sql = "select * from ".$model->table." where id = $id";
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();

        $rs = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        //var_dump($rs[0]);die;
        return $rs[0];
    }

    public static function where($arr = []){
        $model = new static();
        $model->queryBuilder = "select * from ".$model->table." where ";

        if(count($arr) == 2){
            $model->queryBuilder .= "$arr[0] = '$arr[1]'";
        }
        if(count($arr) == 3){
            $model->queryBuilder .= "$arr[0] $arr[1] '$arr[2]'";
        }
        //var_dump($model->queryBuilder);die;
        return $model;
        
    }


    public function andWhere($arr = []){
        $this->queryBuilder .= " and ";

        if(count($arr) == 2){
            $this->queryBuilder .= "$arr[0] = '$arr[1]'";
        }
        if(count($arr) == 3){
            $this->queryBuilder .= "$arr[0] $arr[1] '$arr[2]'";
        }
        //var_dump($this->queryBuilder);die;
        return $this;
    }

    public function orWhere($arr = []){
        $this->queryBuilder .= " or ";

        if(count($arr) == 2){
            $this->queryBuilder .= "$arr[0] = '$arr[1]'";
        }
        if(count($arr) == 3){
            $this->queryBuilder .= "$arr[0] $arr[1] '$arr[2]'";
        }
        //var_dump($this->queryBuilder);
        return $this;
    }

    public function get(){
        $stmt = $this->connect->prepare($this->queryBuilder);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));

        return $rs;
    }

    public static function delete($id)
    {
        $model = new static();

        $sql = "DELETE FROM ".$model->table." WHERE id = ".$id;
        $stmt = $model->connect->prepare($sql);
        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function update(){
        $this->queryBuilder = "update $this->table set ";
        foreach($this->columns as $col){
            if($this->{$col} == null){
                continue;
            }
            $this->queryBuilder .= " $col = '" .$this->{$col}."', ";
        }
        $this->queryBuilder = rtrim($this->queryBuilder, ", ");

        $this->queryBuilder .= "where id = $this->id";

        //var_dump($this->queryBuilder);die;
        $stmt=$this->connect->prepare($this->queryBuilder);

        try {
            $stmt->execute();
            return $this;
        } catch(PDOException $e){
            echo $e->getMessage();die;
        }
    }


}