<?php
class XonnUpdated extends VreeCapital{

	function __construct($id, $userid, $name,  $slot){
		parent::__construct($id, $userid, $name,  $slot);

		$this->pointCost = 1200;
		$this->faction = "Vree Conglomerate";
		$this->phpclass = "XonnUpdated";
		$this->shipClass = "Xonn Dreadnought";
		$this->isd = 2260;
        $this->limited = 10; //Restricted Deployment
		

		$this->shipSizeClass = 3;
		$this->iniativebonus = 0;
		
        $this->turncost = 1.5;
        $this->turndelaycost = 1;
        $this->accelcost = 5;
        $this->rollcost = 6;
        $this->pivotcost = 0;	
        $this->gravitic = true;        	

		$this->forwardDefense = 16;
		$this->sideDefense = 16;

		$this->imagePath = "img/ships/VreeXonn.png";
		$this->canvasSize = 200;

		$this->addPrimarySystem(new Reactor(6, 25, 0, 0));
		$this->addPrimarySystem(new Hangar(6, 3));
		$this->addPrimarySystem(new CnC(7, 16, 0, 0));
		$this->addPrimarySystem(new Scanner(6, 18, 9, 10));
        $this->addPrimarySystem(new Engine(6, 18, 0, 10, 3));
		$this->addPrimarySystem(new JumpEngine(7, 16, 6, 24));
		$this->addPrimarySystem(new AntimatterShredder(4, 0, 0, 0, 360));		         			
		$this->addPrimarySystem(new AntimatterShredder(4, 0, 0, 0, 360));
		$this->addPrimarySystem(new AntimatterCannon(4, 0, 0, 0, 360));
		$this->addPrimarySystem(new AntimatterCannon(4, 0, 0, 0, 360));
		$this->addPrimarySystem(new AntimatterCannon(4, 0, 0, 0, 360));      							

        $this->addFrontSystem(new GraviticThruster(5, 20, 0, 10, 1));   
        $this->addFrontSystem(new AntiprotonGun(3, 0, 0, 300, 60));
        $this->addFrontSystem(new AntiprotonGun(3, 0, 0, 300, 60));  	

        $this->addAftSystem(new GraviticThruster(5, 20, 0, 10, 2));  		
        $this->addAftSystem(new AntiprotonGun(3, 0, 0, 120, 240));
        $this->addAftSystem(new AntiprotonGun(3, 0, 0, 120, 240));  		   
        
		$this->addLeftFrontSystem(new AntiprotonGun(3, 0, 0, 240, 360));
		$this->addLeftFrontSystem(new AntiprotonGun(3, 0, 0, 240, 360));
		//$this->addLeftFrontSystem(new StructureTechnical(0, 0, 0, 0));				

		$this->addLeftAftSystem(new GraviticThruster(5, 20, 0, 10, 3));				
		$this->addLeftAftSystem(new AntiprotonGun(3, 0, 0, 180, 300));
		$this->addLeftAftSystem(new AntiprotonGun(3, 0, 0, 180, 300));			
		
		$this->addRightFrontSystem(new AntiprotonGun(3, 0, 0, 0, 120));
		$this->addRightFrontSystem(new AntiprotonGun(3, 0, 0, 0, 120));	
		//$this->addRightFrontSystem(new StructureTechnical(0, 0, 0, 0));			

		$this->addRightAftSystem(new GraviticThruster(5, 20, 0, 10, 4));				
		$this->addRightAftSystem(new AntiprotonGun(3, 0, 0, 60, 180));
		$this->addRightAftSystem(new AntiprotonGun(3, 0, 0, 60, 180));		
		
       
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
		
		/*remade for Tags!
        $this->addFrontSystem(new Structure( 5, 36, true));
        $this->addAftSystem(new Structure( 5, 36, true));
        $this->addLeftFrontSystem(new Structure( 5, 36, true));
        $this->addLeftAftSystem(new Structure( 5, 36, true));
        $this->addRightFrontSystem(new Structure( 5, 36, true));
        $this->addRightAftSystem(new Structure( 5, 36, true));   
		*/
		$structArmor = 5;
		$structHP = 36;
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 300;
		$struct->endArc = 60;
        $this->addFrontSystem($struct);
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 120;
		$struct->endArc = 240;
        $this->addAftSystem($struct);
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 240;
		$struct->endArc = 0;
        $this->addLeftFrontSystem($struct);
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 180;
		$struct->endArc = 300;
        $this->addLeftAftSystem($struct);
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 0;
		$struct->endArc = 120;
        $this->addRightFrontSystem($struct);
		
		$struct = new Structure( $structArmor, $structHP, true);
		$struct->addTag("Outer Structure");
		$struct->startArc = 60;
		$struct->endArc = 180;
        $this->addRightAftSystem($struct);  
		
        $this->addPrimarySystem(new Structure( 6, 60));
	    
	//d20 hit chart
        $this->hitChart = array(
            0=> array(
                    9 => "Structure",
                    10 => "Jump Engine",
                    13 => "Scanner",
                    15 => "Engine",
                    16 => "Hangar",
                    19 => "Reactor",
                    20 => "C&C",
           		 ),
            1=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            2=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            31=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            32=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            41=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
       		42=> array(
                    4 => "TAG:Thruster",                  
                    9 => "TAG:Weapon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
           	);
       		
		}
	
	/* remade for Tags!
        $this->hitChart = array(

            0=> array(
                    9 => "Structure",
                    10 => "Jump Engine",
                    13 => "Scanner",
                    15 => "Engine",
                    16 => "Hangar",
                    19 => "Reactor",
                    20 => "C&C",
           		 ),
            1=> array(
                    4 => "Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            2=> array(
                    4 => "Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            31=> array(
                    4 => "32:Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            32=> array(
                    4 => "Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
            41=> array(
                    4 => "42:Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
       		42=> array(
                    4 => "Thruster",
                    6 => "Antiproton Gun",
                    7 => "0:Antimatter Shredder",                    
                    9 => "0:Antimatter Cannon",
                    17 => "Structure",
                    20 => "Primary",
           		 ),
           	);
       		
		}
		*/
	}
		
?>		
