
<?php
class CylonBasestar extends SixSidedShip{

	function __construct($id, $userid, $name,  $slot){
		parent::__construct($id, $userid, $name,  $slot);

		$this->pointCost = 1500;
		$this->faction = "ZPlaytest BSG Cylons";
		$this->phpclass = "CylonBasestar";
		$this->shipClass = "Cylon Basestar";
		$this->fighters = array("medium"=>36, "heavy"=>12, "superheavy"=>6);
		$this->isd = 1980;
		$this->locations = array(41, 42, 2, 32, 31, 1);		

		$this->unofficial = true;

		$this->shipSizeClass = 3; //Enormous is not implemented
		$this->iniativebonus = 0; 
		
        $this->turncost = 1.25;
        $this->turndelaycost = 1.25;
        $this->accelcost = 4;
        $this->rollcost = 999;
        $this->pivotcost = 2;	
        $this->gravitic = true;        	

		$this->forwardDefense = 18;
		$this->sideDefense = 18;

		$this->imagePath = "img/ships/BSG/CylonBasestar.png";
		$this->canvasSize = 200;

		$this->addPrimarySystem(new Reactor(6, 35, 0, 0));
		$this->addPrimarySystem(new Hangar(6, 36));
		$this->addPrimarySystem(new CnC(6, 30, 0, 0));
		$this->addPrimarySystem(new Scanner(6, 24, 5, 8));
        $this->addPrimarySystem(new Engine(6, 25, 0, 16, 3));			
		$hyperdrive = new JumpEngine(6, 25, 3, 16);
			$hyperdrive->displayName = 'Hyperdrive';
			$this->addPrimarySystem($hyperdrive);
		$this->addPrimarySystem(new SelfRepair(3, 3, 2)); //armor, structure, output
		$this->addPrimarySystem(new SelfRepair(3, 3, 2)); //armor, structure, output
		$this->addPrimarySystem(new LtGuidedMissile(4, 3, 2, 0, 360));
	    $this->addPrimarySystem(new LtGuidedMissile(4, 3, 2, 0, 360));
		$this->addPrimarySystem(new MedGuidedMissile(4, 5, 4, 0, 360));

		$this->addFrontSystem(new LtGuidedMissile(4, 3, 2, 300, 60));
		$this->addFrontSystem(new LtGuidedMissile(4, 3, 2, 300, 60));
		$this->addFrontSystem(new MedGuidedMissile(4, 5, 4, 300, 60));
		$this->addFrontSystem(new HvyGuidedMissile(4, 7, 6, 300, 60));
        $this->addFrontSystem(new Thruster(5, 15, 0, 5, 1));

		$this->addAftSystem(new LtGuidedMissile(4, 3, 2, 120, 240));
		$this->addAftSystem(new LtGuidedMissile(4, 3, 2, 120, 240));
		$this->addAftSystem(new MedGuidedMissile(4, 5, 4, 120, 240));
		$this->addAftSystem(new HvyGuidedMissile(4, 7, 6, 120, 240));
        $this->addAftSystem(new Thruster(5, 15, 0, 5, 2));
       
		$this->addLeftFrontSystem(new LtGuidedMissile(4, 3, 2, 240, 0));
		$this->addLeftFrontSystem(new LtGuidedMissile(4, 3, 2, 240, 0));
		$this->addLeftFrontSystem(new MedGuidedMissile(4, 5, 4, 240, 0));
	    $this->addLeftFrontSystem(new Thruster(5, 15, 0, 5, 3));
				
		$this->addLeftAftSystem(new LtGuidedMissile(4, 3, 2, 180, 300));
		$this->addLeftAftSystem(new LtGuidedMissile(4, 3, 2, 180, 300));
		$this->addLeftAftSystem(new MedGuidedMissile(4, 5, 4, 180, 300));
		$this->addLeftAftSystem(new Thruster(5, 15, 0, 5, 3));
		
		$this->addRightFrontSystem(new LtGuidedMissile(4, 3, 2, 0, 120));
		$this->addRightFrontSystem(new LtGuidedMissile(4, 3, 2, 0, 120));
		$this->addRightFrontSystem(new MedGuidedMissile(4, 5, 4, 0, 120));
	    $this->addRightFrontSystem(new Thruster(5, 15, 0, 5, 4));
				
		$this->addRightAftSystem(new LtGuidedMissile(4, 3, 2, 60, 180));
		$this->addRightAftSystem(new LtGuidedMissile(4, 3, 2, 60, 180));
		$this->addRightAftSystem(new MedGuidedMissile(4, 5, 4, 60, 180));
	    $this->addRightAftSystem(new Thruster(5, 15, 0, 5, 4));		
       
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure( 5, 60));
        $this->addAftSystem(new Structure( 5, 60));
        $this->addLeftFrontSystem(new Structure( 5, 60));
        $this->addLeftAftSystem(new Structure( 5, 60));
        $this->addRightFrontSystem(new Structure( 5, 60));
        $this->addRightAftSystem(new Structure( 5, 60));        
        $this->addPrimarySystem(new Structure( 6, 80));
	    
	//d20 hit chart
        $this->hitChart = array(
            0=> array(
                    6 => "Structure",
					7 => "Light Guided Missile",
					8 => "Medium Guided Missile",
					9 => "Self Repair",
                    11 => "Hyperdrive",
                    13 => "Scanner",
                    15 => "Engine",
                    17 => "Hangar",
                    19 => "Reactor",
                    20 => "C&C",
           		 ),
            1=> array(
                    4 => "Thruster",
                    6 => "Light Guided Missile",
					8 => "Medium Guided Missile",
					10 => "Heavy Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
           		 ),
            2=> array(
                    4 => "Thruster",
                    6 => "Light Guided Missile",
					8 => "Medium Guided Missile",
					10 => "Heavy Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
           		 ),
            31=> array(
                    5 => "Thruster",
                    7 => "Light Guided Missile",
					9 => "Medium Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
           		 ),
            32=> array(
                    5 => "Thruster",
                    7 => "Light Guided Missile",
					9 => "Medium Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
           		 ),
            41=> array(
                    5 => "Thruster",
                    7 => "Light Guided Missile",
					9 => "Medium Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
           		 ),
       		42=> array(
                    5 => "Thruster",
                    7 => "Light Guided Missile",
					9 => "Medium Guided Missile",
                    18 => "Structure",
                    20 => "Primary",
            	),
           	);
       		
		}
	}
		
?>		
