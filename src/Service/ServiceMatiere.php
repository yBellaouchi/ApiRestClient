<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class ServiceMatiere{
    private $client;
    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }
    public function getMatieres()
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/matiere'
        );
        return $response->toArray();

    }
    public function getMatiereById(int $id)
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/matiere/' . $id
        );
        return $response->toArray();

    }
    public function addMatiere(string $libelle,string $libelleFiliere)
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8080/matiere/', [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'libelle' => $libelle ,
                'filiereLibelle' => $libelleFiliere ],
        ]);
          return $response;

    }

    public function updateMatiere(int $id,string $libelle,string $libelleFiliere)
    {
        $response = $this->client->request(
            'PUT',
            'http://localhost:8080/matiere/'. $id, [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'libelle' => $libelle,
                'filiereLibelle' => $libelleFiliere ],
        ]);
          return $response;

    }

    public function deleteMatiereById(int $id)
    {
        $response = $this->client->request(
            'DELETE',
            'http://localhost:8080/matiere/' . $id
        );
        return $response;

    }
}
?>