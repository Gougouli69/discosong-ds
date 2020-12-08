<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_home")
     */
    public function home(): Response
    {
        return $this->render('admin/index.html.twig', [
            'cards' => [
                ["name" => "styles", "color" => "primary", "value" => "style"],
                ["name" => "artistes", "color" => "success", "value" => "artist"],
                ["name" => "albums", "color" => "warning", "value" => "album"],
                ["name" => "utilisateurs", "color" => "info", "value" => "user"],
            ]
        ]);
    }
}
