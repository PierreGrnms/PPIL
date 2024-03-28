<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteAccountControllerTest extends WebTestCase
{
    public function testSupprimerCompte(): void
    {
        $client = static::createClient();

        // Créer un mock d'utilisateur avec un ID spécifique
        $userId = 1; // Remplace cela par l'ID réel de ton utilisateur
        $user = $this->createMock(Utilisateur::class);
        $user->method('getId')->willReturn($userId);

        // Utilisateur doit être authentifié pour accéder à la page de suppression
        $client->loginUser($user);

        // Utiliser l'ID dans l'URL
        $url = str_replace('{id}', $userId, '/profil/{id}/supprimerCompte');

        // Effectuer une requête HTTP GET pour accéder à la page de suppression de compte
        $client->request('GET', $url);

        // Vérifier si la page est accessible
        $this->assertResponseIsSuccessful();

        // Vérifier si le formulaire est présent sur la page
        $this->assertSelectorExists('form');

        // Soumettre le formulaire avec un jeton CSRF valide
        $client->submitForm('Supprimer le compte', [
            'delete_account_form[_token]' => $client->getContainer()->get('security.csrf.token_manager')->getToken('delete_account_form')->getValue(),
        ]);

        // Vérifier si la redirection vers la page d'accueil s'est bien déroulée après la suppression du compte
        $this->assertResponseRedirects('/home');

        // Simuler une nouvelle requête HTTP pour accéder à la page d'accueil après la suppression du compte
        $client->followRedirect();

        // Vérifier si la page d'accueil est accessible après la suppression du compte
        $this->assertResponseIsSuccessful();

        // Vérifier si l'utilisateur n'est plus authentifié après la suppression du compte
        $this->assertNull($client->getContainer()->get('security.token_storage')->getToken());
    }
}
