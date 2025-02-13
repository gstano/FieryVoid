<?php
class Egret1939 extends HeavyCombatVesselLeftRight{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
    	$this->pointCost = 485;
        $this->faction = "Drazi Freehold (WotCR)";
        $this->phpclass = "Egret1939";
        $this->imagePath = "img/ships/shrike.png";
        $this->shipClass = "Egret Combat Scout (1939)";
			$this->occurence = 'uncommon'; 
			$this->variantOf = "Shrike Heavy Destroyer";
        $this->isd = 1939;
        $this->canvasSize = 160;
        
        $this->forwardDefense = 12;
        $this->sideDefense = 12;
        
        $this->turncost = 0.5;
        $this->turndelaycost = 0.5;
        $this->accelcost = 2;
        $this->rollcost = 2;
        $this->pivotcost = 3;
        $this->iniativebonus = 30;

        $this->addPrimarySystem(new Reactor(5, 12, 0, 4));
        $this->addPrimarySystem(new CnC(5, 8, 0, 0));
        $this->addPrimarySystem(new ElintScanner(5, 20, 6, 6));
        $this->addPrimarySystem(new Engine(4, 12, 0, 7, 3));
        $this->addPrimarySystem(new Hangar(3, 1));
        $this->addFrontSystem(new StdParticleBeam(3, 4, 1, 240, 60));
        $this->addFrontSystem(new StdParticleBeam(3, 4, 1, 300, 120));
        $this->addAftSystem(new Thruster(3, 10, 0, 4, 1));
        $this->addAftSystem(new Thruster(4, 16, 0, 7, 2));

        $this->addLeftSystem(new StdParticleBeam(2, 4, 1, 240, 60));
        $this->addLeftSystem(new Thruster(4, 11, 0, 3, 3));

        $this->addRightSystem(new StdParticleBeam(2, 4, 1, 300, 120));
        $this->addRightSystem(new Thruster(4, 11, 0, 3, 4));

        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addPrimarySystem(new Structure(4, 24));
        $this->addLeftSystem(new Structure(4, 36));
        $this->addRightSystem(new Structure(4, 36));
    
            
        $this->hitChart = array(
        		0=> array(
        				8 => "Structure",
        				11 => "2:Thruster",
						12 => "1:Standard Particle Beam",
        				14 => "ELINT Scanner",
        				16 => "Engine",
        				17 => "Hangar",
        				19 => "Reactor",
        				20 => "C&C",
        		),
        		3=> array(
        				6 => "Thruster",
                    	8 => "Standard Particle Beam",
        				18 => "Structure",
        				20 => "Primary",
        		),
        		4=> array(
        				6 => "Thruster",
                    	8 => "Standard Particle Beam",
        				18 => "Structure",
        				20 => "Primary",
        		),
        );
    }
}
?>