<?php

namespace SportsHelpers\SportVariants\Helpers;

use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Single;
use SportsHelpers\SportVariants\WithNrOfPlaces\AgainstWithNrOfPlaces;
use SportsHelpers\SportVariants\WithNrOfPlaces\AllInOneGameWithNrOfPlaces as AllInOneGameWithNrOfPlaces;
use SportsHelpers\SportVariants\WithNrOfPlaces\SingleWithNrOfPlaces as SingleWithNrOfPlaces;

class SportVariantWithNrOfPlacesCreator
{
    public function createWithNrOfPlaces(
        int                                            $nrOfPlaces,
        AllInOneGame|Single|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo $sportVariant): AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces|AgainstWithNrOfPlaces {
        if( $sportVariant instanceof AllInOneGame) {
            return new AllInOneGameWithNrOfPlaces($nrOfPlaces, $sportVariant);
        } else if( $sportVariant instanceof Single) {
            return new SingleWithNrOfPlaces($nrOfPlaces, $sportVariant);
        }
        return new AgainstWithNrOfPlaces($nrOfPlaces, $sportVariant);
    }

    /**
     * @param int $nrOfPlaces
     * @param list<AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|AllInOneGame|Single> $sportVariants
     * @return list<AgainstWithNrOfPlaces|AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces>
     */
    public function createListWithNrOfPlaces(int $nrOfPlaces, array $sportVariants): array {

        return array_map(
            function(AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|AllInOneGame|Single $sportVariant)
                use($nrOfPlaces) :  AgainstWithNrOfPlaces|AllInOneGameWithNrOfPlaces|SingleWithNrOfPlaces {
                return $this->createWithNrOfPlaces($nrOfPlaces, $sportVariant);
        }, $sportVariants );
    }
}