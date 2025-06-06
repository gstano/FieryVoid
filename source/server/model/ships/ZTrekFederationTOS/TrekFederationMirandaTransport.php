<?php
class TrekFederationMirandaTransport extends MediumShip{

    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
        $this->pointCost = 425;
        $this->faction = "ZStarTrek (TOS) Federation";
        $this->phpclass = "TrekFederationMirandaTransport";
        $this->imagePath = "img/ships/StarTrek/FederationMiranda.png";
        $this->shipClass = "Miranda Fast Transport";
	    $this->isCombatUnit = false; //not a combat unit, it will never be present in a regular battlegroup

	$this->occurence = "common";
	$this->variantOf = "Miranda Frigate";

	$this->unofficial = true;
        $this->canvasSize = 100;
	$this->isd = 2260;

	$this->fighters = array("Shuttlecraft"=>3);
		$this->customFighter = array("Human small craft"=>3); //can deploy small craft with Human crew
        
        $this->forwardDefense = 13;
        $this->sideDefense = 13;
        
        $this->gravitic = true;  
        $this->turncost = 0.5;
        $this->turndelaycost = 0.5;
        $this->accelcost = 2;
        $this->rollcost = 2;
        $this->pivotcost = 2;
        $this->iniativebonus = 12 *5;

        $this->addPrimarySystem(new Reactor(4, 12, 0, 2));
        $this->addPrimarySystem(new CnC(4, 9, 0, 0));
        $this->addPrimarySystem(new Scanner(4, 10, 4, 5));
        $this->addPrimarySystem(new Hangar(4, 3));
	$impulseDrive = new TrekImpulseDrive(4,24,0,1,3); //Impulse Drive is an engine in its own right, in addition to serving as hub for Nacelle output: $armour, $maxhealth, $powerReq, $output, $boostEfficiency

	$projection = new TrekShieldProjection(2, 16, 6, 270, 90, 'F');//parameters: $armor, $maxhealth, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projector = new TrekShieldProjector(2, 6, 2, 2, 270, 90, 'F'); //parameters: $armor, $maxhealth, $power used, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projection->addProjector($projector);
		$this->addFrontSystem($projector);
		$projector = new TrekShieldProjector(2, 6, 2, 2, 270, 90, 'F'); //parameters: $armor, $maxhealth, $power used, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projection->addProjector($projector);
		$this->addFrontSystem($projector);
	$this->addFrontSystem($projection);

	$this->addFrontSystem(new SWTractorBeam(3,0,360,1));
	$this->addFrontSystem(new TrekLightPhaser(3, 0, 0, 270, 90));
	$this->addFrontSystem(new TrekLightPhaser(3, 0, 0, 240, 120));
	$this->addFrontSystem(new TrekLightPhaser(3, 0, 0, 270, 90));

	    
		$warpNacelle = new TrekWarpDrive(4, 22, 0, 4); //armor, structure, power usage, impulse output
		$impulseDrive->addThruster($warpNacelle);
		$this->addAftSystem($warpNacelle);
		$warpNacelle = new TrekWarpDrive(4, 22, 0, 4); //armor, structure, power usage, impulse output
		$impulseDrive->addThruster($warpNacelle);
		$this->addAftSystem($warpNacelle);

	$projection = new TrekShieldProjection(2, 16, 6, 90, 270, 'A');//parameters: $armor, $maxhealth, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projector = new TrekShieldProjector(2, 6, 2, 2, 90, 270, 'A'); //parameters: $armor, $maxhealth, $power used, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projection->addProjector($projector);
		$this->addAftSystem($projector);
		$projector = new TrekShieldProjector(2, 6, 2, 2, 90, 270, 'A'); //parameters: $armor, $maxhealth, $power used, $rating, $arc from/to - F/A/L/R suggests whether to use left or right graphics
		$projection->addProjector($projector);
		$this->addAftSystem($projector);
	$this->addAftSystem($projection);

	$cargo = new CargoBay(2,40);
	$cargo->displayName = "Cargo Bay A";
	$this->addAftSystem($cargo);
	$cargo = new CargoBay(2,40);
	$cargo->displayName = "Cargo Bay B";
	$this->addAftSystem($cargo);
	$this->addAftSystem(new TrekLightPhaser(3, 0, 0, 90, 270));
	$this->addAftSystem(new TrekLightPhaser(3, 0, 0, 90, 270));
		
		//technical thrusters - unlimited, like for LCVs		
		$this->addPrimarySystem(new InvulnerableThruster(99, 1, 0, 99, 3)); //unhitable and with unlimited thrust allowance
		$this->addPrimarySystem(new InvulnerableThruster(99, 1, 0, 99, 1)); //unhitable and with unlimited thrust allowance
		$this->addPrimarySystem(new InvulnerableThruster(99, 1, 0, 99, 2)); //unhitable and with unlimited thrust allowance
		$this->addPrimarySystem(new InvulnerableThruster(99, 1, 0, 99, 4)); //unhitable and with unlimited thrust allowance   
        $this->addPrimarySystem($impulseDrive);

        $this->addPrimarySystem(new Structure(4, 44));

	//d20 hit chart
	$this->hitChart = array(
		
		0=> array(
			2 => "2:Nacelle",
			4 => "2:Cargo Bay A",
			6 => "2:Cargo Bay B",
			10 => "Structure",
			12 => "Hangar",
			14 => "Scanner",
			16 => "Engine",
			18 => "Reactor",
			20 => "C&C",
		),

		1=> array(
			2 => "Shield Projector",
			4 => "2:Cargo Bay A",
			6 => "2:Cargo Bay B",
			9 => "Light Phaser",
			10 => "Tractor Beam",
			17 => "Structure",
			20 => "Primary",
		),

		2=> array(
		    5 => "Nacelle",
			7 => "Shield Projector",
			8 => "Light Phaser",
			10 => "Cargo Bay A",
			12 => "Cargo Bay B",
			17 => "Structure",
			20 => "Primary",
		),

	);

        
        }
    }
?>
