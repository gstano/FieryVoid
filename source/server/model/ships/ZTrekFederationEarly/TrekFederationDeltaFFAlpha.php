<?php
class TrekFederationDeltaFFAlpha extends LCV{

    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
        $this->pointCost = 100;
        $this->faction = "ZStarTrek (early) Federation";
        $this->phpclass = "TrekFederationDeltaFFAlpha";
        $this->imagePath = "img/ships/StarTrek/DeltaClass.png";
        $this->shipClass = "Delta Frigate Alpha";

		$this->notes = "Does not require hangar.";
		
	$this->unofficial = true;
        $this->canvasSize = 100;
	$this->isd = 2148;
        
        $this->forwardDefense = 11;
        $this->sideDefense = 11;

        $this->gravitic = true;    
        $this->turncost = 0.33;
        $this->turndelaycost = 0.33;
        $this->accelcost = 1;
        $this->rollcost = 1;
        $this->pivotcost = 1;
        $this->iniativebonus = 12 *5; //deliberately lowered compared to standard LCV
		$this->hangarRequired = ''; //no hangar required!



	$this->addPrimarySystem(new Reactor(3, 9, 0, 0));
	$this->addPrimarySystem(new CnC(99, 1, 0, 0)); //C&C should be unhittable anyway
	    	$sensors = new Scanner(3, 12, 4, 2);
		$sensors->markLCV(); 
		$this->addPrimarySystem($sensors);
	$impulseDrive = new TrekImpulseDrive(3,10,0,0,2);

		/*
		$polarizedhullplating = new AbsorbtionShield(2,4,2,1,0,360);  //$armour, $maxhealth, $powerReq, $shieldFactor, $startArc, $endArc
		$polarizedhullplating->displayName = "Polarized Hull Plating";
		$this->addPrimarySystem($polarizedhullplating);
		*/
		$projection = new TrekShieldProjection(1, 6, 3, 0, 360, 'F');//parameters: $armor, $maxhealth, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
			$projection->displayName = "Polarized Hull Plating";
		$this->addPrimarySystem($projection);
		
      		$this->addFrontSystem(new TrekSpatialTorp(2, 6, 1, 300, 60));
        	$this->addFrontSystem(new TrekSpatialTorp(2, 6, 1, 300, 60));

		$warpNacelle = new TrekWarpDrive(2, 10, 0, 3); //armor, structure, power usage, impulse output
		$impulseDrive->addThruster($warpNacelle);
		$this->addAftSystem($warpNacelle);
		$warpNacelle = new TrekWarpDrive(2, 10, 0, 3); //armor, structure, power usage, impulse output
		$impulseDrive->addThruster($warpNacelle);
		$this->addAftSystem($warpNacelle);


	$this->addFrontSystem(new InvulnerableThruster(99, 1, 0, 99, 1)); //unhitable and with unlimited thrust allowance
	$this->addAftSystem(new InvulnerableThruster(99, 1, 0, 99, 3)); //unhitable and with unlimited thrust allowance
	$this->addAftSystem(new InvulnerableThruster(99, 1, 0, 99, 2)); //unhitable and with unlimited thrust allowance
	$this->addAftSystem(new InvulnerableThruster(99, 1, 0, 99, 4)); //unhitable and with unlimited thrust allowance
        $this->addPrimarySystem($impulseDrive);

        $this->addPrimarySystem(new Structure(3, 30));

	//d20 hit chart
	$this->hitChart = array( //differences are deliberate
		
		0=> array(
			13 => "Structure",
			15 => "1:Spatial Torpedo",
			17 => "2:Nacelle",
			18 => "0:Engine",
			19 => "0:Reactor",
			20 => "0:Scanner",
		),

		1=> array(
			13 => "Structure",
			16 => "1:Spatial Torpedo",
			17 => "2:Nacelle",
			18 => "0:Engine",
			19 => "0:Reactor",
			20 => "0:Scanner",
		),

		2=> array(
			12 => "Structure",
			14 => "1:Spatial Torpedo",
			17 => "2:Nacelle",
			18 => "0:Engine",
			19 => "0:Reactor",
			20 => "0:Scanner",
		),

	);

        
        }
    }
?>