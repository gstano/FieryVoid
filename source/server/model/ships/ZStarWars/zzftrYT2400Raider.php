<?php
class zzftrYT2400Raider extends FighterFlight{
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
        $this->pointCost = 77*6;
        $this->faction = "ZStarWars";
        $this->phpclass = "zzftrYT2400Raider";
        $this->shipClass = "YT-2400 Raiders";
        $this->imagePath = "img/starwars/YT2400.png";
        $this->variantOf = "YT-2400 Light Freighters";
        
		$this->isd = "late Galactic Republic";
		$this->notes = "Primary users: Common (Civilian/Pirate).";
		$this->notes .= "<br>Hyperdrive";
	    
        $this->unofficial = true;
        
        $this->forwardDefense = 9;
        $this->sideDefense = 9;
        $this->freethrust = 7;
        $this->offensivebonus = 5;
        $this->jinkinglimit = 4;
        $this->turncost = 0.33;
	
		$this->enhancementOptionsEnabled[] = 'NAVIGATOR'; //this flight can have Navigator enhancement option
        
        $this->pivotcost = 2; //SW fighters have higher pivot cost - only elite pilots perform such maneuvers on screen!
		$this->enhancementOptionsEnabled[] = 'ELITE_SW'; //this flight can have Elite Pilot (SW) enhancement option	
        
        
		$this->unitSize = 3; //number of craft in squadron
		
    	$this->iniativebonus = 11 *5; //Pirate unit - Ini better than civilian, but worse than military
    	$this->superheavy = true;
        $this->maxFlightSize = 3;//this is a superheavy fighter originally intended as single unit, limit flight size to 3
		
        $this->hangarRequired = ''; //StarWars unit independence is much larger than B5, this SHF-sized unit is a cargo ship and has great endurance
  
		
        $this->populate();
		
    }
    
    
    public function populate(){
        $current = count($this->systems);
        $new = $this->flightSize;
        $toAdd = $new - $current;
        for ($i = 0; $i < $toAdd; $i++){
            $armour = array(3, 2, 3, 3);
            $fighter = new Fighter("zzftrYT2400Raider", $armour, 30, $this->id);
            $fighter->displayName = "YT-2400 Raider";
            $fighter->imagePath = "img/starwars/YT2400.png";
            $fighter->iconPath = "img/starwars/YT2400_Large.png"; 
		            
            $roundGun = new SWFighterLaser(0, 360, 2, 4); //all-around quad Laser Cannons
            $fighter->addFrontSystem($roundGun);
            
            $roundGun = new SWFighterIon(0, 360, 2, 2); //all-around dual Ion Cannons
            $fighter->addFrontSystem($roundGun);
            
            //2 forward Proton Torpedo Launchers, 4 shots each
            $torpedoLauncher = new SWFtrProtonTorpedoLauncher(4, 330, 30, 2);//single dual launcher! like for direct fire
            $fighter->addFrontSystem($torpedoLauncher);
            
			//Ray Shield, 1 points
			$fighter->addAftSystem(new SWRayShield(0, 1, 0, 1, 0, 360));
		  
			$fighter->addAftSystem(new RammingAttack(0, 0, 360, $fighter->getRammingFactor(), 0)); //ramming attack
			
        	$this->addSystem($fighter);
       }
    }
    
    
}
?>
