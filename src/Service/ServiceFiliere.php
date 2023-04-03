<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class ServiceFiliere{
    private $client;
    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }
    public function getFilieres()
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/filiere'
        );
        return $response->toArray();

    }
    public function getFiliereById(int $id)
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/filiere/' . $id
       );
       return $response->toArray();

    }
    public function addFiliere(string $libelle)
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8080/filiere/', [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'libelle' => $libelle ],
        ]);
          return $response;

    }

    public function updateFiliere(int $id,string $libelle)
    {
        $response = $this->client->request(
            'PUT',
            'http://localhost:8080/filiere/'. $id, [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'libelle' => $libelle ],
        ]);
          return $response;

    }

    public function deleteFiliereById(int $id)
    {
        $response = $this->client->request(
            'DELETE',
            'http://localhost:8080/filiere/' . $id ,
        );
        return $response;

    }
}
?>