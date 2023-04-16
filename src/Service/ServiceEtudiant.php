<?php
namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class ServiceEtudiant{
    private $client;
    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }
    public function getEtudiants()
    {
        $response = $this->client->request(
            'GET',
            'http://localhost:8080/etudiant'
        );
        return $response->toArray();

    }
    public function getEtudiantById(int $id)
    {$response = $this->client->request(
        'GET',
        'http://localhost:8080/etudiant/' . $id
    );
    return $response->toArray();

    }
    public function addEtudiant(string $nom,string $prenom,string $cin,string $age,string $filiereLibelle)
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8080/etudiant/', [
            // these values are automatically encoded before including them in the URL
            'query' => [
                'nom' => $nom ,
                'prenom' => $prenom ,
                'cin' => $cin ,
                'age' => $age ,
                'filiereLibelle' => $filiereLibelle ],
        ]);
        // dd($response);
          return $response;

    }

    public function updateEtudiant(int $id,string $nom,string $prenom,string $cin,string $age,string $filiereLibelle)
    {
        $response = $this->client->request(
            'PUT',
            'http://localhost:8080/etudiant/' . $id, [
            // these values are automatically encoded before including them in the URL
            'query' => ['nom' => $nom ,
            'prenom' => $prenom ,
            'cin' => $cin ,
            'age' => $age ,
            'filiereLibelle' => $filiereLibelle  ],
        ]);
          return $response;

    }
    public function deleteEtudiantById(int $id)
    {
        $response = $this->client->request(
            'DELETE',
            'http://localhost:8080/etudiant/' . $id
        );
        return $response;

    }
}
?>