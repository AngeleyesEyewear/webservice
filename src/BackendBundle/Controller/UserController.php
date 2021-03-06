<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users= $em->getRepository('BackendBundle:Utilisateur')->findAll();
        return $this->json($users);
    }
    public function json($data){
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer);
        $encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
        
        $json = $serializer->serialize($data,'json');
        
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent($json);
        $response->headers->set("Content-Type","application/json");
        return $response;
    }
}
