<?php

class conn{
    
    public $db_name;
    public $baglanti;

    public function __construct($db)
    {
        try{
        $this->db_name = $db;
        $connect = mysqli_connect("db", "admin", "admin", $this->db_name);
        $this->baglanti = $connect;
        }

        catch(exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function select($query)
    {

        try{
        $sorgu = $this->baglanti->prepare($query);
        $sorgu->execute();
        

        $sorgu = $sorgu->get_result();

        $rows = $sorgu->fetch_all(MYSQLI_ASSOC);
        
        return $rows;}

        catch(exception $e)
        {
          echo "Select İşleminde bir hata oluştu. Kaynak=>conn.php/line38" . "-------- HATA MESAJI: ". $e->getMessage();
        }
    }

    public function selectARR($query)
    {

        try{
        $sorgu = $this->baglanti->prepare($query);
        $sorgu->execute();
        

        $sorgu = $sorgu->get_result();

        $rows = $sorgu->fetch_all();
        
        return $rows;}

        catch(exception $e)
        {
          echo "SelectARR İşleminde bir hata oluştu. Kaynak=>conn.php/line58" . "-------- HATA MESAJI: ". $e->getMessage();
        }
    }

    /*public function insert($query)
    {

      try{
       $sorgu = $this->baglanti->prepare($query);

       $sorgu->execute();


       echo "insert işlemi yapıldı!";
      }
      catch(exception $e)
      {
        echo "İnsert İşleminde bir hata oluştu. Kaynak=>conn.php/line56" . "-------- HATA MESAJI: ". $e->getMessage();
      }

    }

    public function delete($query)
    {

      try{
       $sorgu = $this->baglanti->prepare($query);


       $sorgu->execute();
      }
      catch(exception $e)
      {
        echo "Delete İşleminde bir hata oluştu. Kaynak=>conn.php/line71" . "-------- HATA MESAJI: ". $e->getMessage();
      }

    }*/


    public function updein($query) //update, delete, insert aynı fonksiyonda
    {

      try{
       $sorgu = $this->baglanti->prepare($query);


       $sorgu->execute();
      }
      catch(exception $e)
      {
        echo "updein İşleminde bir hata oluştu. Kaynak=>conn.php/line89" . "query: ". $query ."-------- HATA MESAJI: ". $e->getMessage();
      }

    }
     
    
    
    
    
    
}

$connection = new conn("restaurant_app");



?>