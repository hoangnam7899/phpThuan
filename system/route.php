<?php
namespace System;
class Route
{
   protected $query = null;
   protected $params = [];
   protected $controller;
   protected $method;
   public function __construct()
   {
       $this->handleQuery();
      $fullController = $this->handelController();

      if(!is_null($fullController)){
         $arrayController = explode("@",$fullController);
      }
      if (count($arrayController) !=2) {
        throw new Exception("Error Controller", 500);
        
      }
      $this->controller = $arrayController[0];
      $this->method =  $arrayController[1];
      var_dump($this->method);
   }

   // Xử lý query
   protected function handleQuery()
   {
      if (isset($_GET['q']) && !empty($_GET['q'])) {
        return $this->query = trim($_GET['q'], '/');
      }
      return null;
   }
   // Xử lý controller
  protected function handelController(){
      if(is_null($this->query)){
         return null;
      }
      global $_Route;

      if (isset($_Route[$this->query]) && $_Route[$this->query] != '') {
         return $_Route[$this->query];
      }

     

     $countQuery = count(explode("/", $this->query));
     $fullController = null;
     foreach ($_Route as $key => $value) {
      $countKey = count(explode("/", $key));
         if ($countQuery == $countKey) {
            $pregex = preg_replace('/{(.*?)}/i', '([a-zA-Z0-9\-]+)', $key);
            
            $pregexNew = "/" . str_replace("/","\/",$pregex) . "/i";
            
            
            if (preg_match($pregexNew, $this->query, $matches)) {
               preg_match_all("/{(.*?)}/i", $key, $pregexQuery);

               unset( $matches[0]);

              $arrValue = array_values($matches);

               $this->params = array_combine($pregexQuery[1], $arrValue);
               
               $fullController = $value;
               break;  
            } 
         }   
     }
     return $fullController;
  }
}