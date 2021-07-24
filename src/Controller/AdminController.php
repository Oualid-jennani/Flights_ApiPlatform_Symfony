<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Form\CityType;
use App\Form\CountryType;
use App\Form\EditCityType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * AdminController constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return $this->render('backOffice/admin/index.html.twig');
    }

    //<editor-fold desc="Code country">
    /**
     * @Route("/countries", name="listCountries")
     * @param Request $request
     * @return Response
     */
    public function listCounties(Request $request): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class,$country);
        $form ->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()){
                $this->manager->persist($country);
                $this->manager->flush();
                $this->addFlash('success','Country added with successfully');
            }
        }catch (Exception $ex){
            $this->addFlash('error','error');
        }

        $Countries = $this->getDoctrine()->getRepository(Country::class)->findAll();

        return $this->render('backOffice/admin/country/listCountries.html.twig', [
            'Countries' => $Countries,
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/countries/edit/{id}" , name="editCountry")
     * @param Country $country
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public  function editCountry(Country $country,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(CountryType::class,new Country());
        $form ->handleRequest($request);
        $formEdit = $this->createForm(CountryType::class,$country);
        $formEdit ->handleRequest($request);

        try {
            if ($formEdit->isSubmitted() && $formEdit->isValid()){
                $entityManager->flush();
                $this->addFlash('success','Country edited with successfully');
            }
        }catch (Exception $ex){
            $this->addFlash('error','error');
        }
        $Countries = $this->getDoctrine()->getRepository(Country::class)->findAll();

        return $this->render('backOffice/admin/country/listCountries.html.twig', [
            'Countries' => $Countries,
            'form'=>$form->createView(),
            'formEdit'=>$formEdit->createView(),
        ]);
    }

    /**
     * @Route("/countries/delete/{id}" , name="deleteCountry")
     * @param Country $country
     * @return RedirectResponse
     */
    public  function deleteCountry(Country $country)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // $country = $entityManager->getRepository(Country::class)->find($id);
        $entityManager->remove($country);
        $entityManager->flush();

        return $this->redirectToRoute("listCountries");
    }
    //</editor-fold>

    //<editor-fold desc="Code City">
    /**
     * @Route("/cities", name="listCities")
     * @param Request $request
     * @return Response
     */
    public function listCities(Request $request): Response
    {
        $city = new City();
        $form = $this->createForm(CityType::class,$city);
        $form ->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()){
                $this->manager->persist($city);
                $this->manager->flush();
                $this->addFlash('success','City Added with successfully');
            }
        }catch (Exception $ex){
            $this->addFlash('error','error');
        }
        $cities = $this->getDoctrine()->getRepository(City::class)->findAll();

        return $this->render('backOffice/admin/cities/listCities.html.twig', [
            'Cities' => $cities,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/cities/edit/{id}" , name="editCity")
     * @param City $city
     * @param Request $request
     * @return Response
     */
    public  function editCity(City $city,Request $request): Response
    {
        $formEdit = $this->createForm(EditCityType::class,$city);
        $formEdit ->handleRequest($request);

        try {
            if ($formEdit->isSubmitted() && $formEdit->isValid()){
                $this->manager->flush();
                $this->addFlash('success','City Edited');
            }
        }catch (Exception $ex){
            $this->addFlash('error','error Excp');
        }

        $Cities = $this->getDoctrine()->getRepository(City::class)->findAll();

        return $this->render('backOffice/admin/cities/edit_city.html.twig', [
            'Cities' => $Cities,
            'form'=>$formEdit->createView(),
        ]);
    }

    /**
     * @Route("/city/delete/{id}" , name="deleteCity")
     * @param City $city
     * @return RedirectResponse
     */
    public  function deleteCity(city $city)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // $country = $entityManager->getRepository($city::class)->find($id);
        $entityManager->remove($city);
        $entityManager->flush();

        return $this->redirectToRoute("listCities");
    }
    //</editor-fold>

}
