<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Vol;
use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    /**
     * @var CityRepository
     */
    private $cityRepository;
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * AppFixtures constructor.
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $vol = new Vol();
            $vol->setStart($city = $this->getCity());
            $vol->setFinish($this->getCity($city));
            $vol->setPrice($this->faker->randomFloat(2, 150, 1000));
            $vol->setAirport($this->faker->company);
            $vol->setClass('normal');
            $vol->setCompany($this->faker->companySuffix);
            $departureTime = $this->faker->dateTimeBetween('tomorrow','+30 days');
            $vol->setStartDate($departureTime);
            $tripDelay = \rand(2, 10);
            $arrivalTime = clone $departureTime;
            $arrivalTime = $arrivalTime->add(new \DateInterval('PT'.$tripDelay.'H'));
            $vol->setTime($tripDelay.'h');
            $vol->setEndDate($arrivalTime);
            $manager->persist($vol);
        }
        $manager->flush();
    }

    private function getCity(City $city = null): City
    {
        $cities = $this->cityRepository->findAll();
        $index = \rand(0, \count($cities) - 1);
        if (null === $city || (null !== $city && $cities[$index] !== $city && $cities[$index]->getCountry() !== $city->getCountry())) {
            return $cities[$index];
        }

        return $this->getCity($cities[$index]);
    }
}
