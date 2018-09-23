<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 29/07/2018
 * Time: 21:08
 */

namespace App\DataFixtures;


use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'admin';
    public const ACCOUNTANT_REFERENCE  = 'accountant';
    public const SUPPLY_REFERENCE  = 'supply';
    public const LOGISTIC_REFERENCE = 'logistic';
    public const SALESMAN_REFERENCE = 'salesman';
    public const WAREHOUSEMAN_REFERENCE = 'warehouseman';
    public const DELIVERYMAN_REFERENCE = 'deliveryman';


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        
        
          $profils[] = array('Emilien' ,  'Letestu' ,  'eletestu@gmail.com' , '12345678' , 'ADMIN' , 'admin'  )  ;
          $profils[] = array('Vernon' ,  'Littleblackman' ,  'sandyrazafitrimo@gmail.com' , 'g&r!11Eleven' , 'ADMIN' , 'admin'  )  ;
     //     $profils[] = array('Fanja' ,  'Pelitera' ,  'fanja@pelitera.net' , 'fanjaPe' , 'MANAGER' , 'manager'  )  ; 
     //     $profils[] = array('Patrick' ,  'Pelitera' ,  'patrick@pelitera.net' , 'patrickPe' , 'MANAGER' , 'manager'  )  ; 
          $profils[] = array('Alex' ,  'Razanako' ,  'alex@accountant.net' , 'alexRa' , 'ACCOUNTANT' , 'accountant'  )  ; 
          $profils[] = array('Julian ' ,  'Ratsaina' ,  'julian@accountant.net' , 'julianRa' , 'ACCOUNTANT' , 'accountant'  )  ; 
          $profils[] = array('Nana' ,  'Andriampela' ,  'gloria@accountant.net' , 'nanaAn' , 'ACCOUNTANT' , 'accountant'  )  ; 
          $profils[] = array('Melman' ,  'Ramadino' ,  'melman@supply.net' , 'melmanRa' , 'SUPPLY' , 'supply'  )  ; 
          $profils[] = array('Maurice' ,  'Ramaditra' ,  'maurice@supply.net' , 'mauriceRa' , 'SUPPLY' , 'supply'  )  ; 
          $profils[] = array('Rico' ,  'Anembona' ,  'rico@supply.net' , 'ricoAn' , 'SUPPLY' , 'supply'  )  ; 
          $profils[] = array('Gloria' ,  'Farakely' ,  'gloria@logistic.net' , 'gloriaFa' , 'LOGISTIC' , 'logistic'  )  ; 
          $profils[] = array('Mason' ,  'Ririnina' ,  'mason@logistic.net' , 'masonRi' , 'LOGISTIC' , 'logistic'  )  ; 
          $profils[] = array('David' ,  'Siramamy' ,  'david@logistic.net' , 'davidSi' , 'LOGISTIC' , 'logistic'  )  ; 
          $profils[] = array('Kowa' ,  'Rahafahafa' ,  'kowa@salesman.net' , 'kowaRa' , 'SALESMAN' , 'salesman'  )  ; 
          $profils[] = array('Morty' ,  'Ramanga' ,  'morty@salesman.net' , 'mortyRa' , 'SALESMAN' , 'salesman'  )  ; 
          $profils[] = array('Mason' ,  'Firaisan-kina' ,  'mason@salesman.net' , 'masonFi' , 'SALESMAN' , 'salesman'  )  ; 
          $profils[] = array('Marty' ,  'Antsokosoko' ,  'marty@warehouseman.net' , 'martyAn' , 'WAREHOUSEMAN' , 'warehouseman'  )  ; 
          $profils[] = array('Tom' ,  'Rafloara' ,  'tom@warehouseman.net' , 'tomRa' , 'WAREHOUSEMAN' , 'warehouseman'  )  ; 
          $profils[] = array('Christophe' ,  'Rafanafody' ,  'christophe@warehouseman.net' , 'christopheRa' , 'WAREHOUSEMAN' , 'warehouseman'  )  ; 
          $profils[] = array('David' ,  'Iantrao' ,  'david@deliveryman.net' , 'davidIa' , 'DELIVERYMAN' , 'deliveryman'  )  ; 
          $profils[] = array('Elise' ,  'Mbolatia' ,  'elise@deliveryman.net' , 'eliseMb' , 'DELIVERYMAN' , 'deliveryman'  )  ; 
          $profils[] = array('Jada' ,  'Ralenina' ,  'jada@deliveryman.net' , 'jadaRa' , 'DELIVERYMAN' , 'deliveryman'  )  ; 

          $refs =[];
        
          foreach($profils as $profil)
          {
                  $user = new User();
                  $user->setName($profil[0]);
                  $user->setSurname($profil[1]);
                  $user->setEmail($profil[2]);
                  $user->setPassword($profil[3]);
                  $user->setRole($profil[4]);
                  $user->setAddedOn('Y-m-d');
                  $user->setActivated(true);
                  $user->setActivatedOn( new \DateTime(date('Y-m-d')));
                  $manager->persist($user);

                  $manager->flush();

              if(!in_array($profil[5], $refs))
              {
                  $refs[] = $profil[5];

                  $this->addReference($profil[5], $user);
              }
          }
      
    }

}
