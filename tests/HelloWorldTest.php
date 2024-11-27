<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Entity\Produit\ProduitNumerique;
use App\Entity\Produit\ProduitPhysique;
use App\Entity\Produit\ProduitPerissable;
use App\Entity\Panier;
use App\Entity\Utilisateur\Admin;
use App\Entity\Utilisateur\Client;
use App\Entity\Utilisateur\Vendeur;
use App\Config\ConfigurationManager;
use App\Database\DatabaseConnection;
use App\Factory\ProduitFactory;
use App\Repository\ProduitRepository;

class HelloWorldTest extends TestCase
{
    // ***********************
    // PRODUITS
    // ***********************
    // Teste la création d'un produit numérique
    public function testCreationDeProduitNumerique()
    {
        $produitNumerique = new ProduitNumerique("Ebook", 9.99, "Un super livre numérique", 10, "https://example.com/ebook", 2.5, "PDF");

        $this->assertInstanceOf(ProduitNumerique::class, $produitNumerique);
        // $this->assertEquals(1, $produitNumerique->getId());
        $this->assertEquals("Ebook", $produitNumerique->getNom());
        $this->assertEquals(9.99, $produitNumerique->getPrix());
        $this->assertEquals("Un super livre numérique", $produitNumerique->getDescription());
        $this->assertEquals(10, $produitNumerique->getStock());

        echo ".✅ test : Creation de produit numerique\n";
    }
    // Teste la création d'un produit physique
    public function testCreationDeProduitPhysique()
    {
        $produitPhysique = new ProduitPhysique("Laptop", 999.99, "Un super laptop", 5, 2.0, 15.6, 2.5, 0.5);

        $this->assertInstanceOf(ProduitPhysique::class, $produitPhysique);
        // $this->assertEquals(2, $produitPhysique->getId());
        $this->assertEquals("Laptop", $produitPhysique->getNom());
        $this->assertEquals(999.99, $produitPhysique->getPrix());
        $this->assertEquals("Un super laptop", $produitPhysique->getDescription());
        $this->assertEquals(5, $produitPhysique->getStock());

        echo "✅ test : Creation de produit physique\n";
    }
    // Teste la création d'un produit périssable
    public function testCreationDeProduitPerissable()
    {
        $expirationDate = new DateTime('2026-12-31');
        $produitPerissable = new ProduitPerissable("Lait", 1.99, "Un litre de lait", 6, $expirationDate, 2);

        $this->assertInstanceOf(ProduitPerissable::class, $produitPerissable);
        // $this->assertEquals(3, $produitPerissable->getId());
        $this->assertEquals("Lait", $produitPerissable->getNom());
        $this->assertEquals(1.99, $produitPerissable->getPrix());
        $this->assertEquals("Un litre de lait", $produitPerissable->getDescription());
        $this->assertEquals(6, $produitPerissable->getStock());

        echo "✅ test : Creation de produit perissable\n";
    }

    // ***********************
    // PANIER
    // ***********************
    // Teste l'ajout d'un produit au panier
    public function testAjouterProduitAuPanier()
    {
        $produit = new ProduitPhysique("Laptop", 999.99, "Un super laptop", 5, 2.0, 15.6, 2.5, 0.5);
        $produit->setId(1);
        $panier = new Panier(new DateTime('2021-10-01'));
        $panier->ajouterArticle($produit, 2);

        $this->assertArrayHasKey(1, $panier->getArticles());
        $this->assertEquals(2, $panier->getArticles()[1]['quantite']);

        echo "✅ test : Ajout de produit au panier\n";
    }
    // Teste la suppression d'un produit du panier
    public function testRetirerProduitDuPanier()
    {
        $produit = new ProduitPhysique("Laptop", 999.99, "Un super laptop", 5, 2.0, 15.6, 2.5, 0.5);
        $produit->setId(1);
        $panier = new Panier(new DateTime('2021-10-01'));

        $panier->ajouterArticle($produit, 2);
        $panier->retirerArticle($produit, 1);

        $this->assertArrayHasKey(1, $panier->getArticles());
        $this->assertEquals(1, $panier->getArticles()[1]['quantite']);

        echo "✅ test : Retrait de produit du panier\n";
    }

    // ***********************
    // UTILISATEURS
    // ***********************
    // Teste la création d'un administrateur
    public function testCreationAdministrateur()
    {
        $admin = new Admin("Admin", "Nistrator", "admin.nistrator@mon-domaine.fr", "admin123", new DateTime('2021-10-01'), 1, new DateTime('2021-10-01'));

        $this->assertInstanceOf(Admin::class, $admin);
        $this->assertEquals("Admin", $admin->getPrenom());
        $this->assertEquals("Nistrator", $admin->getNom());
        $this->assertEquals("admin.nistrator@mon-domaine.fr", $admin->getEmail());
        $this->assertEquals("admin123", $admin->getMotDePasse());
        $this->assertEquals(new DateTime('2021-10-01'), $admin->getDateInscription());
        $this->assertEquals("Rôles: ROLE_ADMIN", $admin->afficherRoles());

        echo "✅ test : Creation d'administrateur\n";

        $admin->setNiveauAcces(2);
        $this->assertEquals(2, $admin->getNiveauAcces());
        echo ".✅ test : Admin a changé de niveau d'accès\n";
    }
    // Teste la création d'un client
    public function testCreationClient()
    {
        $produit = new ProduitPhysique("Laptop", 999.99, "Un super laptop", 5, 2.0, 15.6, 2.5, 0.5);
        $panier = new Panier(new DateTime('2021-10-01'));
        $panier->ajouterArticle($produit, 2);

        $client = new Client(
            "Jean", 
            "Dupont", 
            "jean.dupont@mon-domaine.fr", 
            "jean123456", 
            new DateTime('2021-10-01'), 
            "123 rue de la Paix", 
            $panier
        );

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals("Jean", $client->getPrenom());
        $this->assertEquals("Dupont", $client->getNom());
        $this->assertEquals("jean.dupont@mon-domaine.fr", $client->getEmail());
        $this->assertEquals("jean123456", $client->getMotDePasse());
        $this->assertEquals(new DateTime('2021-10-01'), $client->getDateInscription());
        $this->assertEquals("123 rue de la Paix", $client->getAdresseLivraison());
        $this->assertEquals("Rôles: ROLE_CLIENT", $client->afficherRoles());

        echo "✅ test : Creation de client\n";

        $client->setAdresseLivraison("456 rue de la Liberté");
        $this->assertEquals("456 rue de la Liberté", $client->getAdresseLivraison());
        echo ".✅ test : Client a changé d'adresse de livraison\n";
    }
    // Teste la création d'un vendeur
    public function testCreationVendeur()
    {
        $vendeur = new Vendeur(
            "Achil", 
            "Parmantier",
            "achil.parmantier@mon-domaine.fr",
            "achil123456",
            new DateTime('2021-10-01'),
            2,
            0.1
        );

        $this->assertInstanceOf(Vendeur::class, $vendeur);
        $this->assertEquals("Achil", $vendeur->getPrenom());
        $this->assertEquals("Parmantier", $vendeur->getNom());
        $this->assertEquals("achil.parmantier@mon-domaine.fr", $vendeur->getEmail());
        $this->assertEquals("achil123456", $vendeur->getMotDePasse());
        $this->assertEquals(new DateTime('2021-10-01'), $vendeur->getDateInscription());
        $this->assertEquals(2, $vendeur->getBoutique());
        $this->assertEquals(0.1, $vendeur->getCommission());
        $this->assertEquals("Rôles: ROLE_VENDEUR", $vendeur->afficherRoles());

        echo "✅ test : Creation de vendeur\n";

        $vendeur->setBoutique(3);
        $this->assertEquals(3, $vendeur->getBoutique());
        echo ".✅ test : Vendeur a changé de boutique\n";
    }




    // ***********************
    // CONFIGURATION
    // ***********************
    public function testConfigurationManager()
    {
        $config = ConfigurationManager::getInstance();

        $this->assertEquals(0.2, $config->get("tva"));
        $this->assertEquals("€", $config->get("devise"));
        $this->assertEquals(5.99, $config->get("frais_de_livraison_de_base"));
        $this->assertEquals("contact@mon-domaine.fr", $config->get("email_de_contact"));
       
        echo "✅ test : Configuration Manager\n";
    }




    // ***********************
    // FACTORY
    // ***********************
    // Test l'ajout d'un produit physique
    public function testFactoryAjouterProduitPhysique()
    {
        $produit = new ProduitFactory;
        $produitPhysique = $produit->creerProduit("physique", [
            'nom' => "Laptop",
            'prix' => 999.99,
            'description' => "Un super laptop",
            'poids' => 2.0,
            'stock' => 5,
            'longueur' => 0.5,
            'largeur' => 15.6,
            'hauteur' => 2.0,
        ]);

        $this->assertInstanceOf(ProduitPhysique::class, $produitPhysique);
        $this->assertEquals("Laptop", $produitPhysique->getNom());
        $this->assertEquals(999.99, $produitPhysique->getPrix());
        $this->assertEquals("Un super laptop", $produitPhysique->getDescription());
        $this->assertEquals(5, $produitPhysique->getStock());

        echo "✅ test : Factory - Ajout de produit physique\n";
    }
    // Test l'ajout d'un produit numérique
    public function testFactoryAjouterProduitNumerique()
    {
        $produit = new ProduitFactory;
        $produitNumerique = $produit->creerProduit("numerique", [
            'nom' => "Ebook",
            'prix' => 9.99,
            'description' => "Un super livre numérique",
            'stock' => 10,
            'lienTelechargement' => "https://example.com/ebook",
            'tailleFichier' => 2.5,
            'formatFichier' => "PDF",
        ]);

        $this->assertInstanceOf(ProduitNumerique::class, $produitNumerique);
        $this->assertEquals("Ebook", $produitNumerique->getNom());
        $this->assertEquals(9.99, $produitNumerique->getPrix());
        $this->assertEquals("Un super livre numérique", $produitNumerique->getDescription());
        $this->assertEquals(10, $produitNumerique->getStock());

        echo "✅ test : Factory - Ajout de produit numérique\n";
    }
    // Test l'ajout d'un produit périssable
    public function testFactoryAjouterProduitPerissable()
    {
        $produit = new ProduitFactory;
        $expirationDate = new DateTime('2026-12-31');
        $produitPerissable = $produit->creerProduit("perissable", [
            'nom' => "Lait",
            'prix' => 1.99,
            'description' => "Un litre de lait",
            'stock' => 6,
            'dateExpiration' => $expirationDate,
            'temperatureStockage' => 3.0,
        ]);

        $this->assertInstanceOf(ProduitPerissable::class, $produitPerissable);
        $this->assertEquals("Lait", $produitPerissable->getNom());
        $this->assertEquals(1.99, $produitPerissable->getPrix());
        $this->assertEquals("Un litre de lait", $produitPerissable->getDescription());
        $this->assertEquals(6, $produitPerissable->getStock());

        echo "✅ test : Factory - Ajout de produit périssable\n";
    }



    // ***********************
    // BASE DE DONNÉES
    // ***********************
    // Teste la connexion à la base de données
    public function testConnexionBaseDeDonnees()
    {
        $db = DatabaseConnection::getInstance();
        $pdo = $db->connect();

        $this->assertInstanceOf(PDO::class, $pdo);

        echo "✅ test : Connexion à la base de données\n";
    }
    // Teste l'ajout d'un produit dans la base de données
    public function testAjouterProduitDansBaseDeDonnees()
    {
        $produit = new ProduitFactory;
        $produitPhysique = $produit->creerProduit("physique", [
            'nom' => "Laptop",
            'prix' => 999.99,
            'description' => "Un super laptop",
            'poids' => 2.0,
            'stock' => 5,
            'longueur' => 0.5,
            'largeur' => 15.6,
            'hauteur' => 2.0,
        ]);

        $produitRepository = new ProduitRepository();
        $produitRepository->create([
            'nom' => $produitPhysique->getNom(),
            'description' => $produitPhysique->getDescription(),
            'prix' => $produitPhysique->getPrix(),
            'stock' => $produitPhysique->getStock(),
            'type' => 'physique',
            'poids' => $produitPhysique->getPoids(),
            'longueur' => $produitPhysique->getLongueur(),
            'largeur' => $produitPhysique->getLargeur(),
            'hauteur' => $produitPhysique->getHauteur(),
        ]);

        $sql = "SELECT * FROM produit WHERE nom = 'Laptop'";
        $db = DatabaseConnection::getInstance()->connect()->query($sql);
        $produit = $db->fetch();

        $this->assertEquals("Laptop", $produit['nom']);
        $this->assertEquals(999.99, $produit['prix']);
        $this->assertEquals("Un super laptop", $produit['description']);
        $this->assertEquals(5, $produit['stock']);

        echo "✅ test : Ajout de produit dans la base de données\n";
    }
}