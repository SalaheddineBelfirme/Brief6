<?php
session_start();
  class Pages extends Controller {
    private $postModel;
    private $navire;
    private $Port;
    public static $btn;
    
    public function __construct(){
      $this->postModel = $this->model('croisiereM');
      $this->navire = $this->model('navierM');
      $this->Port = $this->model('portM');

    }
    
    
   
   static public function  test(){
    
    if(isset($_SESSION['log'])  && $_SESSION['log']<>false){
      if( ($_SESSION['log'][0]->role==1 ) ){
        return "block";
      }
      
    }
    else {
      return "none";
    }
    }
    static public function  testlog(){
      if(isset($_SESSION['log']) && $_SESSION['log']<>false ){
        if( ($_SESSION['log'][0]->role==1 ) ){
  
          return "logout";
        }
        
      }
      else {
        return "login";
      }
      
      }

    public function index(){
      $data = [
        'title' => 'Welcome'
      ];
     
      $this->view('pages/index', $data);
    }
    public function home(){
      $data = [
        'title' => 'home Us'
      ];

      $this->view('pages/home', $data);
    }

    public function details(){
      $data = [
        'title' => 'd Us'
      ];

      $this->view('pages/details', $data);
    }
    
    
    public function login(){
      $data = [
        'title' => 'login Us'
      ];

      $this->view('pages/login', $data);
    }
    public function logout(){
      session_destroy();
      $this->view('pages/login');
    }
    public function about(){
      $data = [
        'title' => 'About Us'
      ];

      $this->view('pages/about', $data);
    }

    public function signin(){
      $data = [
        'title' => 'signin Us'
      ];

      $this->view('pages/signin', $data);
    }

    public function contact(){
      $data = [
        'title' => 'contact'
      ];

      $this->view('pages/contact', $data);
    }
    public function add_navier(){
      $data = [
        'title' => 'add_navier '
      ];

      $this->view('pages/add_navier', $data);
    }

    public function croisiere(){
      $param=array(null,null,null);
      $bol=true;
      if(isset($_POST["port"])){
        $bol=false;
        $param[0]=$_POST["port"];
    

      }
      if(isset($_POST["navier"])){
        $bol=false;
        $param[1]=$_POST["navier"];

      }
      if(isset($_POST["date"])){
        $bol=false;
        $param[2]=$_POST["date"];
       
      }
     
      if($bol){
        $croisiere=$this->postModel->getall();
      }
      else{
     
        $croisiere=$this->postModel->getforfilter($param);
      }
     $filter =$this->postModel->getall();
        $data = [
          'filter' => $filter,
          'croisiere'=>$croisiere
        ];
  
        $this->view('pages/croisiere', $data);
      }



    public function add_croisi(){
      $data = [
        'title' => 'add_croisi Us'
      ];

      $this->view('pages/add_croisi', $data);
    }



    public function add_port(){
      $data = [
        'title' => 'add_port'
      ];

      $this->view('pages/add_port', $data);
    }
    public function dashboard(){
     if(isset($_SESSION['log'])){
      if( ($_SESSION['log'][0]->role==1 ) ){
        $croisiere=$this->postModel->getall();
        $datanavier= $this->navire->getnavier();
        $dataPort=$this->Port->getPORT();
  
        $data = [
          'croisiere' => $croisiere,
          'navier'=> $datanavier,
          'Port'=> $dataPort,
       
        ];
        $this->view('pages/dashboard', $data);
  
  
       }
     }
   

     else{
      header("Location: http://localhost/brief6/traversymvc/pages/login");

     }
     
    }

  }


  