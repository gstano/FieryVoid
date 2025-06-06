<?php
class testMCV extends MediumShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
		$this->pointCost = 10;
		$this->faction = "Custom Ships";
		$this->phpclass = "testMCV";
		$this->imagePath = "img/ships/WalkerPathfinder.png";
		$this->shipClass = "test MCV";
		$this->canvasSize = 100;
	        $this->isd = 2243;

		$this->forwardDefense = 13;
		$this->sideDefense = 13;

		$this->turncost = 0.33;
		$this->turndelaycost = 0.5;
		$this->accelcost = 2;
		$this->rollcost = 1;
		$this->pivotcost = 1;
		$this->iniativebonus = 65;

		$this->addPrimarySystem(new Reactor(4, 15, 0, 2));
		$this->addPrimarySystem(new CnC(4, 12, 0, 0));
		$this->addPrimarySystem(new Scanner(4, 12, 3, 6));
		$this->addPrimarySystem(new Engine(4, 11, 0, 8, 2));
		$this->addPrimarySystem(new Hangar(4, 2));
		$this->addPrimarySystem(new Thruster(3, 13, 0, 4, 3));
		$this->addPrimarySystem(new Thruster(3, 13, 0, 4, 4));

		$this->addFrontSystem(new Thruster(3, 7, 0, 3, 1));
		$this->addFrontSystem(new Thruster(3, 7, 0, 3, 1));
		$this->addFrontSystem(new MediumLaser(3, 6, 5, 240, 360));
		$this->addFrontSystem(new LightPulse(2, 4, 2, 270, 90));
		$this->addFrontSystem(new InterceptorMkI(2, 4, 1, 270, 90));
		$this->addFrontSystem(new LightPulse(2, 4, 2, 270, 90));
		$this->addFrontSystem(new MediumLaser(3, 6, 5, 0, 120));

		$this->addAftSystem(new Thruster(4, 8, 0, 4, 2));
		$this->addAftSystem(new Thruster(4, 8, 0, 4, 2));
		$this->addAftSystem(new LightPulse(2, 4, 2, 180, 0));
		$this->addAftSystem(new InterceptorMkI(2, 4, 1, 90, 270));
        $this->addAftSystem(new LightPulse(2, 4, 2, 0, 180));
	
        $this->addPrimarySystem(new Structure( 4, 38));
		
				$this->hitChart = array(
                0=> array(
                        9 => "Thruster",
                        11 => "Scanner",
                        14 => "Engine",
                        16 => "Hangar",
                        19 => "Reactor",
                        20 => "C&C",
                ),
                1=> array(
                        6 => "Thruster",
                        8 => "Medium Laser",
                        10 => "Light Pulse Cannon",
                        12 => "Interceptor I",
                        17 => "Structure",
                        20 => "Primary",
                ),
                2=> array(
                        8 => "Thruster",
                        10 => "Light Pulse Cannon",
                        12 => "Interceptor I",
                        17 => "Structure",
                        20 => "Primary",
                ),
        );
    }
}



?>
