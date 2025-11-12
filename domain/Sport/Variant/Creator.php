<?php

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Against\H2h as AgainstH2hWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\AllInOneGame as AllInOneGameWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Single as SingleWithPoule;

final class Creator
{
    public function createWithPoule(
        int $nrOfPlaces,
        AllInOneGame|Single|AgainstH2h|AgainstGpp $sportVariant): AllInOneGameWithPoule|SingleWithPoule|AgainstH2hWithPoule|AgainstGppWithPoule {
        if( $sportVariant instanceof AllInOneGame) {
            return new AllInOneGameWithPoule($nrOfPlaces, $sportVariant);
        } else if( $sportVariant instanceof Single) {
            return new SingleWithPoule($nrOfPlaces, $sportVariant);
        } else if( $sportVariant instanceof AgainstH2h) {
            return new AgainstH2hWithPoule($nrOfPlaces, $sportVariant);
        }
        return new AgainstGppWithPoule($nrOfPlaces, $sportVariant);
    }

    /**
     * @param int $nrOfPlaces
     * @param list<AgainstH2h|AgainstGpp|AllInOneGame|Single> $sportVariants
     * @return list<AgainstH2hWithPoule|AgainstGppWithPoule|AllInOneGameWithPoule|SingleWithPoule>
     */
    public function createWithPoules(int $nrOfPlaces,array $sportVariants): array {

        return array_map(
            function(AgainstH2h|AgainstGpp|AllInOneGame|Single $sportVariant)
                use($nrOfPlaces) :  AgainstH2hWithPoule|AgainstGppWithPoule|AllInOneGameWithPoule|SingleWithPoule {
                return $this->createWithPoule($nrOfPlaces, $sportVariant);
        }, $sportVariants );
    }
}