<?php
class ColonialJupiterClass extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
	$this->pointCost = 1500;
	$this->faction = "ZPlaytest BSG Colonials";
        $this->phpclass = "ColonialJupiterClass";
        $this->imagePath = "img/ships/BSG/ColonialBattlestar.png";
        $this->shipClass = "Jupiter Battlestar";
        $this->shipSizeClass = 3;
		$this->canvasSize = 180; //img has 200px per side
		$this->limited = 33;
		$this->unofficial = true;

        $this->fighters = array("medium"=>24, "heavy"=>6, "superheavy"=>6);
		$this->customFighter = array("Python"=>6);

		$this->notes = "Primary users: Colonial Fleet";
		$this->isd = 1948;

        $this->notes = 'Python capable';
//        $this->notes .= '<br>Provides +5 Initiative for all friendly Colonial units';
        
        $this->forwardDefense = 17;
        $this->sideDefense = 20;
        
        $this->turncost = 1.5;
        $this->turndelaycost = 1.5;
        $this->accelcost = 4;
        $this->rollcost = 4;
        $this->pivotcost = 6;
        $this->iniativebonus = -5;
        
        $this->addPrimarySystem(new Reactor(6, 40, 0, 0));
        $this->addPrimarySystem(new CnC(6, 30, 0, 0));
        $this->addPrimarySystem(new Scanner(5, 14, 3, 6));
        $this->addPrimarySystem(new Engine(5, 28, 0, 12, 5));
        $this->addPrimarySystem(new ReloadRack(5, 9));
		$this->addPrimarySystem(new BSGFlakBattery(5, 6, 2, 0, 360));
		$this->addPrimarySystem(new BSGFlakBattery(5, 6, 2, 0, 360));
//		$this->addPrimarySystem(new Bulkhead(0, 6));
//      $this->addPrimarySystem(new Bulkhead(0, 6));
		$this->addPrimarySystem(new Thruster(5, 24, 0, 4, 2));
		$hyperdrive = new JumpEngine(6, 30, 8, 20);
			$hyperdrive->displayName = 'Hyperdrive';
			$this->addPrimarySystem($hyperdrive);
   
        $this->addFrontSystem(new Thruster(6, 30, 0, 3, 1));
        $this->addFrontSystem(new Thruster(6, 30, 0, 3, 1));
		$this->addFrontSystem(new Bulkhead(0, 6));
		$this->addFrontSystem(new Bulkhead(0, 6));
		$this->addFrontSystem(new BSGMainBattery(6, 9, 6, 315, 45));
		$this->addFrontSystem(new BSGMainBattery(6, 9, 6, 315, 45));
        $this->addFrontSystem(new LMissileRack(6, 6, 0, 315, 45));
        $this->addFrontSystem(new LMissileRack(6, 6, 0, 315, 45));
        $this->addFrontSystem(new RapidGatling(6, 4, 1, 315, 45));
        $this->addFrontSystem(new RapidGatling(6, 4, 1, 315, 45));

        $this->addAftSystem(new Thruster(6, 18, 0, 3, 2));
        $this->addAftSystem(new Thruster(6, 18, 0, 3, 2));
        $this->addAftSystem(new Thruster(6, 18, 0, 3, 2));
        $this->addAftSystem(new Thruster(6, 18, 0, 3, 2));
		$this->addAftSystem(new Bulkhead(0, 6));
		$this->addAftSystem(new Bulkhead(0, 6));
        $this->addAftSystem(new BSGMainBattery(6, 9, 6, 135, 225));
		$this->addAftSystem(new BSGMainBattery(6, 9, 6, 135, 225));
        $this->addAftSystem(new LMissileRack(6, 6, 0, 135, 225));
        $this->addAftSystem(new LMissileRack(6, 6, 0, 135, 225));
		$this->addAftSystem(new RapidGatling(6, 4, 1, 135, 225));
		$this->addAftSystem(new RapidGatling(6, 4, 1, 135, 225));

        $this->addLeftSystem(new Thruster(6, 18, 0, 3, 3));
        $this->addLeftSystem(new Thruster(6, 18, 0, 3, 3));
		$this->addLeftSystem(new Bulkhead(0, 6));
		$this->addLeftSystem(new Bulkhead(0, 6));
        $this->addLeftSystem(new BSGMainBattery(6, 9, 6, 205, 335));
        $this->addLeftSystem(new BSGFlakBattery(6, 6, 2, 190, 350));
        $this->addLeftSystem(new BSGFlakBattery(6, 6, 2, 190, 350));
		$this->addLeftSystem(new RapidGatling(6, 4, 1, 190, 350));
		$this->addLeftSystem(new RapidGatling(6, 4, 1, 190, 350));
		$this->addLeftSystem(new RapidGatling(6, 4, 1, 190, 350));
		$this->addLeftSystem(new Hangar(6, 18));

        $this->addRightSystem(new Thruster(6, 18, 0, 3, 4));
        $this->addRightSystem(new Thruster(6, 18, 0, 3, 4));
		$this->addRightSystem(new Bulkhead(0, 6));
		$this->addRightSystem(new Bulkhead(0, 6));
        $this->addRightSystem(new BSGMainBattery(6, 9, 6, 25, 155));
        $this->addRightSystem(new BSGFlakBattery(6, 6, 2, 10, 170));
        $this->addRightSystem(new BSGFlakBattery(6, 6, 2, 10, 170));
		$this->addRightSystem(new RapidGatling(6, 4, 1, 10, 170));
		$this->addRightSystem(new RapidGatling(6, 4, 1, 10, 170));
		$this->addRightSystem(new RapidGatling(6, 4, 1, 10, 170));
		$this->addRightSystem(new Hangar(6, 18));
        
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure(4, 80));
        $this->addAftSystem(new Structure(3, 70));
        $this->addLeftSystem(new Structure(4, 90));
        $this->addRightSystem(new Structure(4, 90));
        $this->addPrimarySystem(new Structure(5, 70));
		
		$this->hitChart = array(
			0=> array(
					9 => "Structure",
					10 => "Thruster",
					12 => "Hyperdrive",
					14 => "Scanner",
					15 => "Engine",
					16 => "Flak Battery",
					17 => "Reload Rack",
					19 => "Reactor",
					20 => "C&C",
			),
			1=> array(
					3 => "Thruster",
					7 => "Main Battery",
					9 => "Class-L Missile Rack",
                    10 => "Rapid Gatling Railgun",
					18 => "Structure",
					20 => "Primary",
			),
			2=> array(
					5 => "Thruster",
					9 => "Main Battery",
                    10 => "Rapid Gatling Railgun",
					18 => "Structure",
					20 => "Primary",
			),
			3=> array(
					3 => "Thruster",
					6 => "Hangar",
					7 => "Main Battery",
					9 => "Flak Battery",
                    11 => "Rapid Gatling Railgun",
					18 => "Structure",
					20 => "Primary",
			),
			4=> array(
					3 => "Thruster",
					6 => "Hangar",
					7 => "Main Battery",
					9 => "Flak Battery",
                    11 => "Rapid Gatling Railgun",
					18 => "Structure",
					20 => "Primary",
			),
		);
    }
}

?>