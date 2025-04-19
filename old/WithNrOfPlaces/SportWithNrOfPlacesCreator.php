<?php

namespace oldsportshelpers\old\WithNrOfPlaces;

use SportsHelpers\Sports\AgainstSportOneVsOne;
use SportsHelpers\Sports\AgainstSportOneVsTwo;
use SportsHelpers\Sports\AgainstSportTwoVsTwo;
use SportsHelpers\Sports\TogetherSport;
use SportsHelpers\Sports\WithNrOfPlaces\AgainstSportOneVsOneWithNrOfPlaces;

class SportWithNrOfPlacesCreator
{
    /**
     * @param int $nrOfPlaces
     * @param list<AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo|TogetherSport> $sports
     * @return list<AgainstOneVsOneSportWithNrOfPlaces|AgainstSportOneVsTwoWithNrOfPlaces|AgainstSportTwoVsTwoWithNrOfPlaces|TogetherSportWithNrOfPlaces>
     */
    public function createListWithNrOfPlaces(int $nrOfPlaces, array $sports): array {

        return array_map(
            function(AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo|TogetherSport $sport)
                use($nrOfPlaces) :  AgainstOneVsOneSportWithNrOfPlaces|AgainstSportOneVsTwoWithNrOfPlaces|AgainstSportTwoVsTwoWithNrOfPlaces|TogetherSportWithNrOfPlaces {
                return $this->createWithNrOfPlaces($nrOfPlaces, $sport);
        }, $sports );
    }

    public function createWithNrOfPlaces(
        int $nrOfPlaces,
        AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo|TogetherSport $sport
    ): AgainstOneVsOneSportWithNrOfPlaces|AgainstSportOneVsTwoWithNrOfPlaces|AgainstSportTwoVsTwoWithNrOfPlaces|TogetherSportWithNrOfPlaces {

        switch ($sport) {
            case ( $sport instanceof TogetherSport):
                return new TogetherSportWithNrOfPlaces($nrOfPlaces, $sport);
            case ( $sport instanceof AgainstSportOneVsOne):
                return new AgainstSportOneVsOneWithNrOfPlaces($nrOfPlaces, $sport);
            case ( $sport instanceof AgainstSportOneVsTwo):
                return new AgainstSportOneVsTwoWithNrOfPlaces($nrOfPlaces, $sport);
            case ( $sport instanceof AgainstSportTwoVsTwo):
                return new AgainstSportTwoVsTwoWithNrOfPlaces($nrOfPlaces, $sport);
        }
    }
}