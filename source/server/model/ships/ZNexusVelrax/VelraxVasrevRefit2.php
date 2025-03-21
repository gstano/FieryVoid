<?php
class VelraxVasrevRefit2 extends MediumShip{

    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
        $this->pointCost = 365;
        $this->faction = "ZNexus Velrax Republic";
        $this->phpclass = "VelraxVasrevRefit2";
        $this->imagePath = "img/ships/Nexus/velraxSathrin.png";
        $this->shipClass = "Vasrev Escort Frigate (2152)";
			$this->variantOf = "Sathrin Border Frigate (2108)";
			$this->occurence = "common";
		$this->unofficial = true;
        $this->agile = true;
        $this->canvasSize = 100;
	    $this->isd = 2152;

	    $this->notes = 'Atmospheric Capable.';

        $this->forwardDefense = 11;
        $this->sideDefense = 13;
        
        $this->turncost = 0.5;
        $this->turndelaycost = 0.33;
        $this->accelcost = 2;
        $this->rollcost = 2;
        $this->pivotcost = 2;
        $this->iniativebonus = 60;
         
        $this->addPrimarySystem(new Reactor(4, 10, 0, 0));
        $this->addPrimarySystem(new CnC(4, 15, 0, 0));
        $this->addPrimarySystem(new Scanner(3, 14, 5, 6));
        $this->addPrimarySystem(new Engine(3, 12, 0, 12, 3));
        $this->addPrimarySystem(new Hangar(1, 2));
        $this->addPrimarySystem(new Thruster(3, 12, 0, 6, 3));
        $this->addPrimarySystem(new Thruster(3, 12, 0, 6, 4));        
        
		$this->addFrontSystem(new EWPlasmaArc(3, 5, 4, 300, 60));
		$this->addFrontSystem(new EWPlasmaArc(3, 5, 4, 300, 60));
		$this->addFrontSystem(new DualIonBolter(2, 4, 4, 300, 60));
		$this->addFrontSystem(new DualIonBolter(2, 4, 4, 270, 90));
        $this->addFrontSystem(new Thruster(2, 12, 0, 6, 1));
	    
        $this->addAftSystem(new Thruster(3, 9, 0, 6, 2));    
        $this->addAftSystem(new Thruster(3, 9, 0, 6, 2));    
		$this->addAftSystem(new DualIonBolter(2, 4, 4, 120, 360));
		$this->addAftSystem(new DualIonBolter(2, 4, 4, 0, 240));
       
        $this->addPrimarySystem(new Structure(5, 50));

	//d20 hit chart
	$this->hitChart = array(
		
		0=> array(
			9 => "Thruster",
			12 => "Scanner",
			15 => "Engine",
			17 => "Hangar",
			19 => "Reactor",
			20 => "C&C",
		),

		1=> array(
			5 => "Thruster",
			7 => "Plasma Arc",
			9 => "Dual Ion Bolter",
			17 => "Structure",
			20 => "Primary",
		),

		2=> array(
			7 => "Thruster",
			10 => "Dual Ion Bolter",
			17 => "Structure",
			20 => "Primary",
		),

	);

        
        }
    }
?>
