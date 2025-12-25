 <?php

 

      class student {

    final public function name(){
    echo "my name <br>";
   }
   final public function myemail(){
    echo "my email <br>";
   }
   public function prof(){
    echo "my prof <br>";
   }

}
   class anass extends student {
 
    /*public function name(){
        echo "my name anass <br>";
    }*/
    /*public function myemail(){
        echo "my email is anass@gmail.com <br>";
    }*/
    public function prof(){
        echo "my prof is acherf";
    }

   }

    /*$etudient1=new student ();
        $etudient1->name();
        $etudient1->myemail();
        $etudient1->prof();*/


$etudient2=new anass ();
        $etudient2->name();
        $etudient2->myemail();
        $etudient2->prof();


?>
