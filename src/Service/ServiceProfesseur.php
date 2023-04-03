<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class ServiceProfesseur{
    private $client;
    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }
    public function getProfesseurs()
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/professeur'
        );
        return $response->toArray();

    }
    public function getProfesseurById(int $id)
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/professeur/' . $id
        );
        return $response->toArray();

    }
    public function addProfesseur(string $nom,string $prenom,string $cin,string $matiereLibelle)
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8080/professeur/', [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'nom' => $nom ,
                'prenom' => $prenom ,
                'cin' => $cin ,
                'matiereLibelle' => $matiereLibelle ],
        ]);
          return $response;

    }

    public function updateProfesseur(int $id,string $nom,string $prenom,string $cin,string $matiereLibelle)
    {
        $response = $this->client->request(
            'PUT',
            'http://localhost:8080/professeur/' . $id, [
            // these values are automatically encoded before including them in the URL
            'query' => ['nom' => $nom ,
            'prenom' => $prenom ,
            'cin' => $cin ,
            'matiereLibelle' => $matiereLibelle  ],
        ]);
          return $response;

    }
    public function deleteProfesseurById(int $id)
    {
        $response = $this->client->request(
            'DELETE',
            'http://localhost:8080/professeur/' . $id
        );
        return $response;

    }
}
?>