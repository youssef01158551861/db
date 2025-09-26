<?php
interface db{
public function insert();
public function update();
public function delete();
public function select($coulam="*");
public function condation($pk,$fk);
public function connect();
// public function prin();
public function join($coulam="*",$type);

}
class user implements db{
private $sql;
private $coon;
private $table;
private $key;
private $valu;
private $name;
private $id;
private $condtion;
private $q;
private $prin;
private $table1;
private $condtion1;
public function __construct($table,$table1) {
  $this->coon=mysqli_connect('127.0.0.1','root','','task4');
  $this->table=$table;
  $this->table1=$table1;
}
public function data($data){
$this->valu="";
$this->key="";
foreach($data as $key=>$valu){

$this->valu.="'$valu',";
$this->key.="$key,";
}
$this->key=rtrim($this->key,",");
$this->valu=rtrim($this->valu,",");

foreach($data as $k=>$v){
if($k=="id"){$this->id=$v;}
elseif($k=="name"){$this->name=$v ;}
}}
public function insert(){
$this->sql="INSERT INTO `$this->table`($this->key)VALUES($this->valu)";
return $this;
}
public function update(){
$this->sql="UPDATE `$this->table` SET `name`='$this->name' $this->condtion";
return $this;
}
public function delete(){
$this->sql="DELETE FROM `$this->table`$this->condtion";
return $this;
}
public function select($coulam="*"){
$this->sql="SELECT $coulam FROM `$this->table` $this->condtion";
return $this;

}
public function condation($pk,$fk){
$this->condtion="WHERE `id`=$this->id";
$this->condtion1="$this->table.$pk=$this->table1.$fk";
return $this;
}
public function connect(){
$this->q=mysqli_query($this->coon,$this->sql);
return $this;

}
public function join($coulam="*",$type){
$this->sql="SELECT $coulam FROM `$this->table` $type JOIN `$this->table1` on $this->condtion1";
return $this;
}


public function __destruct(){
$this->prin=mysqli_fetch_all($this->q,MYSQLI_ASSOC);
if($this->prin){
echo "<pre>";
print_r($this->prin);}
else{echo "errors";}
}
}
// tabel 1 هوا الي فيه fk
$x=new user("users","phone");
$x->condation("id","user_phone")->join("users.name AS user_name","LEFT")->connect();


