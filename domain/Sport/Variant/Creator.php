<?php

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\GamesPerPlace as AgainstGppWithNrOfPlaces;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\H2h as AgainstH2hWithNrOfPlaces;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\AllInOneGame as AllInOneGameWithNrOfPlaces;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Single as SingleWithNrOfPlaces;

class Creator
{
    public function createWithNrOfPlaces(
        int $nrOfPlaces,
        AllInOneGame|Single|AgainstH2h|AgainstGpp $sportVariant): AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces|AgainstH2hWithNrOfPlaces|AgainstGppWithNrOfPlaces {
        if( $sportVariant instanceof AllInOneGame) {
            return new AllInOneGameWithNrOfPlaces($nrOfPlaces, $sportVariant);
        } else if( $sportVariant instanceof Single) {
            return new SingleWithNrOfPlaces($nrOfPlaces, $sportVariant);
        } else if( $sportVariant instanceof AgainstH2h) {
            return new AgainstH2hWithNrOfPlaces($nrOfPlaces, $sportVariant);
        }
        return new AgainstGppWithNrOfPlaces($nrOfPlaces, $sportVariant);
    }

    /**
     * @param int $nrOfPlaces
     * @param list<AgainstH2h|AgainstGpp|AllInOneGame|Single> $sportVariants
     * @return list<AgainstH2hWithNrOfPlaces|AgainstGppWithNrOfPlaces|AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces>
     */
    public function createListWithNrOfPlaces(int $nrOfPlaces,array $sportVariants): array {

        return array_map(
            function(AgainstH2h|AgainstGpp|AllInOneGame|Single $sportVariant)
                use($nrOfPlaces) :  AgainstH2hWithNrOfPlaces|AgainstGppWithNrOfPlaces|AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces {
                return $this->createWithNrOfPlaces($nrOfPlaces, $sportVariant);
        }, $sportVariants );
    }
}