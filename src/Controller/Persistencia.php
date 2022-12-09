<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManager;

class Persistencia implements InterfaceControladorRequisicao
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $curso = new Curso();
        $curso->setDescricao(strip_tags($_POST['descricao']));
        $this->entityManager->persist($curso);
        $this->entityManager->flush();

        header('Location: /listar-cursos');
    }
}